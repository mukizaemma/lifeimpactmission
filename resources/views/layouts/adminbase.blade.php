<!DOCTYPE html>
<html lang="en">
    <head>
        @php
            $data = App\Models\Setting::first();
        @endphp

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Impact Life Mission Admin" />
        <title>{{ $title ?? 'Impact Life Mission - Dashboard' }}</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{ asset('assets/admin/css/styles.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <link href="{{ asset('assets/css/ilm-admin-upload.css') }}" rel="stylesheet">
        @livewireStyles
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" x-data>
            <a class="navbar-brand ps-3" href="{{ url('/redirects') }}" wire:navigate>Impact Life Mission</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" type="button">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="navbar-nav ms-auto me-3 me-lg-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}" target="_blank" rel="noopener">View Site</a>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('admin.includes.sidenav')
            </div>
            <div id="layoutSidenav_content">
                {{ $slot }}
                @include('admin.includes.footer')
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script src="{{ asset('assets/js/ilm-image-upload.js') }}"></script>
        @livewireScripts
        <script src="{{ asset('assets/js/ilm-admin-spa.js') }}"></script>
    </body>
</html>
