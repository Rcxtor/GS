<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/browse.css') }}"/>
    @endpush
    @section('title', 'Browse: '.ucfirst(implode(', ', $selectedFilters['genre'])).' | GS')
    <div class="popular">
        <h1>Popular Genre</h1>
        <div class="outer-layer">
            <a href="{{ route('genre.filter', 'adventure') }}">
                <div class="inner-layer">
                    <div class="img"></div>
                    <h2>Adventure</h2>
                </div>
            </a>
            <a href="{{ route('genre.filter', 'sci-fi') }}">            
                <div class="inner-layer">
                    <div class="img"></div>
                    <h2>Sci-Fi</h2>
                </div>
            </a> 
            <a href="{{ route('genre.filter', 'action') }}">
                <div class="inner-layer">
                    <div class="img"></div>
                    <h2>Action</h2>
                </div>
            </a>
            <a href="{{ route('genre.filter', 'strategy') }}">
                <div class="inner-layer">
                    <div class="img"></div>
                    <h2>Strategy</h2>
                </div>
            </a>
            <a href="{{ route('genre.filter', 'indie') }}">
                <div class="inner-layer">
                    <div class="img"></div>
                    <h2>Indie</h2>
                </div>
            </a>
        </div>
    </div>
    <div class="new_release">
        <h5>Browse</h5>

        @if(!empty($selectedFilters['price']) || !empty($selectedFilters['genre']) || !empty($selectedFilters['platform'])) 
            <h6>Filtered by:</h6>
            <div class="types">
                @if(!empty($selectedFilters['price']))
                    <h7>Price: ${{ implode(', ', $selectedFilters['price']) }}</h7>
                @endif
                @if(!empty($selectedFilters['genre']))
                    <h7>Genre: {{ ucfirst(implode(', ', $selectedFilters['genre'])) }}</h7>
                @endif
                @if(!empty($selectedFilters['platform']))
                    <h7>Platform: {{ ucfirst(implode(', ', $selectedFilters['platform'])) }}</h7>
                @endif
            </div>
        @endif
        @if($games->isEmpty())
            <p style="color:white; font-size:3vw;">No games found.</p>
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
        <form method="GET" action="{{ route('browse') }}">
            <div class="filter">
                <h1>Filter<a href="{{route('browse')}}">&#10227;</a></h1>
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
    {{ $games->links('vendor.pagination.default') }}
    </div>
    
<script>
function toggleDisplay(className) 
{
    const element = document.querySelector(`.${className}`);
    element.style.display = element.style.display === 'none' ? 'flex' : 'none';
}
</script>
</x-app-layout>