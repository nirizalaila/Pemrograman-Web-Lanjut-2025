<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
</head>
<body>
    <h1>Edit Item</h1> <!--menampilkan judul halaman "Edit Item" -->
    <form action="{{ route('items.update', $item) }}" method="POST"> <!--membuat form untuk mengupdate item dengan mengarah ke route items.update, $item -->
        @csrf <!--menambahkan token CSRF untuk keamanan dari serangan Cross-Site Request Forgery -->
        @method('PUT') <!--mengubah metode request menjadi PUT -->
        <label for="name">Name:</label> <!--menampilkan label untuk input nama -->
        <input type="text" name="name" value="{{ $item->name }}" required> <!--membuat input teks untuk nama item, dengan nilai default dari item yang sedang diedit. wajib diisi -->
        <br> <!--menambah baris baru -->
        <label for="description">Description:</label> <!--menampilkan label untuk deskripsi item-->
        <textarea name="description" required>{{ $item->description }}</textarea> <!--membuat textarea dengan nilai default dari deskripsi item yang sedang diedit, wajib diisi.-->
        <br>
        <button type="submit">Update Item</button> <!--membuat tombol untuk mengirimkan form dan memperbarui item -->
    </form>
    <a href="{{ route('items.index') }}">Back to List</a> <!--membuat link kembali ke daftar item -->
</body>
</html>