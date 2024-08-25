<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
    @endpush
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
        <h1 class="main-heading">Account Settings</h1>
        <h2 class="main-info">Manage your account's details.</h2>
        <h1 class="account-heading">Account Information</h1>
        <h2 class="account-info">ID: 21101341</h2>
        <div style="display:flex; gap:0.04vw;">
            <div class="input-type1">
                <label for="username">Username</label>
                <input  type="text" id="username"  placeholder="Rcxtor">
                <button></button>
            </div>
            <div class="input-type1">
                <label for="email">Email</label>
                <input type="text" id="email"  placeholder="sefat64@gmail.com">
                <button></button>
            </div>
        </div>   
        <h1 class="personal-heading">Personal Details</h1> 
        <h2 class="personal-info">Manage your name and contact info.</h2>  
        <div style="display:flex; gap:0.15vw;">
            <div class="input-type2">
                <label for="name">Full Name</label>
                <input id="name" placeholder="Saif Ahmed">
            </div>
            <div class="input-type2">
                <label for="phone">Contact Number</label>
                <input id="phone" placeholder="01533499409">
            </div>
        </div>  
        <h1 class="address-heading">Address</h1> 
        <input placeholder="Address Line" class="input-type3">
        <div style="display:flex; gap:0.15vw;">
            <div class="input-type2">
                <input placeholder="City">
            </div>
            <div class="input-type2">
                <input placeholder="State">
            </div>
        </div>
        <div class="input-type2">
            <input placeholder="Country">
        </div>
        <button class="save-button"> Save Change</button> 
        <h1 class="delete-heading">Delete Account</h1>
        <h2 class="delete-info">If you request to delete account your account will be permanently deleted. You will need to create account again.</h2>
        <button class="delete-button">Delete Account</button> 

    </div>

</x-app-layout>
