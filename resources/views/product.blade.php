<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}" />
    @endpush
    @section('title', $product->title.' | GS')
    <div class="main_container">
        <div class="title">
            <h1>{{$product->title}}</h1>
        </div>
        <div class="slide_main">
            <!-- <img src="{{ asset('image/test2.png') }}"> -->
            <img src="{{ asset($product->cover) }}" alt="Product Cover">

            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                <button class="wishbtn" type="submit"></button>
            </form>
             <!--  --> 
             <div id="miniPlayer" class="mini-player">
                <iframe id="youtubeFrame"></iframe>
                <button class="close-btn" onclick="closePlayer()">Close</button>
            </div>
            <!--  -->
            <button class="trailerbtn"  onclick="playTrailer()">Play Trailer</button>
            <!-- <h1>${{$product->price ?? 'NA' }}</h1> -->
             <h1>
                @if($product->on_sale)
                    <span class="original-price" style="text-decoration:line-through;text-decoration-thickness: .2vw; text-decoration-color: rgb(255, 255, 255);">${{ number_format($product->price, 2) }}</span>
                    ${{ number_format($product->price * (1 - $product->sale_per / 100),2) }} 
                @else
                    ${{$product->price ?? 'NA' }}
                @endif
             </h1>

            @if($product->on_sale)
                <h3>{{$product->sale_per}}%</h3>
            @endif

        </div>
        <div class="slide_opt">
            <div class="opt">
                <img src="{{ asset('image/test.png')}}">
            </div>
            <div class="opt">
                <img src="{{ asset('image/test2.png')}}">
            </div>
            <div class="opt">
                <img src="{{ asset('image/test3.png')}}">
            </div>
            <div class="opt">
                <img src="{{ asset('image/test2.png')}}">
            </div>    
        </div>
        <div class="desc">
            <h1>{{$product->descrip}}</h1>
        </div>
        <div class="extra">
            <h1>{{$product->extra}}</h1>
        </div>
        <div class="req">
            <h1>{{ $product->title}}: System Requirement</h1>
            <div class="container">
                <div class="min">
                    <h1>Minimum:</h1>
                    <h2>OS:</h2>
                    <h3>{{ $product->details->min_os?? 'NA' }}</h3>
                    <h2>CPU:</h2>
                    <h3>{{ $product->details->min_cpu?? 'NA' }}</h3>
                    <h2>Memory:</h2>    
                    <h3>{{ $product->details->min_ram?? 'NA' }} Gb</h3>
                    <h2>GPU:</h2>   
                    <h3>{{ $product->details->min_gpu?? 'NA' }}</h3> 
                    <h2>Storage:</h2>  
                    <h3>~{{ $product->details->min_storage?? 'NA' }} Gb</h3>      
                </div>
                <div class="rec">
                    <h1>Recommended:</h1>
                    <h2>OS:</h2>
                    <h3>{{ $product->details->req_os?? 'NA' }}</h3>
                    <h2>CPU:</h2>
                    <h3>{{ $product->details->req_cpu?? 'NA' }}</h3>
                    <h2>Memory:</h2>  
                    <h3>{{ $product->details->req_ram?? 'NA' }}</h3>      
                    <h2>GPU:</h2> 
                    <h3>{{ $product->details->req_gpu?? 'NA' }}</h3>       
                    <h2>Storage:</h2>  
                    <h3>~{{ $product->details->req_storage?? 'NA' }} SSD</h3>                       
                </div>
            </div>
        </div>
    </div>
    <div class="sep"></div>
    <div class="pricebar">
        <img src="{{ asset($product->cover) }}" alt="Product Cover">
        <h1 class="title">{{$product->title}}</h1>
        <h2 class="price">
            @if($product->on_sale)
                <span class="original-price" style="text-decoration:line-through;text-decoration-thickness: .2vw; text-decoration-color: rgb(255, 255, 255);">${{ number_format($product->price, 2) }}</span>
                ${{ number_format($product->price * (1 - $product->sale_per / 100),2) }} 
            @else
                ${{$product->price ?? 'NA' }}
            @endif
        
        </h2>

        <button style=" background-color: rgb(140,179,22)">Buy Now</button>
        <button>Add to Cart</button>
        <form action="{{ route('wishlist.add', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Add to Wishlist</button>
        </form>
        <div class="extra_container">
            <div class="info">
                <h3>Developer:</h3>
                <h4>{{$product->dev ?? 'NA' }}</h4>
            </div>
            <div class="info">
                <h3>Publisher:</h3>
                <h4>{{$product->publisher ?? 'NA' }}</h4>
            </div>
            <div class="info">
                <h3>Genre:</h3>
                <h4>{{$product->genre ?? 'NA' }}</h4>
            </div>
            <div class="info">
                <h3>Release Date:</h3>
                <h4>{{ $product->release ? $product->release->format('Y-m-d') : 'No Release Date' }}</h4>
            </div>
            <div class="info">
                <h3>Platform:</h3>
                <h4>{{$product->platform ?? 'NA' }}</h4>
            </div>
            <div class="info">
                <h3>Rating:</h3>
                <h4>
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($product->rating))
                            <!-- <img src="{{ asset('1.png')}}" > -->
                            ★
                        @elseif ($i == ceil($product->rating) && fmod($product->rating, 1) >= 0.5)
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </h4>
            </div>
        </div>
        <div class="last_btn">
            <button>Share</button>
            <button>Review</button>
        </div>
    </div>
<script>
    function playTrailer() {
    var trailerUrl = '{{$product->trailer}}'; // Use the trailer URL from your database
    document.getElementById('youtubeFrame').src = trailerUrl;
    document.getElementById('miniPlayer').style.display = 'block';
    }
    function closePlayer() {
    document.getElementById('miniPlayer').style.display = 'none';
    document.getElementById('youtubeFrame').src = ''; // Stop the video when closing
    }
</script>    
</x-app-layout>