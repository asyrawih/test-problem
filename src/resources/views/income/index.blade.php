@extends('layouts.backend')

@section('title', 'Finance')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Finance</h4>
        </div>
        <div class="card-body">
            <table class="table table table-bordered datatable">
                <button class="btn btn-warning mt-2 mb-3" type="button" id="toggle-modal-1">
                    Tambah
                </button>
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
                <tbody class="tbody" id="table-body">

                </tbody>
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

@endsection
@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="header">Test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_modal">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang:</label>
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang_modal">
                        </div>
                        <div class="form-group">
                            <label for="harga_barang">Harga Barang:</label>
                            <input type="text" class="form-control" name="harga_barang" id="harga_barang_modal">
                        </div>
                        <div class="form-group">
                            <label for="qty">qty:</label>
                            <input type="text" class="form-control" name="qty" id="qty_modal">
                        </div>
                        <div class="form-group">
                            <label for="total">total:</label>
                            <input type="text" class="form-control" name="total" id="total_modal">
                        </div>
                        <div class="form-group">
                            <label for="images">Gambar:</label>
                            <input type="file" class="form-control" name="images" id="images_modal">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary saveChanges">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $("button#toggle-modal-1").fireModal({
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
                            }, 1000);
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
                    $.destroyModal(modal);
                }
            }]
        });

        // Request Income API
        $(document).ready(() => {
            var dataTable = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 4,
                //scrollX: true,
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
        // Update Data
        $('body').on('click', '#getEditId', function() {
            const header = document.querySelector('#header');
            let images_field = document.getElementById("images_modal")
            var income_id = $(this).data("id");
            $('#modal-edit').modal({
                show: true
            })
            $.get(`{{ route('income.index') }}/${income_id}`, (data) => {
                const {
                    nama_barang,
                    harga_barang,
                    qty,
                    total,
                    images,
                } = data
                header.innerText = "Edit Data " + nama_barang
                $('#nama_barang_modal').val(nama_barang);
                $('#harga_barang_modal').val(harga_barang);
                $('#qty_modal').val(qty);
                $('#total_modal').val(total);

                $('.saveChanges').click(() => {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: `{{ route('income.index') }}/${income_id}`,
                        method: 'PUT',
                        dataType: 'json',
                        data: $('#update_modal').serialize(),
                        success: function(result) {
                            $('#update_modal').trigger('reset')
                            $('#modal-edit').modal('hide')
                        },
                        error: () => {
                            form.stopProgress();
                        }
                    })
                })

            })
        })


        $('body').on('click', '#getDeleteId', function() {
            var income_id = $(this).data("id");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `{{ route('income.index') }}/${income_id}`,
                method: 'DELETE',
                success: function(result) {
                    confirm('Hapus Data ?')
                    $('.table').DataTable().ajax.reload()
                },
                error: () => {
                    form.stopProgress();
                }
            })
        })

    </script>
@endpush()
