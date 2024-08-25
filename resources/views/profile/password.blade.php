<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
    @endpush
    <style>
        .sep
        {
            border: 1px solid rgb(27,27,27);
            height: 30vw;
        }
        .main-container
        {
            /* border: 2px solid white; */
            height: 30vw;
            width: 49.5vw;
            background-color: rgb(27,27,27);
            position: relative;
        }
    </style>
    @section('title',  ucfirst($user->username).' | GS')
    <div class="side-column">
        <x-nav-link href="{{route('profile.edit')}}" :active="request()->routeIs('profile.edit')">
            Account Settings
        </x-nav-link>
        <x-nav-link href="{{route('profile.password')}}" :active="request()->routeIs('profile.password')">
            Password & Security
        </x-nav-link>
        <a href="">Transactions</a>
        <a href="">Redeem Code</a>
    </div>
    <div class="sep"></div>
    
    <div class="main-container">
        <img src="{{ asset('image/test2.png')}}">
        <h1 class="main-heading">Change Your Password</h1>
        <h2 class="main-info">For security, we highly recommend that you choose a strong unique password</h2>
        <h1 class="delete-heading">Current Password</h1>
        <div class="input-type2">
            <input>
        </div>
        <h1 class="personal-heading">New Password</h1>
        <div class="input-type2">
            <input>
        </div>
        <div class="input-type2">
            <input>
        </div>
        <button class="save-button">Save Change</button> 
    </div>

</x-app-layout>
