{{-- <x-sidebarPHC>

</x-sidebarPHC> --}}
<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="../../index.html">
        <img class="navbar-brand-dark" src="{{ asset('assets/img/brand/light.svg') }}" alt="Volt logo" /> <img
            class="navbar-brand-light" src="{{ asset('assets/img/brand/dark.svg') }}" alt="Volt logo" />
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            {{ $head }}
            <x-sidebar.Toolbar />
        </div>
        <ul class="nav flex-column pt-3 pt-md-0">
            {{ $slot }}
            <x-sidebar.HeaderLogo title="{{ config('app.name') }}" href="#"
                src="{{ asset('assets/img/brand/light.svg') }}" />
            <x-sidebar.sparator />
            <x-sidebar.Single icons="fa-solid fa-house-user" title="Home" href="{{ route('home.index') }}"
                currentsite="{{ Request()->is('/') ? true : false }}" />
            <x-sidebar.Single icons="fa-solid fa-train fa-fw" title="Train" href="{{ route('train.index') }}"
                currentsite="{{ Request()->is('train', 'train/*') ? true : false }}" />
            @if (Auth::user()->status == 'ADMIN')
                <x-sidebar.sparator />
            <x-sidebar.Single icons="fa-solid fa-user fa-fw" title="Admin"
                href="{{ route('user.index', ['status' => 'ADMIN']) }}"
                currentsite="{{ request()->query('status') === 'ADMIN' ? true : false }}" />

            <x-sidebar.Single icons="fa-solid fa-user fa-fw" title="User"
                href="{{ route('user.index', ['status' => 'USER']) }}"
                currentsite="{{ request()->query('status') === 'USER' ? true : false }}" />
                @endif
            <x-sidebar.sparator />
            @if (Auth::user()->status == 'ADMIN')
            <x-sidebar.Single icons="fa-solid fa-tag fa-fw" title="Complaint Category"
                href="{{ route('complaint-category.index') }}"
                currentsite="{{ Request()->is('complaint-category', 'complaint-category/*') ? true : false }}" />
                @endif
            <x-sidebar.Single icons="fa-solid fa-file-import fa-fw" title="Complaint List"
                href="{{ route('complaint.index') }}"
                currentsite="{{ Request()->is('complaint', 'complaint/*') ? true : false }}" />
        </ul>
    </div>
</nav>
