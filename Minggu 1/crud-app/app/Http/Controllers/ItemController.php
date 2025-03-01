<?php //file php

namespace App\Http\Controllers; //menentukan namespace App\Http\Controllers, tempat controller berada

use App\Models\Item; //menggunakan model Item untuk berinteraksi dengan database
use Illuminate\Http\Request; //menggunakan Request untuk menangani data dari form

class ItemController extends Controller //membuat kelas ItemController yang mewarisi Controller
{ 
    public function index() //mengambil semua data items dan menampilkan items.index
    {
        $items = Item::all(); //mengambil semua data dari tabel items 
        return view('items.index', compact('items')); //mengirimkan data $items ke tampilan items.index
    }

    public function create() //menampilkan form untuk membuat item baru
    {
        return view('items.create');
    }

    public function store(Request $request) //memvalidasi input pengguna, menyimpan data name dan description ke database, mengalihkan ke halaman items.index dengan pesan sukses
    {
        $request->validate([ //memvalidasi bahwa name dan description harus diisi
            'name' => 'required', //mengambil hanya atribut yang diperbolehkan dari request
            'description' => 'required', 
        ]);
         
        //Item::create($request->all());
        //return redirect()->route('items.index');

        // Hanya masukkan atribut yang diizinkan
         Item::create($request->only(['name', 'description'])); //menyimpan data baru ke database
        return redirect()->route('items.index')->with('success', 'Item added successfully.'); //mengalihkan pegguna ke halaman items.index dengan pesan sukses
    }

    public function show(Item $item) //menampilkan detail item tertentu
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item) //menampilkan form edit untuk item tertentu
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([ //memeriksa apakah input valid
            'name' => 'required',
            'description' => 'required',
        ]);
         
        //$item->update($request->all());
        //return redirect()->route('items.index');
        // Hanya masukkan atribut yang diizinkan
         $item->update($request->only(['name', 'description'])); //memperbarui item di database, hanya mengambil data yang diperbolehkan
        return redirect()->route('items.index')->with('success', 'Item updated successfully.'); //mengalihkan ke halaman items.index dengan pesan sukses
    }

    public function destroy(Item $item)
    {
        
       // return redirect()->route('items.index');
       $item->delete(); //menghapus item dari database
       return redirect()->route('items.index')->with('success', 'Item deleted successfully.'); //mengalihkan ke halaman items.index dengan pesan sukses
    }
}
