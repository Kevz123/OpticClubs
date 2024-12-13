<!-- resources/views/events/create.blade.php -->
@extends('layouts.app')

@section('title', 'Optic Clubs - Create Event')

@section('content')
    @vite('resources/css/styles.css')

    <style>
        #bannerdi {
            background: linear-gradient(rgba(0,0,0,0.5), #128b9e94), url('{{ asset('images/home back.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }
    </style>
    <script>
        document.getElementById('eventForm').addEventListener('submit', function(event) {
    const price50 = document.getElementById('price_50').value;
    const price30 = document.getElementById('price_30').value;
    const price20 = document.getElementById('price_20').value;

    if (price50 < 0 || price30 < 0 || price20 < 0) {
        alert('Price ranges must be greater than or equal to 0.');
        event.preventDefault(); // Stop form submission
    }
    });

    </script>

    <section id="bannerdi">
        <div class="navbar">
            <br><br><br><br>
        </div>
        <div class="hero">
            <h1>Create Event</h1>
        </div>
        <div class="hometextbtn">
            <a href="#ex"><span>Explore</span></a>
        </div>
    </section>

    <div id="ex"></div>

    <div class="form-container">
        <h2>EVENT FORM</h2>
        <form method="POST" action="{{ route('events.store') }}" id="eventForm" enctype="multipart/form-data">
            @csrf

            <!-- Venue -->
            <label for="venue">Event Venue:</label><br>
            <a href="{{ route('venues.index') }}" class="btn">Select Venue</a>
            <input type="hidden" id="venue_id" name="venue_id" value="{{ session('selectedVenueId') }}"><br><br>
            <p id="selectedVenue">{{ session('selectedVenueName') ?? 'No venue selected' }}</p>

            <br>
            <!-- Event Name -->
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" required maxlength="255"
                pattern="^[A-Za-z0-9\s\-\_]+$" title="Event name can only contain letters, numbers, spaces, hyphens, and underscores.">
            <br><br>

            <!-- Main Picture Upload -->
            <label for="image">Upload Event Image:</label>
            <label for="image">(Accepted file types: jpeg, png, jpg, gif.)</label>
            <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" required>
            <img id="mainPicturePreview" alt="Main Picture Preview" style="display:none; width:100px; height:auto; margin-top:10px;">
            <br><br>

            <!-- Description -->
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required maxlength="500"
                    title="Description cannot exceed 100 characters."></textarea>
            <br>

            <!-- Event Date -->
            <label for="event_date">Event Date:</label>
            <input type="date" id="event_date" name="event_date" required min="{{ date('Y-m-d') }}">
            <br>
            <br>

            <!-- Start Time -->
            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" required>
            <br>
            <br>

            <!-- Club -->
            <label for="club_id">Club:</label>
            <select id="club_id" name="club_id" required>
                <option value="" disabled selected>Select a club</option>
                @foreach($clubs as $club)
                    <option value="{{ $club->club_id }}">{{ $club->name }}</option>
                @endforeach
            </select><br><br>

            <label>Select available seats :</label>
            <label for="price_50">VIP ($50):</label>
            <input type="number" id="price_50" name="price_ranges[50]" min="0" required>
            <br>

            <label for="price_30">Premium ($30):</label>
            <input type="number" id="price_30" name="price_ranges[30]" min="0" required>
            <br>

            <label for="price_20">Standard ($20):</label>
            <input type="number" id="price_20" name="price_ranges[20]" min="0" required>
            <br><br>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Create Event</button>
            <br>
            <br>
        </form>


        <script>
            // JavaScript function to preview the uploaded image
            function previewImage(event) {
                const imagePreview = document.getElementById('mainPicturePreview');
                const file = event.target.files[0];
                if (file) {
                    imagePreview.src = URL.createObjectURL(file);
                    imagePreview.style.display = 'block';
                } else {
                    imagePreview.style.display = 'none';
                }
            }
        </script>


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

