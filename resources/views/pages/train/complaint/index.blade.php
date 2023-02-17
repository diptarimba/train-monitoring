@extends('layouts.page')

@section('tab-title', 'Train Complaint')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Train" href="{{ route('complaint.index') }}" current="index" />
    <x-cards.fullpage>
        <x-slot name="header">
            <x-cards.header title="Train" />
        </x-slot>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Content</th>
                        <th>Action</th>
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
                    ajax: "{{ route('complaint.index') }}",
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
                            data: 'content',
                            name: 'content',
                            render: function(data) {
                                if (data) {
                                    return (data.length > 40) ? data.substring(0, 40) + '...' : data;
                                } else {
                                    return '';
                                }
                            },
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            })
        </script>
    @endsection
