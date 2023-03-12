@extends('layouts.page')

@section('tab-title', 'Water Way')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Water Way" href="{{ route('train.wagon.ways.index', ['train' => $train->id, 'wagon' => $wagon->id]) }}" current="index" />
    <x-cards.single back="{{ route('train.wagon.ways.index', ['train' => $train->id, 'wagon' => $wagon->id]) }}">
        <x-slot name="header">
            <x-cards.header title="{{ request()->routeIs('train.wagon.ways.create', ['train' => $train->id, 'wagon' => $wagon->id] ) ? 'Create Water Way' : 'Update Water Way' }}" />
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('train.wagon.ways.create') ? route('train.wagon.ways.store', ['train' => $train->id, 'wagon' => $wagon->id]) : route('train.wagon.ways.update', ['train' => $train->id, 'wagon' => $wagon->id, 'way' => $way->id]) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <x-forms.put-method />
                <x-forms.input required="" label="Nama" name="name" :value="@$way->name" />
            </form>
            <button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
        </x-slot>
    </x-cards.single>
@endsection

@section('footer-custom')
@endsection
