<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
<div class="nav">

    <a class="nav-link" href="{{ url('/redirects') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-envelope"></i></div>
        Messages from Visitors
    </a>

    <a class="nav-link" href="{{ route('settings') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-cogs"></i></div>
        Contacts Settings
    </a>

    <a class="nav-link" href="{{ route('pageHeaders') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-image"></i></div>
        Page Headers
    </a>

    <a class="nav-link" href="{{ route('about') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-bullseye"></i></div>
        Mission & Vision
    </a>

    <a class="nav-link" href="{{ route('background') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-info-circle"></i></div>
        Project Background
    </a>

    {{-- <a class="nav-link" href="{{ route('programs') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-list-alt"></i></div>
        Programs
    </a> --}}

    <a class="nav-link" href="{{ route('getProjects') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-bullhorn"></i></div>
        Programs
    </a>

    <a class="nav-link" href="{{ route('mothersAdmin') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-female"></i></div>
        Mothers
    </a>

    {{-- <a class="nav-link" href="{{ route('getTestimonials') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-comment-dots"></i></div>
        Testimonials
    </a> --}}

    <hr>

    <a class="nav-link" href="{{ route('events') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-calendar-alt"></i></div>
        Events
    </a>

    <a class="nav-link" href="{{ route('blog.index') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-newspaper"></i></div>
        Updates
    </a>

    <a class="nav-link" href="{{ route('images') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-image"></i></div>
        Image Gallery
    </a>

    <a class="nav-link" href="{{ route('videosAdmin') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-video"></i></div>
        Video Gallery
    </a>

    <a class="nav-link" href="{{ route('slides') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-images"></i></div>
        Home Slide Images
    </a>
        <a class="nav-link" href="{{ route('partner') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-handshake"></i></div>
        Partners
    </a>
    
        <a class="nav-link" href="{{ route('staff') }}" wire:navigate>
        <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
        Staff Members
    </a>

</div>

    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Susper Admin
    </div>
</nav>
