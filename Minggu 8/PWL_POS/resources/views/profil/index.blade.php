@extends('layouts.template')

@section('title', 'Profil Pengguna')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Foto Profil Saat Ini:</label><br>
            @if($user->foto)
                <img src="{{ asset('storage/foto_profil/' . $user->foto) }}" width="100" class="rounded-circle mb-3">
            @else
                <p>Belum ada foto.</p>
            @endif
        </div>

        <div class="form-group">
            <label>Upload Foto Baru</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
