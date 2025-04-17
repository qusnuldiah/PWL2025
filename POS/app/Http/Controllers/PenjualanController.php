<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\DetailPenjualanModel;
use App\Models\BarangModel;
use App\Models\UserModel;
use App\Models\StokModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Transaksi Penjualan',
            'list' => ['Home', 'Penjualan'],
        ];

        $page = (object) [
            'title' => 'Daftar transaksi penjualan yang terdaftar dalam sistem',
        ];

        $activeMenu = 'penjualan';

        $kasir = UserModel::whereHas('level', function ($query) {
            $query->where('level_kode', 'kasir');
        })->get();

        $pelanggan = UserModel::whereHas('level', function ($query) {
            $query->where('level_kode', 'pelanggan');
        })->get();

        return view('penjualan.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
            'kasir' => $kasir,
            'pelanggan' => $pelanggan
        ]);
    }

    public function list(Request $request)
{
    try {
        $penjualans = PenjualanModel::with(['kasir', 'pembeli', 'details'])
            ->select('penjualan_id', 'penjualan_kode', 'kasir_id', 'pembeli_id', 'penjualan_tanggal');

        if ($request->pelanggan_id) {
            $penjualans->where('pembeli_id', $request->pelanggan_id);
        }

        if ($request->kasir_id) {
            $penjualans->where('kasir_id', $request->kasir_id);
        }

        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('penjualan_tanggal', fn($p) => \Carbon\Carbon::parse($p->penjualan_tanggal)->translatedFormat('d F Y'))
            ->addColumn('total_item', fn($p) => $p->details->sum('jumlah'))
            ->addColumn('total_harga', fn($p) => 'Rp ' . number_format(
                $p->details->sum(fn($d) => $d->harga * $d->jumlah), 0, ',', '.'))
            ->addColumn('kasir_nama', fn($p) => $p->kasir->nama ?? '-')
            ->addColumn('pembeli_nama', fn($p) => $p->pembeli->nama ?? '-')                
            ->addColumn('keterangan', fn($p) => 'Transaksi selesai')
            ->addColumn('aksi', function ($p) {
                return '<button class="btn btn-info btn-sm">Detail</button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Error: ' . $e->getMessage(),
        ]);
    }
}


    public function show_ajax(string $id)
    {
        $penjualan = PenjualanModel::with('kasir', 'pembeli', 'details.barang')->find($id);
        if (!$penjualan) {
            return response()->json([
                'status' => false,
                'message' => 'Data penjualan tidak ditemukan',
            ]);
        }
        return view('penjualan.show_ajax', ['penjualan' => $penjualan]);
    }

    public function create_ajax()
    {
        $user = UserModel::all();
        $barangs = BarangModel::all();
        return view('penjualan.create_ajax', compact('user', 'barangs'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'penjualan_kode'    => 'required|string|min:3|unique:t_penjualan,penjualan_kode',
                'pembeli_id'        => 'required|integer|exists:m_user,user_id',
                'penjualan_tanggal' => 'required|date',
                'barang_id'         => 'required|array',
                'barang_id.*'       => 'required|integer|exists:m_barang,barang_id',
                'jumlah'            => 'required|array',
                'jumlah.*'          => 'required|integer|min:1',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            try {
                return DB::transaction(function () use ($request) {
                    $penjualan = new PenjualanModel();
                    $penjualan->penjualan_kode = $request->penjualan_kode;
                    $penjualan->kasir_id = auth()->user()->user_id;
                    $penjualan->pembeli_id = $request->pembeli_id;
                    $penjualan->penjualan_tanggal = $request->penjualan_tanggal;
                    $penjualan->save();

                    foreach ($request->barang_id as $index => $barang_id) {
                        $barang = BarangModel::find($barang_id);
                        $stok = StokModel::where('barang_id', $barang_id)->first();

                        if (!$stok || $stok->stok_jumlah < $request->jumlah[$index]) {
                            throw new \Exception("Stok barang {$barang->barang_nama} tidak cukup!");
                        }

                        $detail = new DetailPenjualanModel();
                        $detail->penjualan_id = $penjualan->penjualan_id;
                        $detail->barang_id = $barang_id;
                        $detail->harga = $barang->harga_jual;
                        $detail->jumlah = $request->jumlah[$index];
                        $detail->save();

                        $stok->stok_jumlah -= $request->jumlah[$index];
                        $stok->save();
                    }

                    return response()->json([
                        'status' => true,
                        'message' => 'Data penjualan berhasil disimpan',
                    ]);
                });
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
                ]);
            }
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $penjualan = PenjualanModel::with('details')->find($id);
        $user = UserModel::select('user_id', 'nama')->get();
        $barangs = BarangModel::all();

        if (!$penjualan) {
            return response()->json([
                'status' => false,
                'message' => 'Data penjualan tidak ditemukan',
            ]);
        }

        return view('penjualan.edit_ajax', [
            'penjualan' => $penjualan,
            'user' => $user,
            'barangs' => $barangs
        ]);
    }

    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'penjualan_kode'    => 'required|string|min:3|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_id',
                'pembeli_id'        => 'required|integer|exists:m_user,user_id',
                'penjualan_tanggal' => 'required|date',
                'barang_id'         => 'required|array',
                'barang_id.*'       => 'required|integer|exists:m_barang,barang_id',
                'jumlah'            => 'required|array',
                'jumlah.*'          => 'required|integer|min:1',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            try {
                return DB::transaction(function () use ($request, $id) {
                    $penjualan = PenjualanModel::find($id);
                    if (!$penjualan) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Data penjualan tidak ditemukan',
                        ]);
                    }

                    $oldDetails = DetailPenjualanModel::where('penjualan_id', $id)->get();
                    foreach ($oldDetails as $detail) {
                        $stok = StokModel::where('barang_id', $detail->barang_id)->first();
                        if ($stok) {
                            $stok->stok_jumlah += $detail->jumlah;
                            $stok->save();
                        }
                    }

                    DetailPenjualanModel::where('penjualan_id', $id)->delete();

                    $penjualan->penjualan_kode = $request->penjualan_kode;
                    $penjualan->pembeli_id = $request->pembeli_id;
                    $penjualan->penjualan_tanggal = $request->penjualan_tanggal;
                    $penjualan->kasir_id = auth()->user()->user_id;
                    $penjualan->save();

                    foreach ($request->barang_id as $index => $barang_id) {
                        $barang = BarangModel::find($barang_id);
                        $stok = StokModel::where('barang_id', $barang_id)->first();

                        if (!$stok || $stok->stok_jumlah < $request->jumlah[$index]) {
                            throw new \Exception("Stok barang {$barang->barang_nama} tidak cukup!");
                        }

                        $detail = new DetailPenjualanModel();
                        $detail->penjualan_id = $penjualan->penjualan_id;
                        $detail->barang_id = $barang_id;
                        $detail->harga = $barang->harga_jual;
                        $detail->jumlah = $request->jumlah[$index];
                        $detail->save();

                        $stok->stok_jumlah -= $request->jumlah[$index];
                        $stok->save();
                    }

                    return response()->json([
                        'status' => true,
                        'message' => 'Data penjualan berhasil diperbarui',
                    ]);
                });
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal memperbarui data: ' . $e->getMessage(),
                ]);
            }
        }
        return redirect('/');
    }

    public function destroy_ajax(string $id)
    {
        $penjualan = PenjualanModel::find($id);

        if (!$penjualan) {
            return response()->json([
                'status' => false,
                'message' => 'Data penjualan tidak ditemukan',
            ]);
        }

        try {
            DB::transaction(function () use ($penjualan) {
                $details = $penjualan->details;
                foreach ($details as $detail) {
                    $stok = StokModel::where('barang_id', $detail->barang_id)->first();
                    if ($stok) {
                        $stok->stok_jumlah += $detail->jumlah;
                        $stok->save();
                    }
                }
                $penjualan->delete();
            });

            return response()->json([
                'status' => true,
                'message' => 'Data penjualan berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage(),
            ]);
        }
    }
}
