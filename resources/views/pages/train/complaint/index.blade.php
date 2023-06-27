@extends('layouts.page')

@section('tab-title', 'Train Complaint')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Train Complaint" href="{{ route('complaint.index') }}" current="index" />
    <x-cards.fullpage>
        <x-slot name="header">
            <div class="flex-grow-1">
                <x-cards.header title="Train Complaint" />
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
                        <th>Date</th>
                        <th>Category</th>
                        <th>Wagon</th>
                        <th>Train</th>
                        <th>Name</th>
                        <th>Content</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-cards.fullpage>
    <x-addon needrange="true">
        <x-slot name="titlepage">
            Train Complaint
        </x-slot>
    </x-addon>
@endsection

@section('footer-custom')
    <script>
        $(document).ready(() => {
            var table = $('.datatables-target-exec').DataTable({
                ...{
                    ajax: {
                        url: "{{ route('complaint.index') }}",
                        data: function(d) {
                            d.start_date = searchParams.get('start_date') ?? null
                            d.end_date = searchParams.get('end_date') ?? null
                        }
                    },
                    columns: [{
                            class: 'details-control',
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            sortable: false,
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data, type, row) {
                                return moment(data).format('D MMMM YYYY HH:mm:ss');
                            }
                        },
                        {
                            data: 'category.name',
                            name: 'category.name'
                        },
                        {
                            data: 'wagon.name',
                            name: 'wagon.name'
                        },
                        {
                            data: 'wagon.train.name',
                            name: 'wagon.train.name'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'content',
                            name: 'content',
                            // render: function(data) {
                            //     if (data) {
                            //         return (data.length > 40) ? data.substring(0, 40) + '...' :
                            //         data;
                            //     } else {
                            //         return '';
                            //     }
                            // },
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                },
                ...optionDatatables
            });

        })
    </script>
@endsection
