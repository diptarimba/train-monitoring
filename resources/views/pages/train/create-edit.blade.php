@extends('layouts.page')

@section('tab-title', 'Train')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Train" href="{{ route('train.index') }}" current="index" />
    <x-cards.single back="{{ route('train.index') }}">
        <x-slot name="header">
            <x-cards.header title="{{ request()->routeIs('train.create') ? 'Create Train' : 'Update Train' }}" />
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('train.create') ? route('train.store') : route('train.update', @$train->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <x-forms.put-method />
                <x-forms.input required="" label="Nama" name="name" :value="@$train->name" />
            </form>
            <button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
        </x-slot>
    </x-cards.single>
@endsection

@section('footer-custom')
@endsection
