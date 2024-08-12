<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    @endpush
    @section('title', 'Confrim Password | GS')
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
    
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="container"></div>
            <div class="icon">
                <img src="{{ asset("image/logo2.png")}}" alt="Logo">
            </div>
            <h1 class="heading">Please confirm your password before continuing.</h1>
            <h1 class="heading2">This is a secure area of the application.</h1>
            <div class="value"></div>
                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            <div class="sign" style="margin-bottom:2vw;">
                <button type="submit">
                    {{ __('Confirm') }}
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
