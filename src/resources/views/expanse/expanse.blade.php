@extends('layouts.backend')

@section('title', 'Expanse')

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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('customJS')
    <script>
        $('#toggle-modal').fireModal({
            title: 'My Modal',
            content: 'Hello!'
        });
    </script>
@endpush()
