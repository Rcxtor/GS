<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    @endpush
    @section('title', 'Register | GS')
    <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="container">
        <div class="icon">
            <img src="{{ asset("image/logo2.png")}}" alt="Logo">
        </div>
        <h1 class="heading" style="font-size:2vw; margin-top:-1vw;">Register</h1>
        <div class="value">
            <!-- Name -->
            <div>
                <label for="name">Name</label>
                <input id="name" type="text" name="name" required/>
                <!-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> -->
            </div>

            <!-- Userame -->
            <div>
                <x-input-label for="username" :value="__('Username')" />
                <input id="username" type="text" name="username" required/>
                <!-- <x-input-error :messages="$errors->get('username')" class="mt-2" /> -->
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <input id="email" type="email" name="email" :value="old('email')" required />
                <!-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> -->
            </div>

            <!-- DOB -->
            <div>
                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                <input id="date_of_birth" type="date" name="date_of_birth"/>
                <!-- <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" /> -->
            </div>

            <!-- Phone -->
            <div>
                <x-input-label for="phone_number" :value="__('Phone')" />
                <input id="phone_number" type="number" name="phone_number"/>
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>
            <!-- Gender -->
            <div>
                <x-input-label for="gender" :value="__('Gender')" />
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="MENTALLY RETARD">MENTALLY RETARD</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <input id="password"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <input id="password_confirmation"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>
        <div class="sign">
            <button type="submit">
                {{ __('Register') }}
            </button>
        </div>
        <div class="reg"> 
            <h1 style="margin-top:1vw;">Already registered?</h1>
            <a href="{{ route('login') }}">
                {{ __('Sign In ') }}
            </a>
        </div>
    </div>
    </form>
    </x-app-layout>