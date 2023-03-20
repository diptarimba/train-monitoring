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
            <div class="flex-grow-1">
                <x-cards.header title="Outflow History of {{ $wagon->name }} on {{ $train->name }}" />
            </div>
            <div class="flex-grow-2">
                <input type="text" class="form-control" name="daterange" value="01/01/2023 - 01/31/2023" />
            </div>
        </x-slot>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
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
    </x-cards.fullpage>
    <x-addon needrange="true">
        <x-slot name="titlepage">
            Outflow History of {{ $wagon->name }} on {{ $train->name }}
        </x-slot>
    </x-addon>
@endsection

@section('footer-custom')
    <script>
        $(document).ready(() => {
            var table = $('.datatables-target-exec').DataTable({
                ...{
                    ajax: {
                        url: "{{ route('train.wagon.outflow.index', ['train' => $train->id, 'wagon' => $wagon->id]) }}",
                        data: function(d) {
                            d.start_date = searchParams.get('start_date') ?? null
                            d.end_date = searchParams.get('end_date') ?? null
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
                            data: 'water_way.name',
                            name: 'water_way.name',
                        },
                        {
                            data: 'value',
                            name: 'value'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data, type, full, meta) {
                                return moment(data).format("DD-MM-YYYY HH:mm:ss")
                            }
                        },
                    ]
                },
                ...optionDatatables
            });
        })
    </script>
@endsection
