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
            <table class="table table table-bordered datatable">
                <tbody class="tbody" id="table-body">

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-expanse">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#toggle-modal').click(() => {
            $('#modal-expanse').modal({
                show: true
            })
        })

        $('.table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            "order": [
                [0, "desc"]
            ],
            ajax: 'http://localhost:8000/api/get-expanse',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nama_barang',
                    name: 'Nama Barang'
                },
                {
                    data: 'nama_sup',
                    name: 'nama_sup'
                },
                {
                    data: 'alamat_sub',
                    name: 'alamat_sub'
                },
                {
                    data: 'qty',
                    name: 'qty'
                },
                {
                    data: 'images',
                    name: 'images'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ]
        });


        $('body').on('click', '#getEditId', function() {
            var expanse_id = $(this).data("id");
            $('#modal-expanse').modal({
                show: true
            })
        })
    </script>
@endpush
