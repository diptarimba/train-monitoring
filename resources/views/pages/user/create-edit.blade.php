@extends('layouts.page')

@section('tab-title', 'User')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="User" href="{{ route('user.index') }}" current="index" />
    <x-cards.single back="{{ route('user.index') }}">
        <x-slot name="header">
            <x-cards.header title="{{ request()->routeIs('user.create') ? 'Create User' : 'Update User' }}" />
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('user.create') ? route('user.store') : route('user.update', @$user->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @if (request()->routeIs('user.edit', 'me.index'))
                <div class="col-6 mx-auto">
                    <x-forms.view-image label="Avatar" src="{{ asset($user->avatar) }}" />
                </div>
                @endif
                <x-forms.put-method />
                <x-forms.file label="Foto Profile" name="avatar" id="gallery-photo-add"/>
                <div class="gallery row row-cols-2 justify-content-center" id="isi-gallery"></div>
                <x-forms.input required="" label="Nama" name="name" :value="@$user->name" />
                <x-forms.input required="" label="Username" name="username" :value="@$user->username" />
                <x-forms.input required="" label="Email" name="email" :value="@$user->email" />
                <x-forms.text password type="password" label="Password" name="password" :value="@$user->pass" />
            </form>
            <button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
        </x-slot>
    </x-cards.single>
@endsection

@section('footer-custom')
<script src="{{asset('assets/js/imageReview.js')}}"></script>
<script>
    $('#gallery-photo-add').on('change', function(){
        imagesPreview(this, 'div.gallery');
    })

    $('#gallery-photo-add').on('click', function(){
        let parent = document.getElementById("isi-gallery")
        while (parent.firstChild) {
            parent.firstChild.remove()
        }
    })
</script>
@endsection
