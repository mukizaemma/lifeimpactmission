<x-guest-layout
    page-title="Confirm Password"
    brand-text="Please confirm your password before continuing to this secure area."
>
    <h2 class="ilm-auth-card__heading">Confirm password</h2>
    <p class="ilm-auth-card__subheading">This is a secure area. Please confirm your password to continue.</p>

    @if ($errors->any())
        <ul class="ilm-auth-errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="ilm-auth-field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <p class="ilm-auth-field__error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="ilm-auth-btn">Confirm</button>
    </form>
</x-guest-layout>
