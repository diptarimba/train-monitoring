@extends('layouts.page')

@section('tab-title', 'Complaint Category')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Complaint Category" href="{{ route('complaint-category.index') }}" current="index" />
    <x-cards.single back="{{ route('complaint-category.index') }}">
        <x-slot name="header">
            <x-cards.header title="{{ request()->routeIs('complaint-category.create') ? 'Create Complaint Category' : 'Update Complaint Category' }}" />
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('complaint-category.create') ? route('complaint-category.store') : route('complaint-category.update', @$complaintCategory->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <x-forms.put-method />
                <x-forms.input required="" label="Nama" name="name" :value="@$complaintCategory->name" />
            </form>
            <button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
        </x-slot>
    </x-cards.single>
@endsection

@section('footer-custom')
@endsection
