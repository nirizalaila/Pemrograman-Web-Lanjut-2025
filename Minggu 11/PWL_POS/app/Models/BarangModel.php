<?php
 
 namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
 
 class BarangModel extends Model
 {
     use HasFactory;
 
     protected $table = 'm_barang'; // mendefinisikan nama tabel yang digunakan oleh model ini
     protected $primaryKey = 'barang_id'; // mendefinisikan primary key tabel
 
     /**
      * Summary of fillable
      * @var array
      */
     protected $fillable = [
         'kategori_id',
         'barang_kode',
         'barang_nama',
         'harga_beli',
         'harga_jual',
         'image' //tambahan
     ];
 
     public function kategori() {
         return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
     }

     protected function image(): Attribute {
        return Attribute::make(
            get: fn ($image) => url('/storage/posts/' .$image),
        );
    }
 }