@extends('layouts.backend')

@section('title', 'Finance')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Finance</h4>
        </div>
        <div class="card-body">
            <button class="btn btn-warning mt-2 mb-3" type="button" id="toggle-modal">
                Edit
            </button>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                <strong>Success!</strong>Article was added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="id" value={{ $income->id }}>
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" value={{ $income->nama_barang }}
                    disabled>
            </div>
            <div class="form-group">
                <label for="harga_barang">Harga Barang:</label>
                <input type="text" class="form-control" name="harga_barang" id="harga_barang"
                    value={{ $income->harga_barang }} disabled>
            </div>
            <div class="form-group">
                <label for="qty">qty:</label>
                <input type="text" class="form-control" name="qty" id="qty" value={{ $income->qty }} disabled>
            </div>
            <div class="form-group">
                <label for="total">total:</label>
                <input type="text" class="form-control" name="total" id="total"
                    value={{ $income->qty * $income->harga_barang }} disabled>
            </div>
            <div class="form-group text-center">
                <img src="{{ asset('storage/uploads/' . $income->images) }}" alt="" height="300" width="300">
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <form enctype="multipart/form-data" id="form-edit" method="get">
        @method('PUT')
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
            <label for="nama_barang_modal">Nama Barang:</label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang_modal">
        </div>
        <div class="form-group">
            <label for="harga_barang_modal">Harga Barang:</label>
            <input type="text" class="form-control" name="harga_barang" id="harga_barang_modal">
        </div>
        <div class="form-group">
            <label for="qty_modal">qty:</label>
            <input type="text" class="form-control" name="qty" id="qty_modal">
        </div>
        <div class="form-group">
            <label for="total">total:</label>
            <input type="text" class="form-control" name="total" id="total_modal"
                value={{ $income->qty * $income->harga_barang }} readonly>
        </div>
        <div class="form-group">
            <label for="images_modal">Gambar:</label>
            <input type="file" class="form-control" name="images" id="images_modal">
        </div>
    </form>
@endsection

@push('js')
    <script>
        $("#toggle-modal").fireModal({
            title: 'Income Update Data',
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
                const id = $('input[name=id]').val()
                let form_data = new FormData();
                form_data.set('nama_barang', $('#nama_barang_modal').val())
                form_data.set('harga_barang', $('#harga_barang_modal').val())
                form_data.set('qty', $('#qty_modal').val())
                form_data.set('total', $('#total_modal').val())


                $.ajax({
                    url: "/income/" + id,
                    method: 'PUT',
                    data: {
                        nama_barang: $('#nama_barang_modal').val(),
                        harga_barang: $('#harga_barang_modal').val(),
                        qty: $('#qty_modal').val(),
                        total: $('#total_modal').val(),
                    },
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
                class: 'btn btn-warning',
                handler: function(modal) {
                    $.destroyModal(modal);
                }
            }]
        });

    </script>
@endpush()
