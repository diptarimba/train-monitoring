@extends('layouts.page')

@section('tab-title', 'Wagon')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Wagon" href="{{ route('train.wagon.index', $train->id) }}" current="index" />
    <x-cards.single back="{{ route('train.wagon.index', $train->id) }}">
        <x-slot name="header">
            <x-cards.header title="{{ request()->routeIs('train.wagon.create', $train->id) ? 'Create Wagon' : 'Update Wagon' }}" />
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('train.wagon.create') ? route('train.wagon.store', $train->id) : route('train.wagon.update', ['train' => $train->id, 'wagon' => $wagon->id]) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <x-forms.put-method />
                <x-forms.input required="" label="Nama" name="name" :value="@$wagon->name" />
            </form>
            <button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
        </x-slot>
    </x-cards.single>
@endsection

@section('footer-custom')
@endsection
