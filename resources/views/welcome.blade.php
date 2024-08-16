<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}" />
    @endpush
    @section('title', 'Discover | GS')
    
    <div class="slide_main">
        <img src="{{ asset($games->firstWhere('featured', 1)->cover) }}" alt="Featured Game">
        <h1 class="slide-title">{{$games->firstWhere('featured', 1)->title}}</h1>
        <h1 class="slide-price">${{$games->firstWhere('featured', 1)->price}}</h1>
        <form id="wishlist-form" action="{{ route('wishlist.add', $games->firstWhere('featured', 1)->id) }}" method="POST" style="display:inline;">
            @csrf
            <button class="wishbtn" type="submit"></button>
        </form>
        <a class="readlnk" href="{{ route('product.show', $games->firstWhere('featured', 1)->slug) }}">
            <button class="readbtn" >Read More</button>
        </a>
    </div>

    <div class="slide_opt">
        @foreach($games->where('featured', 1)->take(6) as $game)
            <div class="opt">
                <img src="{{ asset($game->cover) }}" alt="{{ $game->title }}" data-href="{{ route('product.show', $game->slug) }}" data-title="{{ $game->title }}" data-price="{{ $game->price }}" data-id="{{ $game->id }}">
            </div>
        @endforeach 
    </div>
    <div class="new_release">
        <a href="{{'new-release'}}">New Release></a>
        <div class="container">
            @foreach($games->where('featured', 1)->take(5) as $game)
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
                    <!-- <h2>${{ $game->price }}</h2> -->
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
    <div class="on_sale">
        <a href="{{'on-sale'}}">On Sale></a>
        <div class="container">
            @foreach($games->where('on_sale', 1)->take(5) as $game)
                <div class="opt">
                    <div class="img">
                    <a href="{{ route('product.show', $game->slug) }}">
                        <img src="{{ asset($game->cover) }}" style="object-fit:cover;width: 12vw;height: 15.6vw; border-radius:5px;">
                        <!-- <img src="image/test2.png" style="object-fit:cover;width: 12vw;height: 15.6vw; border-radius:5px;"> -->
                    </a>
                    </div>
                    <form action="{{ route('wishlist.add', $game->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="wishbtn" type="submit"></button>
                    </form>
                    <h4>{{ $game->sale_per}}%</h4>
                    <h1>{{ $game->title }}</h1>
                    <div style="display:flex; gap:0.5vw;">
                        <h2>${{ $game->price }}</h2>
                        <h3>${{number_format($game->price-($game->price *($game->sale_per/100)),2)}}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="last">
       <div class="top">
             <h1>Top Sale></h1>
             @foreach($games->where('featured', 1)->take(5) as $game)
                <div class="opt">
                    <div class="img">
                        <a href="{{ route('product.show', $game->slug) }}">
                        <img src="{{ asset($game->cover) }}" style="object-fit:cover; height: 6.5vw;width: 5.4vw; border-radius:4px;">
                        </a>
                    </div>
                    <h1>{{ $game->title }}</h1>
                    <!-- <h2>${{ $game->price }}</h2> -->
                     <h2>
                        @if($game->on_sale)
                            ${{ number_format($game->price * (1 - $game->sale_per / 100),2) }} 
                        @else
                            ${{$game->price ?? 'NA' }}
                        @endif
                     </h2>
                </div>
            @endforeach
        </div>           
        <div class="coming">
            <h1>Coming Soon></h1>
                @foreach($games->where('coming_soon', 1)->take(5) as $game)
                    <div class="opt">
                        <div class="img">
                            <a href="{{ route('product.show', $game->slug) }}">
                                <img src="{{ asset($game->cover) }}" style="object-fit:cover; height: 6.5vw;width: 5.4vw; border-radius:4px;">
                            </a>
                        </div>
                        <h1>{{ $game->title }}</h1>
                        <!-- <h2>${{ $game->price }}</h2> -->
                        <h2>
                        @if($game->on_sale)
                            ${{ number_format($game->price * (1 - $game->sale_per / 100),2) }} 
                        @else
                            ${{$game->price ?? 'NA' }}
                        @endif
                     </h2>
                    </div>
                @endforeach
        </div>
    </div>

