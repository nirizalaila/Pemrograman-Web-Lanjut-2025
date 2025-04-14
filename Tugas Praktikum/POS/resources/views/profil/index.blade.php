@extends('layouts.template')

@section('title', 'Profil Pengguna')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-primary card-outline shadow">
        <div class="card-header">
            <h3 class="card-title">Profil Pengguna</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Foto Profil -->
                <div class="col-md-4 text-center">
                    <div class="mb-3">
                        <label class="form-label d-block">Foto Profil Saat Ini</label>
                        @if($user->foto)
                            <img src="{{ asset('storage/foto_profil/' . $user->foto) }}" 
                                 class="img-circle elevation-2" 
                                 alt="Foto Profil" 
                                 width="150" height="150">
                        @else
                            <img src="https://via.placeholder.com/150" 
                                 class="img-circle elevation-2" 
                                 alt="Belum ada foto" 
                                 width="150" height="150">
                            <p class="text-muted mt-2">Belum ada foto.</p>
                        @endif
                    </div>
                </div>

                <!-- Form Upload -->
                <div class="col-md-8">
                    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="foto">Upload Foto Baru</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewFoto(event)">
                                <label class="custom-file-label" for="foto">Pilih file</label>
                            </div>
                        </div>

                        <div class="form-group mt-3 d-none" id="preview-wrapper">
                            <label>Preview Foto Baru</label><br>
                            <img id="preview" class="img-circle elevation-2" width="120" height="120">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Foto Baru -->
<script>
    function previewFoto(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById('preview');
            const wrapper = document.getElementById('preview-wrapper');
            preview.src = URL.createObjectURL(file);
            wrapper.classList.remove('d-none');
        }
    }

    // Ubah label input file saat memilih file
    document.querySelector('.custom-file-input').addEventListener('change', function (e) {
        const fileName = e.target.files[0]?.name;
        e.target.nextElementSibling.innerText = fileName;
    });
</script>
@endsection
