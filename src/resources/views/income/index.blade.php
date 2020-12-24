@extends('layouts.backend')

@section('title', 'Finance')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Finance</h4>
        </div>
        <div class="card-body">
            <button class="btn btn-primary mt-2 mb-3" type="button" id="toggle-modal">
                {{ __('TAMBAH') }}
            </button>
            <table class="table table table-bordered datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga Barang</th>
                        <th scope="col">qty</th>
                        <th scope="col">Total</th>
                        <th scope="col">Gambar</th>
                        <th scope="col" width="150" class="text-center">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <form enctype="multipart/form-data" id="form-create" method="post">
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
            <strong>Success!</strong>Article was added successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang">
        </div>
        <div class="form-group">
            <label for="harga_barang">Harga Barang:</label>
            <input type="text" class="form-control" name="harga_barang" id="harga_barang">
        </div>
        <div class="form-group">
            <label for="qty">qty:</label>
            <input type="text" class="form-control" name="qty" id="qty">
        </div>
        <div class="form-group">
            <label for="total">total:</label>
            <input type="text" class="form-control" name="total" id="total">
        </div>
        <div class="form-group">
            <label for="images">Gambar:</label>
            <input type="file" class="form-control" name="images" id="images">
        </div>
    </form>
    {{-- Edit --}}
    <form enctype="multipart/form-data" id="form-edit" method="post">
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
            <strong>Success!</strong>Article was added successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang_update">
        </div>
        <div class="form-group">
            <label for="harga_barang">Harga Barang:</label>
            <input type="text" class="form-control" name="harga_barang" id="harga_barang_update">
        </div>
        <div class="form-group">
            <label for="qty">qty:</label>
            <input type="text" class="form-control" name="qty_update" id="qty_update">
        </div>
        <div class="form-group">
            <label for="total">total:</label>
            <input type="text" class="form-control" name="total_update" id="total_update">
        </div>
        <div class="form-group">
            <label for="images">Gambar:</label>
            <input type="file" class="form-control" name="images_update" id="images_update">
        </div>
    </form>

@endsection
@push('customJS')
    {{-- Modal Handle di sini --}}
    <script type="text/javascript">
        $("#toggle-modal").fireModal({
            title: 'Finance Tambah Data',
            body: $("#form-create"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            onFormSubmit: async function(modal, e, form) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let form_data = new FormData(this);
                form_data.append('images', document.getElementById("images").files[0])
                form_data.append('nama_barang', $('#nama_barang').val())
                form_data.append('harga_barang', $('#harga_barang').val())
                form_data.append('qty', $('#qty').val())
                form_data.append('total', $('#total').val())
                $.ajax({
                    url: "{{ route('income.store') }}",
                    method: 'post',
                    contentType: false,
                    processData: false,
                    enctype: 'multipart/form-data',
                    data: form_data,
                    success: function(result) {
                        if (result.errors) {
                            $('.alert-danger').html('');
                            $.each(result.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>' + value +
                                    '</li></strong>');
                            });
                            form.stopProgress();
                        } else {
                            $('.alert-danger').hide();
                            $('.alert-success').show();
                            $('.datatable').DataTable().ajax.reload();
                            form.stopProgress();
                            setInterval(function() {
                                $('.alert-success').hide();
                                $('#modal-finance').modal('hide');
                                location.reload();
                            }, 2000);
                        }
                    },
                    error: () => {
                        form.stopProgress();
                    }
                })
            },
            shown: function(modal, form) {
                console.log(form)
            },
            buttons: [{
                text: 'Tambahkan',
                submit: true,
                class: 'btn btn-success',
                handler: function(modal) {

                }
            }]
        });

        // Request Income API
        $(document).ready(() => {
            var dataTable = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 2,
                // scrollX: true,
                "order": [
                    [0, "desc"]
                ],
                ajax: "{{ route('income-ajx') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'harga_barang',
                        name: 'harga_barang'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'Images',
                        name: 'Images',
                        orderable: false,
                        serachable: false,
                        sClass: 'text-center'
                    },
                    {
                        data: 'Actions',
                        name: 'Actions',
                        orderable: false,
                        serachable: false,
                        sClass: 'text-center'
                    },
                ]
            });
        })

    </script>
    {{-- Edit --}}
    <script>
        $("#toggle-modal").fireModal({
            title: 'Finance Tambah Data',
            body: $("#form-edit"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            onFormSubmit: async function(modal, e, form) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let form_data = new FormData(this);
                form_data.append('images', document.getElementById("images").files[0])
                form_data.append('nama_barang', $('#nama_barang').val())
                form_data.append('harga_barang', $('#harga_barang').val())
                form_data.append('qty', $('#qty').val())
                form_data.append('total', $('#total').val())
                $.ajax({
                    url: "{{ route('income.store') }}",
                    method: 'post',
                    contentType: false,
                    processData: false,
                    enctype: 'multipart/form-data',
                    data: form_data,
                    success: function(result) {
                        if (result.errors) {
                            $('.alert-danger').html('');
                            $.each(result.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>' + value +
                                    '</li></strong>');
                            });
                            form.stopProgress();
                        } else {
                            $('.alert-danger').hide();
                            $('.alert-success').show();
                            $('.datatable').DataTable().ajax.reload();
                            form.stopProgress();
                            setInterval(function() {
                                $('.alert-success').hide();
                                $('#modal-finance').modal('hide');
                                location.reload();
                            }, 2000);
                        }
                    },
                    error: () => {
                        form.stopProgress();
                    }
                })
            },
            shown: function(modal, form) {
                console.log(form)
            },
            buttons: [{
                text: 'Update',
                submit: true,
                class: 'btn btn-success',
                handler: function(modal) {}
            }]
        });
    </script>

@endpush()
