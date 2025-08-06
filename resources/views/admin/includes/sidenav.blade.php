<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
<div class="nav">

    <a class="nav-link" href="{{ url('/redirects') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-envelope"></i></div>
        Messages from Visitors
    </a>

    <a class="nav-link" href="{{ route('settings') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-cogs"></i></div>
        Contacts Settings
    </a>

    <a class="nav-link" href="{{ route('about') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-bullseye"></i></div>
        Mission & Vision
    </a>

    <a class="nav-link" href="{{ route('background') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-info-circle"></i></div>
        Project Background
    </a>

    <a class="nav-link" href="{{ route('programs') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-list-alt"></i></div>
        Programs
    </a>

    <a class="nav-link" href="{{ route('getProjects') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-bullhorn"></i></div>
        Projects
    </a>

    <a class="nav-link" href="{{ route('getTestimonials') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-comment-dots"></i></div>
        Events
    </a>

    {{-- <a class="nav-link" href="{{ route('impact') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-chart-line"></i></div>
        Our Impacts
    </a> --}}

    <a class="nav-link" href="{{ route('partner') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-handshake"></i></div>
        Partners
    </a>

    <a class="nav-link" href="{{ route('staff') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
        Staff Members
    </a>

    {{-- <a class="nav-link" href="{{ route('students') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-user-graduate"></i></div>
        Students
    </a> --}}

    <hr>

    <a class="nav-link" href="{{ route('events') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-calendar-alt"></i></div>
        Events
    </a>

    <a class="nav-link" href="{{ route('blog.index') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-newspaper"></i></div>
        Updates
    </a>

    <a class="nav-link" href="{{ route('images') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-image"></i></div>
        Gallery
    </a>

    <a class="nav-link" href="{{ route('slides') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-images"></i></div>
        Home Slide Images
    </a>

</div>

    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Susper Admin
    </div>
</nav>
