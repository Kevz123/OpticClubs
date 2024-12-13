@extends('layouts.app')

@section('title', 'Optic Clubs - Venue Booking')

@section('content')

<style>
/* Global Styles */
main {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}
.contains {
    width: 100%; /* Expand to full container width */
    max-width: 1200px; /* Optional: set max-width */
    margin: 0 auto;
    padding: 20px;
}
/* Headings */
h1 {
    font-size: 2.5em;
    color: #333;
    text-align: center;
    margin-bottom: 30px;
}

h2 {
    font-size: 1.8em;
    color: #555;
    margin-top: 30px;
    margin-bottom: 10px;
}

.venue-area {
    margin-left: 0;
}
.venue {
    display: flex;
    align-items: flex-start; /* Align items from the top */
    justify-content: space-between;
    margin-bottom: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 100%; /* Ensure it takes up full width */
    box-sizing: border-box; /* Include padding in width */
}

.venue-img {
width: 280px;
height: 160px;
border-radius: 5px;
object-fit: cover;
margin: 10px 20px;
}

.venue-info {
flex-grow: 1;
padding-left: 20px;
}

.venue-info strong {
    margin-top: 0;
    color: #333;
}
.venue-info p {
    margin: 20px 0;
    color: #555;
}
.venue-info a {
    margin: 80px;
}
/* List Styles */
ul {
    list-style: none; /* Remove default bullets */
    margin: 0;
    padding: 0;
}
li {
    padding: 15px;
    background: #fff;
    border-radius: 5px;
    margin-bottom: 15px; /* Consistent spacing */
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Venue Name */
li strong {
    font-size: 1.2em;
    color: #000;
}

/* Link Styling */
li a {
    color: #007BFF;
    text-decoration: none;
    font-size: 0.9em;
}

li a:hover {
    text-decoration: underline;
}

/* Button Styling */
.btn {
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 8px 12px;
    font-size: 0.9em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

/* Form Inline Styling */
form {
    display: inline-block;
    margin-left: 20px;
}

</style>


<div class="contains">
    <h1>Select a Venue</h1>
    @foreach($venues as $city => $cityVenues)
    <div class="venue-area">

        <h2>{{ $city }}</h2>
        <ul>
            @foreach($cityVenues as $venue)
            <li>
            <div class="venue">
            <img src="{{ asset('images/venues/' . $venue->picture) }}" alt="{{ $venue->venue_name }}" class="venue-img">
                <div class="venue-info">
        <strong>{{ $venue->venue_name }}</strong> <p>Capacity: {{ $venue->capacity }} </p>
        <a href="https://maps.google.com/?q={{ urlencode($venue->venue_name) }}" target="_blank">View on Map</a>
        <form method="POST" action="{{ route('venues.select') }}">
            @csrf
            <input type="hidden" name="venue_id" value="{{ $venue->venue_id }}">
            <input type="hidden" name="venue_name" value="{{ $venue->venue_name }}">
            <div class="btn">
            <button type="submit">Select</button>
            </div>
            </div>
        </form>
            </li>

        @endforeach
    </ul>
    
@endforeach
</div>
</div>
</div>


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
