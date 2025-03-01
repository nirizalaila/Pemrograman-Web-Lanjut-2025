<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title> 
</head>
<body>
    <h1>Add Item</h1> <!-- menampilkan judul halaman "Add Item" -->
    <form action="{{ route('items.store') }}" method="POST"> <!--membuat form yang mengarah ke route items.store dengan metode POST untuk menyimpan item baru -->
        @csrf 
        <label for="name">Name:</label> <!--menampilkan label untuk input nama -->
        <input type="text" name="name" required> <!--membuat input teks untuk nama item, wajib diisi -->
        <br> <!--memberikan baris baru -->
        <label for="description">Description:</label> <!--menampilkan label untuk deskripsi item  -->
        <textarea name="description" required></textarea> <!--membuat textarea untuk deskripsi item, wajib diisi -->
        <br>
        <button type="submit">Add Item</button> <!--membuat tombol untuk mengirimkan form dan menambahkan item -->
    </form>
    <a href="{{ route('items.index') }}">Back to List</a> <!--membuat link kembali ke daftar item -->
</body>
</html>