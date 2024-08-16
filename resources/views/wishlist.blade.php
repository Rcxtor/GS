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

        <div class="item-container">
            <img src="{{asset('/image/test.png')}}">
            <a href="">Game Zero</a>
            <h1 class="sale">Sale Ends: 11/25/2024</h1>
            <h5 class="sale-per">50%</h5>
            <h2 class="item-price">$69.69</h2>
            <h4 class="available">Available: 11/15/2024</h4>
            <div class="remove-item"><a href="">Remove</a></div>
            <button class="cart">View In Cart</button>
        </div> 
        <div class="item-container">
            <img src="{{asset('/image/test2.png')}}">
            <a href="">Game Zero: Two</a>
            <h1 class="sale">Sale Ends: 11/25/2024</h1>
            <h5 class="sale-per">50%</h5>
            <h2 class="item-price">$69.69</h2>
            <h4 class="available">Available: 11/15/2024</h4>
            <div class="remove-item"><a href="">Remove</a></div>
            <button class="cart">View In Cart</button>
        </div> 
        <div class="item-container">
            <img src="{{asset('/image/test3.png')}}">
            <a href="">Game Zero</a>
            <h1 class="sale">Sale Ends: 11/25/2024</h1>
            <h5 class="sale-per">50%</h5>
            <h2 class="item-price">$69.69</h2>
            <h4 class="available">Available: 11/15/2024</h4>
            <div class="remove-item"><a href="">Remove</a></div>
            <button class="cart">View In Cart</button>
        </div> 

        <div class="filter">
            <h1>Filter<a href="">&#10227;</a></h1>
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
    </div>
    <script>
    function toggleDisplay(className) 
    {
        const element = document.querySelector(`.${className}`);
        element.style.display = element.style.display === 'none' ? 'flex' : 'none';
    }
</script>
</x-app-layout>