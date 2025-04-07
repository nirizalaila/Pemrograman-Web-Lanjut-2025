@extends('layouts.template')
 
 @section('content')
 <div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Supplier</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/supplier/import') }}')" class="btn btn-info">Import Supplier</button>
            <a href="{{ url('/supplier/create') }}" class="btn btn-primary">Tambah Data</a>
            <button onclick="modalAction('{{ url('/supplier/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button>
        </div>
    </div>

         <div class="card-body">
             @if (session('success'))
                 <div class="alert alert-success">{{ session('success') }}</div>
             @endif
             @if (session ('error'))
                 <div class="alert alert-danger">{{ session('error') }}</div>
             @endif
             <table class="table table-bordered table-striped table-hover table-sm" id="table-supplier">
                 <thead>
                     <tr>
                        <th>ID</th>
                        <th>Kode supplier</th>
                        <th>Nama supplier</th>
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
    var tableSupplier
         $(document).ready(function() {
             tableSupplier = $('#table-supplier').DataTable({
                 // Serverside: true, jika ingin menggunakan server side processing
                 serverSide: true,
                 ajax: {
                     url: "{{ url('supplier/list') }}",
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
                         data: "supplier_kode",
                         className: "",
                         orderable: true,
                         searchable: true
                     }, {
                         data: "supplier_nama",
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