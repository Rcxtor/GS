<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    @endpush
    @section('title', 'Forgot Password | GS')
    <style>
    .container .heading2
    {
        color:rgb(157,157,157);
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        font-weight: 100;
        font-size: 0.8vw;
        width: 80%;
        text-align: center;
        margin-top: -0.5vw;
    }
    </style>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="container">
            <div class="icon">
                <img src="{{ asset("image/logo2.png")}}" alt="Logo">
            </div>
            <h1 class="heading">Forgot your password?</h1>
            <h1 class="heading2">Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</h1>
            <div class="value">
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>
            <div class="sign" style="margin-bottom:2vw;">
                <button type="submit">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </div>
    </form>
</x-app-layout-layout>
