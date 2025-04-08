@extends('layouts.template')
 
 @section('content')
 <div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Kategori</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/kategori/import') }}')" class="btn btn-info">Import Kategori</button>
            <a href="{{ url('/kategori/export_excel') }}" class="btn btn-primary">Export Kategori</a>
            <button onclick="modalAction('{{ url('/kategori/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button>
        </div>
    </div>
         <div class="card-body">
             @if (session('success'))
                 <div class="alert alert-success">{{ session('success') }}</div>
             @endif
             @if (session ('error'))
                 <div class="alert alert-danger">{{ session('error') }}</div>
             @endif
             <table class="table table-bordered table-striped table-hover table-sm" id="table-kategori">
                 <thead>
                     <tr>
                        <th>ID</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                 </thead>
             </table>
         </div>
     </div>
     <div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>
@endsection
 
 @push('js')
     <script>
        function modalAction(url = ''){
        $('#myModal').load(url,function(){
            $('#myModal').modal('show');
        });
    }
    var tableKategori;
         $(document).ready(function () {
             dataKategori = $('#table-kategori').DataTable({
                 // Serverside: true, jika ingin menggunakan server side processing
                 serverSide: true,
                 ajax: {
                     url: "{{ url('kategori/list') }}",
                     dataType: "json",
                     type: "POST"
                 },
                 columns: [
                     {
                         data: "DT_RowIndex",
                         className: 'text-center',
                         orderable: false,
                         searchable: false
                     }, {
                         data: "kategori_kode",
                         className: "",
                         orderable: true,
                         searchable: true
                     }, {
                         data: "kategori_nama",
                         className: "",
                         orderable: true,
                         searchable: true
                     }, {
                         data: "aksi",
                         className: '',
                         orderable: false,
                         searchable: false
                     }
                 ]
             });
         });
     </script>
 @endpush