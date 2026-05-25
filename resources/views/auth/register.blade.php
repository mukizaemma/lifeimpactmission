<x-guest-layout
    page-title="Register"
    brand-text="Create an admin account to help manage Impact Life Mission programs, events, and outreach content."
>
    <h2 class="ilm-auth-card__heading">Create account</h2>
    <p class="ilm-auth-card__subheading">Register for the Impact Life Mission admin panel</p>

    @if ($errors->any())
        <ul class="ilm-auth-errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="ilm-auth-field">
            <label for="name">Full name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <p class="ilm-auth-field__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="ilm-auth-field">
            <label for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <p class="ilm-auth-field__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="ilm-auth-field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <p class="ilm-auth-field__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="ilm-auth-field">
            <label for="password_confirmation">Confirm password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="ilm-auth-check">
                <input type="checkbox" name="terms" id="terms" required>
                <span>
                    <label for="terms" style="cursor:pointer;font-weight:400;">
                        I agree to the
                        <a href="{{ route('terms.show') }}" target="_blank">Terms</a> and
                        <a href="{{ route('policy.show') }}" target="_blank">Privacy Policy</a>
                    </label>
                </span>
            </div>
        @endif

        <button type="submit" class="ilm-auth-btn">Create account</button>
    </form>

    <div class="ilm-auth-footer">
        Already have an account? <a href="{{ route('login') }}">Sign in</a>
    </div>
</x-guest-layout>
