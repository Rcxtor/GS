<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/wishlist.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}" />
    @endpush
    @section('title', 'Wishlist | GS')

    <div class="outer-container">
        <h1>My Cart</h1>  

        @if($carts->isEmpty())
             <div class="empty-cart">
                <img src="/sad.png">
                <h1 class="info-text">Your Cart Is Empty.</h1>
                <a class="discover-button" href="{{route('welcome')}}">Shop for Games</a>
             </div>
        @endif
        @foreach($carts as $cart)
        <div class="item-container">
            <img src="{{asset($cart->game->cover)}}"onclick="window.location.href='{{ route('product.show', $cart->game->slug) }}'">
            <a href="{{ route('product.show', $cart->game->slug) }}">{{ $cart->game->title }}</a>
            @if ($cart->game->on_sale)
                @if ($cart->game->sale_date)
                    <h1 class="sale">Sale Ends:{{ $cart->game->sale_date->format('m/d/Y') }}</h1>
                @endif
                <h5 class="sale-per">{{ $cart->game->sale_per }}%</h5>
            @endif
            <h2 class="item-price">
                @if($cart->game->on_sale)
                    <span class="original-price" style="text-decoration:line-through;text-decoration-thickness: .2vw; text-decoration-color: rgb(255, 255, 255);">${{ number_format($cart->game->price, 2) }}</span>
                    ${{ number_format($cart->game->price * (1 - $cart->game->sale_per / 100),2) }} 
                @else
                    ${{$cart->game->price ?? 'NA' }}
                @endif
            </h2>
            @if($cart->game->release > now())
                <h4 class="available">Available: {{$cart->game->release->format('m/d/Y')}}</h4>
                <div class="warning-container">
                    <h6 style="color:rgb(255,201,14);">⚠</h6><h6  class="warning">You won't be able to play until release</h6>
                </div>
            @endif
            <!-- REMOVE -->
            <form id="remove-cart-form-{{ $cart->game->id }}" action="{{ route('cart.remove', $cart->game->id) }}" method="POST">
                @csrf
                <div class="remove-item"><a href="" onclick="event.preventDefault(); document.getElementById('remove-cart-form-{{ $cart->game->id }}').submit();">Remove</a></div>
            </form>
            <form id="add-wishlist-form-{{ $cart->game->id }}" action="{{ route('wishlist.add', $cart->game->id) }}" method="POST">
                @csrf
                <div class="move-item"><a href="" onclick="event.preventDefault(); document.getElementById('add-wishlist-form-{{ $cart->game->id }}').submit();">Move to Wishlist</a></div>
            </form>
            
        </div> 
        @endforeach
    </div>
    <div class="cart-sum">
        <h1 class="cart-text">Cart Summary</h1>
        <div class="price-text">
            <h1>Price</h1>
            <h2>${{ number_format($total,2)}}</h2>
        </div>
        <div class="tax-text">
            <h1>Taxes</h1>
            <h2>Calculated at Checkout</h2>
        </div>
        <div class="total">
            <h1>Subtotal</h1>
            <h2>${{ number_format($total,2)}}</h2>
        </div>
        <button class="check-out-button" type="submit">Check Out</button>
    </div>
</x-app-layout>