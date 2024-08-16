<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/wishlist.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}" />
    @endpush
    @section('title', 'Wishlist | GS')

    <div class="outer-container">
        <h1>My Cart</h1>  

        <div class="item-container">
            <img src="{{asset('/image/test.png')}}">
            <a href="">Game Zero</a>
            <h1 class="sale">Sale Ends: 11/25/2024</h1>
            <h5 class="sale-per">50%</h5>
            <h2 class="item-price">$69.69</h2>
            <h4 class="available">Available: 11/15/2024</h4>
            <div class="remove-item"><a href="">Remove</a></div>
            <div class="move-item"><a href="">Move to Wishlist</a></div>
            <div class="warning-container">
                <h6 style="color:rgb(255,201,14);">⚠</h6><h6  class="warning">You won't be able to play until release</h6>
            </div>
        </div> 
        <div class="item-container">
            <img src="{{asset('/image/test2.png')}}">
            <a href="">Game Zero: Two</a>
            <h1 class="sale">Sale Ends: 11/25/2024</h1>
            <h5 class="sale-per">50%</h5>
            <h2 class="item-price">$69.69</h2>
            <h4 class="available">Available: 11/15/2024</h4>
            <div class="remove-item"><a href="">Remove</a></div>
            <div class="move-item"><a href="">Move to Wishlist</a></div>
        </div> 
        <div class="item-container">
            <img src="{{asset('/image/test3.png')}}">
            <a href="">Game Zero</a>
            <h1 class="sale">Sale Ends: 11/25/2024</h1>
            <h5 class="sale-per">50%</h5>
            <h2 class="item-price">$69.69</h2>
            <h4 class="available">Available: 11/15/2024</h4>
            <div class="remove-item"><a href="">Remove</a></div>
            <div class="move-item"><a href="">Move to Wishlist</a></div>
        </div> 
    </div>
</x-app-layout>