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
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            <img src="{{ asset('image/test2.png')}}">
            <h1 class="main-heading">Account Settings</h1>
            <h2 class="main-info">Manage your account's details.</h2>
            <h1 class="account-heading">Account Information</h1>
            <h2 class="account-info">ID: {{$user->id}}
                @if ($user->role === "admin")   
                    ({{ucfirst($user->role)}})           
                @endif
            </h2>
            <div style="display:flex; gap:0.04vw;">
                <div class="input-type1">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{old('username', $user->username)}}" required>
                    <x-input-error :messages="$errors->get('username')" class="custom-error" />
                    <button type="submit"></button>
                </div>
                <div class="input-type1">
                    <label for="email">Email</label>
                    <input type="text" id="email"  name="email" value="{{old('email', $user->email)}}" required>
                    <x-input-error :messages="$errors->get('email')" class="custom-error" />
                    <button type="submit"></button>
                </div>
            </div>   
            <h1 class="personal-heading">Personal Details</h1> 
            <h2 class="personal-info">Manage your name and contact info.</h2>  
            <div style="display:flex; gap:0.15vw;">
                <div class="input-type2">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{old('name', $user->name)}}" required>
                </div>
                <div class="input-type2">
                    <label for="phone_number">Contact Number</label>
                    <input type="number" id="phone_number" name="phone_number" value="{{old('phone_number', $user->phone_number)}}" required>
                    <x-input-error :messages="$errors->get('phone_number')" class="custom-error" />
                </div>
            </div>  
            <h1 class="address-heading">Address {{$user->address}}</h1> 
            @foreach ($user->addresses as $address)
                <input placeholder="Address Line" value="{{ old('address_line', $address->address_line ?? 'N/A') }}" class="input-type3">
                <div style="display:flex; gap:0.15vw;">
                    <div class="input-type2">
                        <input value="{{ old('city', $address->city ?? 'N/A') }}" placeholder="City">
                    </div>
                    <div class="input-type2">
                        <input value="{{ old('state', $address->state ?? 'N/A') }}" placeholder="State">
                    </div>
                </div>
                <div class="input-type2">
                    <input value="{{ old('country', $address->country ?? 'N/A') }}" placeholder="Country">
                </div>
            @endforeach
            <button class="save-button" type="sumbit"> Save Change</button> 
        </form>
        <h1 class="delete-heading">Delete Account</h1>
        <h2 class="delete-info">If you request to delete account your account will be permanently deleted. You will need to create account again.</h2>
        <button class="delete-button" type="button" onclick="openModal()">Delete Account</button>
    </div>

    <div id="shadow-overlay" class="shadow-overlay"></div>
    <div id="delete-modal" class="delete-form">
    <form method="post" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')
        <h1 class="modal-heading">Are you sure you want to delete your account?</h1>
        <h1 class="modal-info">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</h1>
        <div class="input-type2">
            <input id="password" name="password" type="password" placeholder="Confrim Password">
            @if ($errors->userDeletion->has('password'))
                <x-input-error :messages="$errors->userDeletion->get('password')" class="custom-error" />
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        openModal();
                    });
                </script>
            @endif
        </div>
        <button class="delete-button" type="submit">Delete Account</button> 
        <button class="save-button" type="button" onclick="closeModal()">Cancel</button>   
        </form>
    </div>
<script>
    function openModal() {
    document.getElementById("delete-modal").style.display = "block";
    document.getElementById("shadow-overlay").style.display = "block";
}

    function closeModal() {
        document.getElementById("delete-modal").style.display = "none";
        document.getElementById("shadow-overlay").style.display = "none";
    }
</script>
</x-app-layout>
