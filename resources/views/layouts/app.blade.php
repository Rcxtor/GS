<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('logo2.png') }}" type="image/x-icon">
        <title>@yield('title', 'Default Title')</title>
        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('css/applayout.css') }}" />
        @stack('styles')

    </head>
    <body>
        <section>
            <!-- Nav bar -->
            <nav>
                <!-- logo -->
                <div class="logo">
                    <img src="{{ asset("image/logo2.png")}}" alt="Logo">
                </a>
                </div>
                <!-- Store btton -->
                <div class="back_to_store" Style="display:flex;align-items: center;">
                    <a href="{{route('welcome')}}"><svg xmlns="http://www.w3.org/2000/svg" height="3vh" viewBox="0 -960 960 960" width="3vh" fill="#e8eaed"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>STORE </a>
                </div>
                <!-- Search bar -->
                <div class="search_bar">
                    <form method="GET" action="{{route('searched')}}">
                        @csrf
                        <input id="search" type="text" name="search" placeholder="Search Store" value="{{ucfirst(request('search')) ?? ""}}"></input>
                        <button class="scrbtn" type="submit"><svg xmlns="http://www.w3.org/2000/svg" height="12" width="12" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6 .1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg></button>
                    </form>
                </div>
                <div class="link_container">
                    <div class="link1">
                            <x-nav-link href="{{route('welcome')}}" :active="request()->routeIs('welcome')">
                                Discover
                            </x-nav-link>
                        <div class="drop">
                            <x-nav-link class="abc" href="{{route('browse')}}" :active="request()->routeIs('browse') || request()->routeIs('genre.filter')">
                                Browse
                            </x-nav-link>
                        
                                <div class="browse_cont">
                                    <a href="{{ route('genre.filter', 'adventure') }}">Adventure</a>
                                    <a href="{{ route('genre.filter', 'racing') }}">Racing</a>
                                    <a href="{{ route('genre.filter', 'sci-fi') }}">Sci-Fi</a>
                                    <a href="{{ route('genre.filter', 'action') }}">Action</a>
                                    <a href="{{ route('genre.filter', 'strategy') }}">Strategy</a>
                                    <a href="{{ route('genre.filter', 'simulation') }}">Simulation</a>
                                    <a href="{{ route('genre.filter', 'survival') }}">Survival</a>
                                    <a href="{{ route('genre.filter', 'indie') }}">Indie</a>
                                    <a href="{{ route('genre.filter', 'horror') }}">Horror</a>
                                    <a href="{{ route('genre.filter', 'rpg') }}">RPG</a>
                                    <a href="{{route('browse')}}">....</a>
                                </div>
                        </div>
                    </div>
                    <div class="link1">
                        @auth
                            @if(auth()->user()->role=='admin')
                                <x-nav-link href="{{route('dashboard')}}" :active="request()->routeIs('dashboard') || request()->routeIs('addProduct')">
                                    Dashboard
                                </x-nav-link>
                            @endif
                            <x-nav-link href="{{route('wishlist.show')}}" :active="request()->routeIs('wishlist.show') || request()->routeIs('wishlist.filter') || request()->routeIs('wishlist.search')">  
                                Wishlist @if($wishlistCount > 0) ({{ $wishlistCount }}) @endif
                            </x-nav-link>
                            <x-nav-link href="{{route('cart.show')}}" :active="request()->routeIs('cart.show')">  
                                Cart @if($cartCount > 0) ({{ $cartCount }}) @endif
                            </x-nav-link>
                        @endauth 
                    </div>
                </div>
                <div Style="display:flex; align-items:center; color:rgb(99,99,99)">|</div>
                <div class="profile_btn">
                    <button onclick="toggleDropDown()" class="profile">Profile</button>
                    <div id="dropdownContent" class="profile_content">
                        @auth
                            <a href="{{route('profile.edit')}}">Profile</a>
                            <a href="">Order History</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @endauth
                    </div>
                </div>
            </nav>
                @isset($header)
                    <header style="color:white;">
                        <div>
                            {{ $header }}
                        </div>
                    </header>
                @endisset
            <!-- Page Content -->
             @if (session('success'))
                <div class="message-container" id="success-message">
                    <h1 style="color:rgb(255,201,14); margin-top:-0.2vw; margin-right:0.2vw;padding:0.5vw 0vw; padding-left: 0.5vw;border-left: 0.3vw solid rgb(0, 162, 232);">⚠</h1>
                    <!-- <h1>Game added to wishlist!</h1> -->
                    <h1>{{ session('success') }}</h1>
                </div>
            @elseif(session('error'))
                <div class="message-container" id="success-message">
                    <h1 style="color:rgb(255, 55, 65); margin-top:-0.2vw; margin-right:0.2vw;padding:0.5vw 0vw; padding-left: 0.5vw;border-left: 0.3vw solid rgb(0, 162, 232);">⚠</h1>
                    <!-- <h1>Game added to wishlist!</h1> -->
                    <h1>{{ session('error') }}</h1>
                </div>
            @endif
           
            <main>
                {{ $slot }}
            </main>
        </section>
    <footer>
        <div class="foorter_container">
            <div class="about">
                <img src="{{ asset("image/logo2.png")}}" alt="Logo">
                <h1>About Us:</h1>
                <h2>Brands or product names are the trademark of thier respectice owners</h2>
            </div>
            <div class="TNC">
                <a href="">Terms and Services</a>
                <a href="">Store Return Policy</a>
                <a href="">Contact Us</a>
            </div>
            <div class="connect">
                <h1>Connect On:</h1>
                <div class="links">
                    <a href="">.</a>
                </div>
                <div class="links">
                    <a href="">.</a>
                </div>
                <div class="links">
                    <a href="">.</a>  
                </div>
                
            </div>
        </div>
    </footer>
    <script>
        function toggleDropDown()
        {
            document.getElementById("dropdownContent").classList.toggle("show")
        }
        window.onclick =function(event) {
            if (!event.target.matches('.profile')) {
                var dropdowns = document.getElementsByClassName("profile_content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
        const message = document.getElementById('success-message');

        // Add the 'show' class to fade in
        // message.classList.add('show');

        // Remove the 'show' class after 2 seconds to fade out
        setTimeout(function() {
            // message.classList.remove('show');
            message.classList.add('hide');
        }, 1000); // 2000 milliseconds = 2 seconds
    });
    </script>
    </body>
</html>
