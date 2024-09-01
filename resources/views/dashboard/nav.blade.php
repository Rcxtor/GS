<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
<div class="side-column">
    <div class="column-logo">
        <img src="{{ asset("image/logo2.png")}}">
        <h1 class="column-heading">GS Store</h1>
    </div>
    
    <x-nav-link href="{{route('dashboard')}}" :active="request()->routeIs('dashboard')">
        Dashboard
    </x-nav-link>
    <x-nav-link href="{{route('addProduct')}}" :active="request()->routeIs('addProduct')">
        Add Product
    </x-nav-link>
    <x-nav-link href="" :active="request()->routeIs('')">
        Products
    </x-nav-link>
    <x-nav-link href="" :active="request()->routeIs('')">
        Orders
    </x-nav-link>
    <x-nav-link href="" :active="request()->routeIs('')">
        Customers
    </x-nav-link>
    <x-nav-link href="" :active="request()->routeIs('')">
        Invoice
    </x-nav-link>
    <x-nav-link href="" :active="request()->routeIs('')">
        Password & Security
    </x-nav-link>
</div>
<div class="sep"></div>