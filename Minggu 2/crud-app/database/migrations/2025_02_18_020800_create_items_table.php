<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //method yang mendefinisikan perubahan skema database yang akan dijalankan saat migration dieksekusi
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id(); //membuat kolom id dengan tipe data bigint yang auto increment
            $table->string('name'); //membuat kolom 'name' dengan tipe data string (VARCHAR)
            $table->text('description'); //membuat kolom 'description' dengan tipe text untuk menyimpan teks panjang
            $table->timestamps(); //membuat kolom yang menyimpan waktu saat data pertama kali dibuat dan kolom data terakhir yang diperbarui
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
