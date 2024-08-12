<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    @endpush
    @section('title', 'Login | GS')

    <form method="POST" action="{{ route('login') }}" autocomplete="new-password">
    @csrf
    <div class="container">
        <!-- Email Address -->
        <div class="icon">
             <img src="{{ asset("image/logo2.png")}}" alt="Logo">
        </div>
        <h1 class="heading">Sign In</h1>
        <div class="value">
            <div>
                <label for="email" >Email Address</label>
                <input id="email" type="email" name="email" :value="old('email')" placeholder="Email Address" autocomplete="new-password" required>
                <x-input-error :messages="$errors->get('email')" class="error" />
            </div>
            <!-- Password -->
            <div>
                <label for="password" >Password</label>
                <input id="password" type="password" name="password" placeholder="Password" autocomplete="new-password" required >
                <x-input-error :messages="$errors->get('password')" class="error" />
                
            </div>
        </div>
        <!-- Remember Me -->
         <div class="rememberbtn">
            <label for="remember_me">
            <input id="remember_me" type="checkbox" name="remember">
                Remember Me
            </label>
        </div>
        <div class="sign">
            <button type="submit">
                {{ __('Sign In') }}
            </button>
        </div>
        <div class="forgot">
         @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
        <div class="other_container">
            <h1>Or Sign With</h1>
            <div class="opt">
                <a href="">+</a>
                <a href="">+</a>
                <a href="">+</a>
                <a href="">+</a>
                <a href="">+</a>
                <a href="">+</a>
                <a href="">+</a>
                <a href="">+</a>
            </div>
        </div>
        <div class="reg"> 
            <h1>Don't have a Account</h1>
            <a href="{{ route('register') }}">
                {{ __('Create Account') }}
            </a>
        </div>
    </div>
    </form>
</x-app-layout>
