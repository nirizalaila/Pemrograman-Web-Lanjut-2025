<!DOCTYPE html>
<html>
    <head>
        <title>Item List</title>
    </head>
    <body>
        <h1>Items</h1> <!--menampilkan judul halaman "Items"-->
        @if(session('success')) <!--mengecek apakah ada pesan sukses dalam session -->
        <p>{{ session ('success') }}</p> <!--menampilkan pesan sukses jika ada -->
        @endif <!--menutup kondisi if -->
        <a href="{{ route('items.create')}}">Add Item</a> <!--menyediakan link ke halaman tambah item baru -->
        <ul>
            @foreach ($items as $item) <!--looping untuk menampilkan setiap item yang ada dalam variabel $items -->
                <li>
                    {{ $item->name }} - <!--menampilkan nama item dari database -->
                    <a href="{{ route('items.edit', $item)}}">Edit</a> <!--menyediakan link untuk mengedit item -->
                    <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;"> <!--membuat formulir untuk menghapus item -->
                        @csrf
                        @method('DELETE') <!--menggunakan metode DELETE agar sesuai dengan RESTful API -->
                        <button type="submit">Delete</button> <!-- tombol untuk menghapus item -->
                    </form>
                </li>
            @endforeach
        </ul>
    </body>
</html>