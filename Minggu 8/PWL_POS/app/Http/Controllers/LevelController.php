<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LevelController extends Controller
{
    public function index() 
    {
        $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
        
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $acttiveMenu = 'level'; // set menu yang aktif
 
         return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $acttiveMenu]);
     }
 
     // ambil data level dalam bentuk json untuk datatables
     public function list(Request $request) {
         $level = LevelModel::select('level_id', 'level_kode', 'level_nama');
 
         if ($request->level_kode) {
             $level->where('level_kode', $request->level_kode);
         }
 
         return DataTables::of($level)
             ->addIndexColumn()
             ->addColumn('aksi', function ($level) {
                //  $btn = '<a href="'.url('/level/' .$level->level_id).'" class="btn btn-info btn-sm">Detail</a> ';
                //  $btn .= '<a href="'.url('/level/' .$level->level_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                //  $btn .= '<form class="d-inline-block" method="POST" action="'.url('/level/'.$level->level_id).'">'
                //       . csrf_field() . method_field('DELETE')
                //       . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah anda yakin menghapus data ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button>';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button>';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn; 
             })
             ->rawColumns(['aksi'])
             ->make(true);
     }
 
     // Menampilkan halaman form tambah level
     public function create(){
         $breadcrumb = (object) [
             'title' => 'Tambah Level',
             'list' => ['Home', 'Level', 'Tambah']
         ];
 
         $page = (object) [
             'title' => 'Tambah level baru'
         ];
 
         $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
         $activeMenu = 'level'; // set menu yang aktif
         return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
     }
 
     public function store(Request $request){
         $request->validate([
             'level_kode' => 'required|string|min:3',
             'level_nama' => 'required|string'
         ]);
 
         LevelModel::create([
             'level_kode' => $request->level_kode,
             'level_nama' => $request->level_nama
         ]);
 
         return redirect('/level')->with('status', 'Data level berhasil ditambahkan');
     }
 
     public function show(string $id){
         $level = LevelModel::find($id); // ambil data level untuk ditampilkan di form
         $breadcrumb = (object) [
             'title' => 'Detail Level',
             'list' => ['Home', 'Level', 'Detail']
         ];
 
         $page = (object) [
             'title' => 'Detail level'
         ];
 
         $activeMenu = 'level'; // set menu yang aktif
         return view('level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
     }
 
     public function edit(string $id){
         $level = LevelModel::find($id); // ambil data level untuk ditampilkan di form
         $breadcrumb = (object) [
             'title' => 'Edit Level',
             'list' => ['Home', 'Level', 'Edit']
         ];
 
         $page = (object) [
             'title' => 'Edit level'
         ];
 
         $activeMenu = 'level'; // set menu yang aktif
         return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
     }
 
     public function update(Request $request, string $id){
         $request->validate([
             'level_kode' => 'required|string|min:3',
             'level_nama' => 'required|string'
         ]);
 
         LevelModel::find($id)->update([
             'level_kode' => $request->level_kode,
             'level_nama' => $request->level_nama
         ]);
 
         return redirect('/level')->with('status', 'Data level berhasil diubah');
     }
 
     public function destroy(string $id){
         $check = LevelModel::find($id);
         if (!$check) {
             return redirect('/level')->with('error', 'Data level tidak ditemukan');
         }
 
         try {
             LevelModel::destroy($id);
             return redirect('/level')->with('success', 'Data level berhasil dihapus');
         } catch (\Illuminate\Database\QueryException $e) {
             return redirect('/level')->with('error', 'Data level tidak bisa dihapus karena masih digunakan pada tabel lain');
         }
    }

    public function create_ajax(){
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('level.create_ajax')
                ->with('level', $level);
    }

    public function store_ajax(Request $request) {
        // cek apakah request berupa ajax
        if($request->ajax() || $request->wantsJson()){
            $rules = [
                'level_kode' => 'required|string|min:3',
                'level_nama' => 'required|string'
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return response()->json([
                    'status' => false, //response sttaus, false: error/gagal, true=berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // pesan error validasi
                ]);
            }

            LevelModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data Level berhasil disimpan'
            ]);
        }
        redirect('/level');
    }

    // Menampilkan halaman form edit user ajax
    public function edit_ajax(string $id) {
        $level = LevelModel::find($id);
        return view('level.edit_ajax', ['level' => $level]);
    }

    public function update_ajax(Request $request, $id)
    {
        // Cek apakah request dari AJAX
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|min:3',
                'level_nama' => 'required|string'
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false, // Respon JSON, true: berhasil, false: gagal
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors() // Menunjukkan field mana yang error
                ]);
            }

            $check = LevelModel::find($id);

            if ($check) {
                $check->update($request->all());

                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id) {
        $level = LevelModel::find($id);
        return view('level.confirm_ajax', ['level' => $level]);
    }

    public function delete_ajax(Request $request, $id) {
        //cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                $level->delete();
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function import() {
        return view('level.import');
    }

    public function import_ajax (Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                //validasi file harus xls atau xlsx, max 1MB
                'file_level' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => ' Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_level'); //ambil file dari request

            $reader = IOFactory::createReader('Xlsx'); //load reader file excel
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath()); //load file excel
            $sheet = $spreadsheet->getActiveSheet(); //ambil sheet yang aktif
            
            $data = $sheet->toArray(null, false, true, true); //ambil data excel

            $insert = [];
            if(count($data) > 1) { //jika data lebih dari 1 baris
                foreach($data as $baris => $value) {
                    if($baris > 1) { //baris ke 1 adalah header, maka lewati
                        $insert[] = [
                            'level_id' => $value['A'],
                            'level_kode' => $value['B'],
                            'level_nama' => $value['C'],
                            'created_at' => now(),
                        ];
                    }
                }

                if(count($insert) > 0) {
                    //insert data ke database, jika data sudah ada, maka diabaikan
                    LevelModel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport',
                ]);
            }
        }
        return redirect('/');
    }
}
