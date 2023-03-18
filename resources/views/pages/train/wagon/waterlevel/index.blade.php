@extends('layouts.page')

@section('tab-title', 'Water Level History')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Water Level History"
        href="{{ route('train.wagon.water.index', ['train' => $train->id, 'wagon' => $wagon->id]) }}" current="index" />
    <x-back route="{{ route('train.wagon.index', ['train' => $train->id]) }}" />
    <x-cards.fullpage>
        <x-slot name="header">
            <div class="flex-grow-1">
                <x-cards.header title="Water Level History of {{ $wagon->name }} on {{ $train->name }}" />
            </div>
            <div class="flex-grow-2">
                <input type="text" class="form-control" name="daterange" value="01/01/2023 - 01/31/2023" />
            </div>
        </x-slot>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec">
                    <thead>
                        <th>No</th>
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
            // mengambil URL saat ini
            let currentUrl = window.location.search;

            // membuat objek URLSearchParams dari URL saat ini
            let searchParams = new URLSearchParams(currentUrl);
        </script>
        <script>
            $(document).ready(() => {
                var table = $('.datatables-target-exec').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ route('train.wagon.water.index', ['train' => $train->id, 'wagon' => $wagon->id]) }}",
                        data: function(d) {
                            // Query ke datatables
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

        <script>
            $(function() {
                $('input[name="daterange"]').daterangepicker({
                        opens: 'left', // position of calendar popup
                        startDate: searchParams.get('start_date') ?? moment().startOf('month'), // initial start date
                        endDate: searchParams.get('end_date') ?? moment().endOf('month'), // initial end date
                        locale: {
                            format: 'YYYY-MM-DD' // date format
                        }
                    },
                    function(start, end, label) {
                        // menambahkan query string baru pada objek URLSearchParams
                        searchParams.set('start_date', start.format('YYYY-MM-DD'));
                        searchParams.set('end_date', end.format('YYYY-MM-DD'));

                        // melakukan redirect ke URL yang baru
                        window.location.search = searchParams.toString();
                    });
            });
        </script>
    @endsection
