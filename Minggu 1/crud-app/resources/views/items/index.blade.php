<!DOCTYPE html> <!-- menentukan bahwa ini adalah dokumen html -->
<html> <!-- membuka tag html utama -->
<head> <!-- menampung informasi meta dan judul halaman -->
    <title>Item List</title> <!-- menentukan judul halaman sebagai "Item List" -->
</head>
<body> <!-- membuka bagian utama konten halaman -->
    <h1>Items</h1> <!-- menampilkan judul halaman -->
    @if(session('success')) <!-- memeriksa apakah ada pesan sukses di sesi -->
        <p>{{ session('success') }}</p> <!-- menampilkan pesan suskes jika tersedia -->
    @endif
    <a href="{{ route('items.create') }}">Add Item</a> <!-- membuat link menuju halaman form tambah item -->
    <ul> <!-- membuka daftar tak berurutan untuk menampilkan item -->
        @foreach ($items as $item) <!-- melakukan iterasi pada setiap item dalam variabel $items -->
            <li>
                {{ $item->name }} - <!-- menampilkan nama item dalam list -->
                <a href="{{ route('items.edit', $item) }}">Edit</a> <!-- membuat link edit untuk item -->
                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;"> <!-- membuat formulir untuk menghapus item dengan metode POST -->
                    @csrf <!-- menambahkan token CSRF untuk keamanan -->
                    @method('DELETE') <!-- mengubah metode request menjadi DELETE -->
                    <button type="submit">Delete</button> <!-- membuat tombol untuk menghapus item -->
                </form> 
            </li> <!-- menutup tag list item -->
        @endforeach <!-- mengakhiri loop -->
    </ul> 
</body>
</html>