@extends('layouts.page')

@section('tab-title', 'Dashboard')

@section('header-custom')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="row mt-3">
    <span class="slot-name h3"><strong>Insight</strong></span>
    <x-cards.home text="Train Total" value="{{$train}}" unit="Unit" icon="fa-solid fa-train" />
    <x-cards.home text="Wagon Total" value="{{$wagon}}" unit="Unit" icon="fa-solid fa-tram" />
</div>
@endsection

@section('footer-custom')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            width: 'resolve'
        });
    });
</script>
@endsection
