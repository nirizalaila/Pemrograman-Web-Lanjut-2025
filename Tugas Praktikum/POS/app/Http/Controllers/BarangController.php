<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Yajra\DataTables\Facades\DataTables;
 
class BarangController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];
 
        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];
 
        $activeMenu = 'barang'; // set menu yang aktif
 
        $kategori = KategoriModel::all(); // ambil data kategori untuk ditampilkan di form
 
        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }
 
    public function list(Request $request) {
        $barang = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'kategori_id', 'harga_jual', 'harga_beli') 
        ->with('kategori');
 
        if ($request->kategori_id) {
            $barang->where('kategori_id', $request->kategori_id);
        }
 
        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) {
                $btn = '<a href="'.url('/barang/' .$barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/barang/' .$barang->barang_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/barang/'.$barang->barang_id).'">'
                    . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah anda yakin menghapus data ini?\');">Hapus</button></form>';
                 return $btn; 
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
 
    public function create(){
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];
 
        $page = (object) [
            'title' => 'Tambah barang baru'
        ];
 
        $kategori = KategoriModel::all(); // ambil data kategori untuk ditampilkan di form
 
        $activeMenu = 'barang'; // set menu yang aktif
 
        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }
 
    public function store(Request $request) {
        $request->validate([
            'barang_kode'   => 'required|string|min:3|unique:m_barang,barang_kode',
            'barang_nama'   => 'required|string|max:100',
            'harga_beli'    => 'required|integer',
            'harga_jual'    => 'required|integer',
            'kategori_id'   => 'required|integer'
        ]);
 
        BarangModel::create([
            'barang_kode'   => $request->barang_kode,
            'barang_nama'   => $request->barang_nama,
            'harga_beli'    => $request->harga_beli,
            'harga_jual'    => $request->harga_jual,
            'kategori_id'   => $request->kategori_id
        ]);
 
        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }
 
    public function show(string $id) {
        $barang = BarangModel::with('kategori')->find($id);
        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];
 
        $page = (object) [
            'title' => 'Detail barang'
        ];
 
        $activeMenu = 'barang'; // set menu yang aktif
 
        return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'barang' => $barang]);  
    }
 
    public function edit(string $id){
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all(); 
 
        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];
 
        $page = (object) [
            'title' => 'Edit barang'
        ];
 
        $activeMenu = 'barang'; // set menu yang aktif
 
        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'barang' => $barang, 'kategori' => $kategori]);
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'barang_kode'   => 'required|string|min:3|',
            'barang_nama'   => 'required|string|max:100',
            'harga_beli'    => 'required|integer',
            'harga_jual'    => 'required|integer',
            'kategori_id'   => 'required|integer'
        ]);
 
        BarangModel::find($id)->update([
            'barang_kode'   => $request->barang_kode,
            'barang_nama'   => $request->barang_nama,
            'harga_beli'    => $request->harga_beli,
            'harga_jual'    => $request->harga_jual,
            'kategori_id'   => $request->kategori_id
        ]);
 
        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }
 
    public function destroy(string $id){
        $check = BarangModel::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }
 
        try {
            BarangModel::destroy($id);
            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data barang tidak bisa dihapus karena masih digunakan pada tabel lain');
        }
    }
}