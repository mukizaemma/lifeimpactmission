<x-guest-layout
    page-title="Forgot Password"
    brand-text="We will email you a secure link to reset your password and get you back into the admin panel."
>
    <a href="{{ route('login') }}" class="ilm-auth-back"><i class="fas fa-arrow-left"></i> Back to sign in</a>

    <h2 class="ilm-auth-card__heading">Reset password</h2>
    <p class="ilm-auth-card__subheading">
        Enter your email address and we will send you a link to choose a new password.
    </p>

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

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="ilm-auth-field">
            <label for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <p class="ilm-auth-field__error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="ilm-auth-btn">Send reset link</button>
    </form>

    <div class="ilm-auth-footer">
        Remember your password? <a href="{{ route('login') }}">Sign in</a>
    </div>
</x-guest-layout>
