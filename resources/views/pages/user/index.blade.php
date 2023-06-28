@extends('layouts.page')

@section('tab-title', ucfirst($statusAccount))

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="{{ucfirst($statusAccount)}}" href="{{ route('user.index') }}" current="index" />
    <x-cards.fullpage>
        <x-slot name="header">
            <x-cards.header title="{{ucfirst($statusAccount)}}" />
            <a class="btn btn-primary" href="{{ route('user.create', ['status' => request()->query('status') ]) }}">Tambah Data</a>
        </x-slot>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-cards.fullpage>
    <x-addon />
@endsection

@section('footer-custom')
    <script>
        var searchParams = new URLSearchParams(currentUrl);
        $(document).ready(() => {
            var table = $('.datatables-target-exec').DataTable({
                ...{
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: "{{ route('user.index') }}",
                    data: function(d){
                        d.status = searchParams.get('status') ?? null
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        sortable: false,
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            }, ...optionDatatables});
        })
    </script>
@endsection
