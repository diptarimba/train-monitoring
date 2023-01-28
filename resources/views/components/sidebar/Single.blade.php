<li class="nav-item {{ $currentsite ? 'active' : '' }}">
    <a href="{{$href}}" class="nav-link">
        <span class="sidebar-icon">
            <i class="{{ $icons }} me-2"></i>
        </span>
        <span class="sidebar-text">{{ $title }}</span>
    </a>
</li>