<script>
// document.addEventListener('DOMContentLoaded', function() {
//     const slides = document.querySelectorAll('.slide_opt .opt img');
//     const mainSlide = document.querySelector('.slide_main img');
//     const slideTitle = document.querySelector('.slide-title'); // Get the title element
//     const slidePrice = document.querySelector('.slide-price'); // Get the price element
//     const readMoreBtn = document.querySelector('.readlnk');

//     let currentSlideIndex = 0;
//     let slideInterval;

//     function showSlide(index) {
//         mainSlide.src = slides[index].src;
//         slideTitle.textContent = slides[index].getAttribute('data-title'); // Update the title
//         slidePrice.textContent = `$${slides[index].getAttribute('data-price')}`; // Update the price
//         readMoreBtn.href = slides[index].getAttribute('data-href'); // Update Read More button href
//         slides.forEach((slide, i) => {
//             slide.classList.toggle('active', i === index);
//         });
//     }

//     function nextSlide() {
//         currentSlideIndex = (currentSlideIndex + 1) % slides.length;
//         showSlide(currentSlideIndex);
//     }

//     function startSlideShow() {
//         slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
//     }

//     function resetSlideShow() {
//         clearInterval(slideInterval); // Clear the existing interval
//         startSlideShow(); // Restart the slideshow
//     }

//     slides.forEach((slide, index) => {
//         slide.addEventListener('click', () => {
//             currentSlideIndex = index;
//             showSlide(currentSlideIndex);
//             resetSlideShow(); // Reset the slideshow timer when a new option is clicked
//         });
//     });

//     startSlideShow(); // Initial start of the slideshow
//     showSlide(currentSlideIndex); // Show the initial slide
// });
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide_opt .opt img');
    const mainSlide = document.querySelector('.slide_main img');
    const slideTitle = document.querySelector('.slide-title'); // Get the title element
    const slidePrice = document.querySelector('.slide-price'); // Get the price element
    const readMoreBtn = document.querySelector('.readlnk');
    const wishlistForm = document.getElementById('wishlist-form');

    let currentSlideIndex = 0;
    let slideInterval;

    function showSlide(index) {
        mainSlide.classList.add('fade-out'); // Start fade out

        setTimeout(() => {
            // After fade-out is complete, change the image and fade it in
            mainSlide.src = slides[index].src;
            slideTitle.textContent = slides[index].getAttribute('data-title'); // Update the title
            slidePrice.textContent = `$${slides[index].getAttribute('data-price')}`; // Update the price
            readMoreBtn.href = slides[index].getAttribute('data-href'); // Update Read More button href
            wishlistForm.action = `/wishlist/add/${slides[index].getAttribute('data-id')}`;

            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index); // Apply darkening to the active slide
            });

            mainSlide.classList.remove('fade-out'); // Remove fade-out class to trigger fade-in
        }, 350); // Match the delay to the CSS transition time
    }

    function nextSlide() {
        currentSlideIndex = (currentSlideIndex + 1) % slides.length;
        showSlide(currentSlideIndex);
    }

    function startSlideShow() {
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
    }

    function resetSlideShow() {
        clearInterval(slideInterval); // Clear the existing interval
        startSlideShow(); // Restart the slideshow
    }

    slides.forEach((slide, index) => {
        slide.addEventListener('click', () => {
            currentSlideIndex = index;
            showSlide(currentSlideIndex);
            resetSlideShow(); // Reset the slideshow timer when a new option is clicked
        });
    });

    startSlideShow(); // Initial start of the slideshow
    showSlide(currentSlideIndex); // Show the initial slide
});

</script>
</x-app-layout>