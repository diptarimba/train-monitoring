@extends('layouts.page')

@section('tab-title', 'Complaint')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Complaint" href="{{ route('complaint.index') }}" current="index" />
    <x-cards.single back="{{ route('complaint.index') }}">
        <x-slot name="header">
            <x-cards.header title="{{ request()->routeIs('complaint.create') ? 'Create Complaint' : 'View Complaint' }}" />
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('complaint.create') ? route('complaint.store') : route('complaint.update', @$complaint->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <x-forms.put-method />
                <x-forms.textarea rows="5" label="Content" name="content" :value="@$complaint->content" />
            </form>
        </x-slot>
    </x-cards.single>
@endsection

@section('footer-custom')
@endsection
