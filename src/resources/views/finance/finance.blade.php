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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga Barang</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Total</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id='modal-finance'>
        <form class="">
            <div class="form-group">
                <label>Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
            </div>
            <button class="d-none" id="fire-modal-5-submit"></button>
        </form>
    </div>
@endsection
@push('customJS')
    <script>
        $("#toggle-modal").fireModal({
            title: 'Finance Tambah Data',
            body: $("#modal-finance"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                // Form Data
                let form_data = $(e.target).serialize();
                console.log(e.target.email.value)

                // DO AJAX HERE
                let fake_ajax = setTimeout(function() {
                    form.stopProgress();
                    modal.find('.modal-body').prepend(
                        '<div class="alert alert-info">Please check your browser console</div>')

                    clearInterval(fake_ajax);
                }, 1500);

                e.preventDefault();
            },
            shown: function(modal, form) {
                console.log(typeof form)
            },
            buttons: [{
                text: 'Login',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {}
            }]
        });
    </script>
@endpush()
