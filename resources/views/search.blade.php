<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/release.css') }}" />
    @endpush
    @section('title', 'Searched: '.ucfirst($query).' | GS')
    <div class="new_release">
        <h5>Searched: {{ucfirst($query)}}</h5>
        @if($games->isEmpty())
            <div class="empty">
                <h1 class="main-text"> No result found</h1>
                <h2 class="extra-text">Unfortunately could not find any result matching&nbsp;<span style="text-decoration: underline; color:white;">{{($query) }}</span></h2>    
            </div>
        @endif
        <div class="container">
            @foreach($games as $game)
                <div class="opt">
                    <div class="img">
                    <a href="{{ route('product.show', $game->slug) }}">
                        <img src="{{ asset($game->cover) }}" style="object-fit:cover;width: 12vw;height: 15.6vw; border-radius:5px;">
                    </a>
                    </div>
                    <form action="{{ route('wishlist.add', $game->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="wishbtn" type="submit"></button>
                    </form>
                        @if ($game->on_sale)
                            <h4>{{ $game->sale_per}}%</h4>
                        @endif
                    <h1>{{ $game->title }}</h1>
                    <h2>
                        @if($game->on_sale)
                            <span class="original-price" style="text-decoration:line-through;text-decoration-thickness: .2vw; text-decoration-color: rgb(255, 255, 255);">${{ number_format($game->price, 2) }}</span>
                            ${{ number_format($game->price * (1 - $game->sale_per / 100),2) }} 
                        @else
                            ${{$game->price ?? 'NA' }}
                        @endif
                    </h2>
                </div>
            @endforeach
        </div>
    </div>
    
</x-app-layout>