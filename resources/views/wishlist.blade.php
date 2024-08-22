<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/wishlist.css') }}" />
    @endpush
    @section('title', 'Wishlist | GS')
    <div class="outer-container">
        <h1>My Wishlist</h1>
        <div class="notifi">
            <h2> Get notified when your wishlist games go on sale or are available</h2>
            <label class="switch">
                <input type="checkbox">
                <span class="slider"></span>
            </label>
        </div> 

        @if(!empty($selectedFilters['price']) || !empty($selectedFilters['genre']) || !empty($selectedFilters['platform'])) 
            <div class="types" style="display:flex; gap:0.2vw; margin-top:-2.05vw;">
            <h6>Show:</h6>
                @if(!empty($selectedFilters['price']))
                    <h7>${{ implode(', ', $selectedFilters['price']) }}</h7>
                @endif
                @if(!empty($selectedFilters['genre']))
                    <h7>{{ ucfirst(implode(', ', $selectedFilters['genre'])) }}</h7>
                @endif
                @if(!empty($selectedFilters['platform']))
                    <h7>{{ ucfirst(implode(', ', $selectedFilters['platform'])) }}</h7>
                @endif
            </div>
        @endif  
    
        @if($wishlists->isEmpty())
            <div class="empty-cart">
            <img src="/sad.png">
            <h1 class="info-text">You haven't added any game to your wishlist yet.</h1>
            <a class="discover-button" href="{{route('browse')}}">Shop for Games</a>
            </div>
        @endif
        @foreach($wishlists as $wishlist)
        <div class="item-container">
            <img src="{{asset($wishlist->game->cover)}}"onclick="window.location.href='{{ route('product.show', $wishlist->game->slug) }}'">
            <a href="{{ route('product.show', $wishlist->game->slug) }}">{{ $wishlist->game->title }}</a>
            @if ($wishlist->game->on_sale)
                @if ($wishlist->game->sale_date)
                    <h1 class="sale">Sale Ends:{{ $wishlist->game->sale_date->format('m/d/Y') }}</h1>
                @endif
                <h5 class="sale-per">{{ $wishlist->game->sale_per }}%</h5>
            @endif

            <h2 class="item-price">
                @if($wishlist->game->on_sale)
                    <span class="original-price" style="text-decoration:line-through;text-decoration-thickness: .2vw; text-decoration-color: rgb(255, 255, 255);">${{ number_format($wishlist->game->price, 2) }}</span>
                    ${{ number_format($wishlist->game->price * (1 - $wishlist->game->sale_per / 100),2) }} 
                @else
                    ${{$wishlist->game->price ?? 'NA' }}
                @endif
            </h2>
            @if($wishlist->game->release > now())
                <h4 class="available">Available: {{$wishlist->game->release->format('m/d/Y')}}</h4>
            @endif
            <form id="remove-wishlist-form-{{ $wishlist->game->id }}" action="{{ route('wishlist.remove', $wishlist->game->id) }}" method="POST">
                @csrf
                <div class="remove-item"><a href="#" onclick="event.preventDefault(); document.getElementById('remove-wishlist-form-{{ $wishlist->game->id }}').submit();">Remove</a></div>
            </form>
            <form action="{{ route('cart.add', $wishlist->game->id) }}" method="POST">
                @csrf
                <button class="cart" type="submit">View In Cart</button>
            </form>
            
        </div> 
        @endforeach

        <form method="GET" action="{{route('wishlist.filter')}}">
            <div class="filter">
                <h1>Filter<a href="{{route('wishlist.show')}}">&#10227;</a></h1>
                    <div class="wishlist-search">
                        
                            <input id="search" type="text" name="search" placeholder="Search Wishlist" value="{{ucfirst(request('search')) ?? ""}}"></input>
                            <button style="display: none;" type="submit" formaction="{{route('wishlist.search')}}"></button>
                    </div>
                    <h2>Price<button type="button" onclick="toggleDisplay('price')">&#8615;</button></h2>
                    <div class="price" style="display:flex; flex-direction: column; gap:0.5vw; display:none;">
                        <label>
                            <input type="checkbox" name="price[]" value="0-20">$0 - $20
                        </label>
                        <label>
                            <input type="checkbox" name="price[]" value="21-50">$21 - $50
                        </label>
                        <label>
                            <input type="checkbox" name="price[]" value="51-100">$51 - $100
                        </label>
                        <label>
                            <input type="checkbox" name="price[]" value="101-200">$101 - $200
                        </label>
                    </div>
                    <h2>Genre<button type="button" onclick="toggleDisplay('genre')">&#8615;</button></h2>
                    <div class="genre" style="display:flex; flex-direction: column; gap:0.5vw;display:none;">
                        <label><input type="checkbox" name="genre[]" value="adventure">Adventure</label>
                        <label><input type="checkbox" name="genre[]" value="racing">Racing</label>
                        <label><input type="checkbox" name="genre[]" value="sci-fi">Sci-Fi</label>
                        <label><input type="checkbox" name="genre[]" value="action">Action</label>
                        <label><input type="checkbox" name="genre[]" value="strategy">Strategy</label>
                        <label><input type="checkbox" name="genre[]" value="simulation">Simulation</label>
                        <label><input type="checkbox" name="genre[]" value="survival">Survival</label>
                        <label><input type="checkbox" name="genre[]" value="indie">Indie</label>
                        <label><input type="checkbox" name="genre[]" value="horror">Horror</label>
                        <label><input type="checkbox" name="genre[]" value="rpg">RPG</label>
                    </div>
                    
                    <h2>Platform<button type="button" onclick="toggleDisplay('platform')">&#8615;</button></h2>
                    <div class="platform" style="display:flex; flex-direction: column; gap:0.5vw; display:none;">
                        <label><input type="checkbox" name="platform[]" value="windows">Windows</label>
                        <label><input type="checkbox" name="platform[]" value="mac">Mac</label>
                        <label><input type="checkbox" name="platform[]" value="console">Console</label>
                    </div>

                    <button type="submit">Apply Filters</button>
            </div>
        </form>
    </div>
    <div class="pingupingu ">
        {{ $wishlists->links('vendor.pagination.default') }}
    </div>
<script>
function toggleDisplay(className) 
{
    const element = document.querySelector(`.${className}`);
    element.style.display = element.style.display === 'none' ? 'flex' : 'none';
}
</script>
</x-app-layout>