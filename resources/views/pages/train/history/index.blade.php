@extends('layouts.page')

@section('tab-title', 'Water Outflow')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Water Outflow" href="{{ route('train.water.index', $train->id) }}" current="index" />
    <x-cards.fullpage>
        <x-slot name="header">
            <x-cards.header title="Water Outflow" />
        </x-slot>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Outflow</th>
                        <th>Time</th>
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
                ajax: "{{ route('train.water.index', $train->id) }}",
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
                        data: 'volume',
                        name: 'volume'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ]
            }, ...optionDatatables});
        })
    </script>
@endsection
