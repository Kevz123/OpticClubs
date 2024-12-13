@extends('layouts.app')

@section('title', 'Optic Clubs - Home')

@section('content')
    @vite('resources/css/styles.css')
    @vite('resources/js/calendar.js')

    {{-- Flash Message Display --}}
    @if (session('status'))
    <div class="alert alert-success" style="color: green; padding: 10px; background-color: #e1f8e3; border: 1px solid #d4edda; margin-bottom: 15px;">
        {{ session('status') }}
    </div>
@endif

@if(session('success'))
<div class="alert alert-success" style="color: green; padding: 10px; background-color: #e1f8e3; border: 1px solid #d4edda; margin-bottom: 15px;">
    {{ session('success') }}
</div>
@endif

    <!-- Banner Section -->

    <style>
        #banner {
            background: linear-gradient(rgba(0,0,0,0.5), #128b9e94), url('{{ asset('images/home back.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        .upcoming-events-container {
            width: 66%;
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .event-card {
    width: calc(33.33% - 20px); /* Ensures three cards fit in a row with spacing */
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 15px;
    box-sizing: border-box; /* Ensures padding doesn't affect width */
    text-align: center;
}

        .event-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .join-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .join-button:hover {
            background-color: #45a049;
        }


        </style>
        



    <section id="banner">
        <div class="navbar">
            <br><br><br><br>
            {{-- <nav>
                <a href="{{ route('clubs.discover') }}">Discover Clubs</a>
                <a href="#my-clubs">My Clubs</a>
                @guest
                    <a href="{{ route('register') }}">Register</a>
                @endguest
            </nav> --}}
        </div>

        <!-- Hero Section -->
        <div class="hero1">
            <p>Optic is your gateway to a vibrant community of sports enthusiasts, promoting all indoor and outdoor sports...</p>
        </div>

        <!-- Explore Button -->
        <div class="hometextbtn">
            <a href="#ex"><span>Explore</span></a>
        </div>
    </section>
    <br>
    <br>
    

    <!-- Main Content -->
    <main>
        <div id="ex"></div>
        <div class="events-section" style="display: flex; justify-content: center; gap: 20px;">
    
            <!-- Calendar Container -->
            <div class="calendar-container" style="width: 33%; background-color: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <h2 style="font-weight: bold; font-size: 1.5rem;">Calendar</h2>
                <br>
                <div class="calendar">
                    <div class="calendar-header">
                        <button onclick="prevMonth()">&#9664;</button>
                        <div id="month-year">October 2024</div>
                        <button onclick="nextMonth()">&#9654;</button>
                    </div>
                    <div class="calendar-weekdays">
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                        <div>Sun</div>
                    </div>
                    <div class="calendar-days" id="calendar-days">
                        <!-- JS will populate days -->
                    </div>
                </div>
            </div>
        
            <!-- Upcoming Events Container -->
            <div class="upcoming-events-container" style="width: 66%; background-color: #f9f9f9; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <h1 style="margin-bottom: 20px;font-weight: bold; font-size: 1.5rem;">Upcoming Events</h1>
                <div class="clubsowner-container" style="background-color: #fff">
                    @foreach($events as $event)
                    <div class="club-card">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->event_name }} Event" style="width: 100%; border-radius: 10px; object-fit: cover;">
                            <h3>{{ $event->event_name }}</h3>
                            <p><strong>Date:</strong> {{ $event->event_date->format('F j, Y') }}</p>
                            <p><strong>Time:</strong> {{ $event->start_time }}</p>
                            <p><strong>Venue:</strong> {{ $event->venue->venue_name ?? 'TBA' }}</p><br>
                            <a href="{{ route('events.show', $event->event_id) }}"
                                <button class="join-button" style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">View</button>
                            </a>

                        </div>
                    @endforeach
                </div> 
                <br>
                <br>
            </div>
        </div>
        
    </main>
    <br>
    <br>
    <br>


    <!-- Footer Section -->
    <footer style="background:linear-gradient(rgba(0,0,0,0.5),#0066cc), url('{{ asset('images/background.jpeg') }}'); padding: 60px; display: flex; justify-content: space-around;">
        <div class="footer-content" style="display: flex; justify-content: space-around; gap: 20px; width: 100%;">
            <!-- Footer Logo -->
            <div class="footer-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Optic Clubs Logo" class="logo" style="width: 150px; height: auto; margin-right: 100px;">
            </div>
    
            <!-- Footer Text -->
            <div class="footer-text" style="width: 40%; margin-left: -200px;">
                <h3>Terms & Conditions</h3>
                <p>"Optic is your gateway to a vibrant community of sports enthusiasts, promoting all indoor and outdoor sports..."</p>
            </div>
    
            <!-- Social Media Links -->
            <div class="social-media">
                <h3>Social Media</h3>
                <a href="#"><img src="{{ asset('images/instagram.jpeg') }}" class="logo1" alt="Instagram" style="width: 30px; height: auto;"></a><br>
                <a href="#"><img src="{{ asset('images/facebook.jpeg') }}" class="logo1" alt="Facebook" style="width: 30px; height: auto;"></a><br>
                <a href="#"><img src="{{ asset('images/twitter.jpeg') }}" class="logo1" alt="Twitter" style="width: 30px; height: auto;"></a><br>
                <a href="#"><img src="{{ asset('images/youtube.jpeg') }}" class="logo1" alt="YouTube" style="width: 30px; height: auto;"></a>
            </div>
        </div>
    </footer>
@endsection
