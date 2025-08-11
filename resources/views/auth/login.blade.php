<x-guest-layout>
    <div class="min-h-screen flex"  style="background-color: #fff">

                <!-- Right Side: Image -->
        <div class="hidden md:flex w-1/2 bg-cover bg-center" style="background-image: url(`{{asset('storage\images').$setting->logo}}`);">
            <!-- Optional overlay -->
            <div class="w-full h-full bg-black bg-opacity-30 flex items-center justify-center">
                <h2 class="text-white text-3xl font-bold">Empowering Your Impact</h2>
            </div>
        </div>

        <!-- Left Side: Login Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6" >
            <x-jet-authentication-card>
                <x-slot name="logo">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">Welcome to Impact Life Mission Admin Panel</h1>
                </x-slot>

                <x-jet-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div>
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </div>

                    <div class="flex items-center justify-between">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-jet-button>
                            {{ __('Log in') }}
                        </x-jet-button>
                    </div>
                </form>
            </x-jet-authentication-card>
        </div>


    </div>
</x-guest-layout>
