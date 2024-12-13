@extends('layouts.app')

@section('title', 'Optic Clubs - My Clubs')

@section('content')
    @vite('resources/css/styles.css')

    {{-- Flash Message Display --}}
@if(session('success'))
<div class="alert alert-success" style="color: green; padding: 10px; background-color: #e1f8e3; border: 1px solid #d4edda; margin-bottom: 15px;">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger" style="color: red; padding: 10px; background-color: #f8d7da; border: 1px solid #f5c6cb; margin-bottom: 15px;">
    {{ session('error') }}
</div>
@endif

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

    <section id="bannerdi">
        <div class="navbar">
            <br><br><br><br>
        </div>
        <div class="hero">
            <h1>My Clubs</h1>
        </div>
        <div class="hometextbtn">
            <a href="#ex"><span>Explore</span></a>
        </div>
    </section>

    <div id="ex"></div>
    <br>
    <br>

    <div class="center-wrapper" style="display: flex; justify-content: center; padding: 20px;">
        <div class="club-list">
            <h1 style="display: flex; justify-content: center;font-family: Arial, sans-serif; font-weight: bold; font-size: 2.5rem; margin-top: 40px; margin-bottom: 20px; color: #2e34f7;">
                My Clubs
            </h1>
            
            <div class="clubsowner-container">
                @foreach ($clubs as $club)
                    <div class="club-card">
                        <img src="{{ asset('storage/' . $club->main_image) }}" alt="{{ $club->name }}" class="club-image">
                        <h5 class="card-title">{{ $club->name }}</h5>
                        <form action="{{ route('clubs.show', ['club_id' => $club->club_id]) }}" method="GET" style="display:inline;">
                            <button type="submit" class="btn btn-primary">View</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <br>
    
    
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

