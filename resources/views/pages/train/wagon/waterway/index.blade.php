@extends('layouts.page')

@section('tab-title', 'Water Ways')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Water Ways"
        href="{{ route('train.wagon.ways.index', ['train' => $train->id, 'wagon' => $wagon->id]) }}" current="index" />
    <x-back route="{{ route('train.wagon.index', ['train' => $train->id]) }}" />
    <x-cards.fullpage>
        <x-slot name="header">
            <x-cards.header title="{{ $train->name }}'s Water Ways" />
            <a class="btn btn-primary"
                href="{{ route('train.wagon.ways.create', ['train' => $train->id, 'wagon' => $wagon->id]) }}">Tambah Data</a>
        </x-slot>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
                    <thead>
                        <th>No</th>
                        <th>Wagon</th>
                        <th>Way</th>
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
        $(document).ready(() => {
            var table = $('.datatables-target-exec').DataTable({
                ...{
                ajax: "{{ route('train.wagon.ways.index', ['train' => $train->id, 'wagon' => $wagon->id]) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        sortable: false,
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'wagon',
                        name: 'wagon'
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
