@extends('layouts.master')

@section('header')
    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="{{ asset('vendor/notyf/notyf.min.css') }}" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">

    <!-- Datatables Bootstrap5 CSS -->
    <link type="text/css" href="{{ asset('css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    <!-- DatePicker BS5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" rel="stylesheet">


    @yield('header-custom')
@endsection

@section('body')

    @component('components.sidebar')
        <x-slot name="head">
            <x-sidebar.ProfileInfo src="{{ Auth::user()->avatar }}" name="{!! Auth::user()->name !!}" nameButton="Sign Out"
                linkButton="{{ route('logout.index') }}" />
        </x-slot>
    @endcomponent

    <main class="content">

        @component('components.topbar')
        @endcomponent

        @yield('breadcrumb')

        {{-- Success Alert --}}
        @if (session('success'))
            <x-alert type="success" msg="{{ session('success') }}" />
        @endif

        {{-- Error Alert --}}
        @if (session('error'))
            <x-alert type="danger" msg="{{ session('error') }}" />
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible show fade mt-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')

        @component('components.setting')
        @endcomponent

        @component('components.footer')
        @endcomponent

    </main>
@endsection

@section('footer')
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Core -->
    <script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ asset('vendor/nouislider/dist/nouislider.min.js') }}"></script>

    <!-- Smooth scroll -->
    <script src="{{ asset('vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Charts -->
    <script src="{{ asset('vendor/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>

    <!-- Datepicker -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

    <!-- Notyf -->
    <script src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>

    <!-- Simplebar -->
    <script src="{{ asset('vendor/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Github buttons -->
    <script async defer src="{{ asset('assets/js/buttons.js') }}"></script>

    <!-- Volt JS -->
    <script src="{{ asset('assets/js/volt.js') }}"></script>

    <!-- FontAwesome -->
    <script src="{{ asset('assets/js/fontawesome.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/fontawesome.regular.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        function delete_data(identify) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $(`#${identify}`).submit();
                }
            })
        }
    </script>
    <script>
        // mengambil URL saat ini
        let currentUrl = window.location.search;

        // membuat objek URLSearchParams dari URL saat ini
        let searchParams = new URLSearchParams(currentUrl);

        $(function() {
            $('input[name="daterange"]').daterangepicker({
                    opens: 'left', // position of calendar popup
                    startDate: searchParams.get('start_date') ?? moment().startOf(
                    'month'), // initial start date
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
    @yield('footer-custom')
@endsection
