<x-guest-layout
    page-title="New Password"
    brand-text="Choose a strong new password to secure your Impact Life Mission admin account."
>
    <h2 class="ilm-auth-card__heading">Set new password</h2>
    <p class="ilm-auth-card__subheading">Enter your email and choose a new password below.</p>

    @if ($errors->any())
        <ul class="ilm-auth-errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="ilm-auth-field">
            <label for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
            @error('email')
                <p class="ilm-auth-field__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="ilm-auth-field">
            <label for="password">New password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <p class="ilm-auth-field__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="ilm-auth-field">
            <label for="password_confirmation">Confirm new password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="ilm-auth-btn">Reset password</button>
    </form>

    <div class="ilm-auth-footer">
        <a href="{{ route('login') }}"><i class="fas fa-arrow-left"></i> Back to sign in</a>
    </div>
</x-guest-layout>
