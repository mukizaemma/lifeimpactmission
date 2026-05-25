<x-guest-layout
    page-title="Sign In"
    brand-text="Sign in to manage content, events, partners, and keep our mission reaching the next generation."
>
    <h2 class="ilm-auth-card__heading">Welcome back</h2>
    <p class="ilm-auth-card__subheading">Sign in to the Impact Life Mission admin panel</p>

    @if (session('status'))
        <div class="ilm-auth-alert ilm-auth-alert--success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <ul class="ilm-auth-errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="ilm-auth-field">
            <label for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <p class="ilm-auth-field__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="ilm-auth-field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <p class="ilm-auth-field__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="ilm-auth-check">
            <input type="checkbox" name="remember" id="remember_me" {{ old('remember') ? 'checked' : '' }}>
            <span><label for="remember_me" style="cursor:pointer;font-weight:400;">Remember me</label></span>
        </div>

        <button type="submit" class="ilm-auth-btn">Sign in</button>

        <div class="ilm-auth-links-row" style="margin-top: 1.25rem; margin-bottom: 0;">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot password?</a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Create account</a>
            @endif
        </div>
    </form>

    <div class="ilm-auth-footer">
        <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back to website</a>
    </div>
</x-guest-layout>
