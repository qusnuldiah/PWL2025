<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\BarangModel;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object)[
            'title' => 'Daftar stok barang yang tercatat'
        ];

        $activeMenu = 'stok';

        return view('stok.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $stoks = StokModel::with(['barang', 'user'])->select('stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah');

        return DataTables::of($stoks)
            ->addIndexColumn()
            ->addColumn('barang_nama', fn($stok) => $stok->barang->barang_nama ?? '-')
            ->addColumn('user_nama', fn($stok) => $stok->user->nama ?? '-')
            ->addColumn('aksi', function ($stok) {
                return '
                    <button onclick="modalAction(`' . url('/stok/' . $stok->stok_id . '/show_ajax') . '`)" class="btn btn-info btn-sm">Detail</button>
                    <button onclick="modalAction(`' . url('/stok/' . $stok->stok_id . '/edit_ajax') . '`)" class="btn btn-success btn-sm">Edit</button>
                    <button onclick="modalAction(`' . url('/stok/' . $stok->stok_id . '/delete_ajax') . '`)" class="btn btn-danger btn-sm">Hapus</button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $barangs = BarangModel::all();
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Supplier', 'Tambah'],
        ];

        $page = (object) [
            'title' => 'Tambah stok baru',
        ];

        $activeMenu = 'stok';
        return view('stok.create', compact('barangs'), ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page]);
    }


    public function create_ajax()
    {
        $barangs = BarangModel::all();
        $users = User::all();

        return view('stok.create_ajax', compact('barangs', 'users'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'barang_id' => 'required',
                'user_id' => 'required',
                'stok_tanggal' => 'required|date',
                'stok_jumlah' => 'required|integer',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            StokModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data stok berhasil disimpan',
            ]);
        }
        return redirect('/');
    }

    public function show_ajax($id)
    {
        $stok = StokModel::with(['barang', 'user'])->find($id);

        return view('stok.show_ajax', compact('stok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer',
        ]);

        StokModel::create([
            'barang_id' => $request->barang_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
            'user_id' => auth()->user()->user_id,
        ]);

        return redirect('/stok')->with('success', 'Stok berhasil ditambahkan.');
    }

    public function edit_ajax($id)
    {
        $stok = StokModel::findOrFail($id);
        $barangs = BarangModel::all();
        $users = User::all();

        return view('stok.edit_ajax', compact('stok', 'barangs', 'users'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $rules = [
                'barang_id' => 'required',
                'stok_tanggal' => 'required|date',
                'stok_jumlah' => 'required|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
    
            $stok = StokModel::find($id);
            if ($stok) {
                $data = $request->only(['barang_id', 'stok_tanggal', 'stok_jumlah']);
                $data['user_id'] = auth()->user()->user_id;

                $stok->update($data);
                return response()->json([
                    'status' => true,
                    'message' => 'Data stok berhasil diperbarui',
                ]);
            }
    
            return response()->json([
                'status' => false,
                'message' => 'Data stok tidak ditemukan',
            ]);
        }
    
        return redirect('/');
    }

    public function confirm_ajax($id)
    {
        $stok = StokModel::findOrFail($id);
        return view('stok.confirm_ajax', compact('stok'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $stok = StokModel::find($id);
            if ($stok) {
                $stok->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data stok berhasil dihapus',
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Data stok tidak ditemukan',
            ]);
        }

        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required',
            'user_id' => 'required',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer',
        ]);

        $stok = StokModel::findOrFail($id);
        $stok->update($request->all());

        return redirect()->route('stok.index')->with('success', 'Stok berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $stok = StokModel::find($id);
        if (!$stok) {
            return redirect()->route('stok.index')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            $stok->delete();
            return redirect()->route('stok.index')->with('success', 'Stok berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('stok.index')->with('error', 'Gagal menghapus data stok.');
        }
    }
}
