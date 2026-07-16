@php
    $authSetting = $setting ?? \App\Models\Setting::first();
    $logoUrl = $authSetting?->logo ? asset('storage/images/' . ltrim($authSetting->logo, '/')) : null;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'Admin' }} — Impact Life Mission</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ $logoUrl ?? asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ilm-auth.css') }}">
    @stack('head')
</head>
<body class="ilm-auth-body">
    <div class="ilm-auth">
        <aside class="ilm-auth-brand" aria-hidden="false">
            <div class="ilm-auth-brand__inner">
                @if($logoUrl)
                    <div class="ilm-auth-brand__logo">
                        <img src="{{ $logoUrl }}" alt="Impact Life Mission">
                    </div>
                @endif
                <h1 class="ilm-auth-brand__title">Impact Life Mission</h1>
                <p class="ilm-auth-brand__text">
                    {{ $brandText ?? 'Admin portal for managing programs, events, updates, and the stories that transform lives across Rwanda.' }}
                </p>
            </div>
        </aside>

        <main class="ilm-auth-main">
            <div class="ilm-auth-card">
                @if($logoUrl)
                    <div class="ilm-auth-card__logo-mobile">
                        <img src="{{ $logoUrl }}" alt="Impact Life Mission">
                    </div>
                @endif
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
