@extends('layouts.page')

@section('tab-title', 'Water Outflow History')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Water Outflow History"
        href="{{ route('train.wagon.outflow.index', ['train' => $train->id, 'wagon' => $wagon->id]) }}" current="index" />
    <x-back route="{{ route('train.wagon.index', ['train' => $train->id]) }}" />
    <x-cards.fullpage>
        <x-slot name="header">
            <div class="flex-grow-1">
                <x-cards.header title="Water Outflow History of {{ $wagon->name }} on {{ $train->name }}" />
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
                        <th>Value (L)</th>
                        <th>Duration</th>
                        <th>Outflow Date Time</th>
                        <th>Data Input Date</th>
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
        optionDatatables.buttons.push({
            text: '<i class="fa fa-line-chart"></i> Chart',
            className: 'btn btn-outline-primary',
            action: function(e, dt, button, config) {
                window.location =
                    '{{ route('train.wagon.outflow.chart', ['train' => $train->id, 'wagon' => $wagon->id]) }}';
            }
        })
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
                            data: 'duration',
                            name: 'duration',
                            render: function(data, type, full, meta) {
                                var openDate = moment(full.open_date);
                                var closeDate = moment(full.close_date);
                                var duration = moment.duration(closeDate.diff(openDate));
                                var hours = Math.floor(duration.asHours());
                                var minutes = Math.floor(duration.asMinutes()) - hours * 60;
                                var seconds = Math.floor(duration.asSeconds()) - hours * 3600 -
                                    minutes * 60;
                                return hours + " jam " + minutes + " menit " + seconds + " detik";
                            }
                        },{
                            data: 'outflow_date',
                            name: 'outflow_date',
                            render: function(data, type, full, meta) {
                                var openDate = moment(full.open_date);
                                var closeDate = moment(full.close_date);
                                return full.open_date + " - " + full.close_date;
                            }

                        },{
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
