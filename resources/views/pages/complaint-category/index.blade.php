@extends('layouts.page')

@section('tab-title', 'Complaint Category')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Complaint Category" href="{{ route('complaint-category.index') }}" current="index" />
    <x-cards.fullpage>
        <x-slot name="header">
            <x-cards.header title="Complaint Category" />
            @if (Auth::user()->status == \App\Models\User::$ADMIN)
            <a class="btn btn-primary" href="{{ route('complaint-category.create') }}">Tambah Data</a>
            @endif
        </x-slot>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        @if (Auth::user()->status == \App\Models\User::$ADMIN)
                        <th>Action</th>
                        @endif
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
        $(document).ready(() => {
            var table = $('.datatables-target-exec').DataTable({
                ...{
                ajax: "{{ route('complaint-category.index') }}",
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
                    @if (Auth::user()->status == \App\Models\User::$ADMIN)
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    @endif
                ]
            }, ...optionDatatables});
        })
    </script>
@endsection
