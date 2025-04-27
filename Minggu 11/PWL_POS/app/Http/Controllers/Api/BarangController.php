<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\BarangModel;

class BarangController extends Controller
{
    public function index() {
        $barangs = BarangModel::all();
        return response()->json($barangs);
    }

    public function store(Request $request) {
        // Set validation
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Tambahkan validasi image
        ]);
        
        // If validations fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create barang
        $barang = BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'image' => $request->image->hashName(), // Simpan nama file image yang sudah di-hash
        ]);

        // Return response JSON barang is created
        if ($barang) {
            return response()->json([
                'success' => true,
                'barang' => $barang,
            ], 201);
        }

        // Return JSON if process failed
        return response()->json([
            'success' => false,
        ], 409);
    }

    public function show(BarangModel $barang) {
        return $barang;
    }

    public function update(Request $request, BarangModel $barang) {
        $barang->update($request->all());
        return $barang;
    }

    public function destroy(BarangModel $barang) {
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data barang terhapus',
        ]);
    }
}