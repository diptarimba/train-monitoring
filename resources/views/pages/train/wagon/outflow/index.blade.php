@extends('layouts.page')

@section('tab-title', 'Outflow History')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Outflow History"
        href="{{ route('train.wagon.outflow.index', ['train' => $train->id, 'wagon' => $wagon->id]) }}" current="index" />
    <x-back route="{{ route('train.wagon.index', ['train' => $train->id]) }}" />
    <x-cards.fullpage>
        <x-slot name="header">
            <x-cards.header title="Outflow History of {{ $wagon->name }} on {{ $train->name }}" />
        </x-slot>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec">
                    <thead>
                        <th>No</th>
                        <th>Water Way</th>
                        <th>Value</th>
                        <th>Date</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </x-slot>
        </x-cards.single>
    @endsection

    @section('footer-custom')
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>
        <script>
            $(document).ready(() => {
                var table = $('.datatables-target-exec').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: "{{ route('train.wagon.outflow.index', ['train' => $train->id, 'wagon' => $wagon->id]) }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            sortable: false,
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'way',
                            name: 'way'
                        },
                        {
                            data: 'value',
                            name: 'value'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                    ]
                });
            })
        </script>
    @endsection
