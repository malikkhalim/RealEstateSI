
@extends('site.base')

@section('title') About Us | @endsection
@section('content')

    <section id="showcase-inner" class="py-5 text-white">
        <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
            <h1 class="display-4">About Us</h1>
            <p class="lead">From Searching to Settling—We're With You Every Step.</p>
            </div>
        </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <section id="bc" class="mt-3">
        <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{% url 'listing:home' %}">
                <i class="fas fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item active"> About</li>
            </ol>
        </nav>
        </div>
    </section>

    <section id="about" class="py-4">
        <div class="container">
        <div class="row">
            <div class="col-md-8">
            <h2>Finding Your Ideal Home</h2>
            <p class="lead">"Personalized Service, Exceptional Results"</p>
            <img src="assets/img/about.jpg" alt="">
            <p class="mt-4">We believe everyone deserves the perfect place to call home. That's why our team dedicates every moment to understanding your needs and dreams, ensuring we offer tailored solutions that transform your vision into reality.

              From charming suburban houses to vibrant city apartments, our extensive portfolio ensures you have the best options to choose from. We prioritize your satisfaction, providing transparent, honest, and personalized services to guide you smoothly through your home buying journey. Whether you're buying your first home or seeking a luxurious retreat, we're here to make your property aspirations come true, with integrity and professionalism.</p>
            </div>
            <div class="col-md-4">
            @if($som)
            <div class="card">
                <img class="card-img-top" src="{{ url($som -> realtor-> image) }}" alt="Seller of the month">
                <div class="card-body">
                <h5 class="card-title">Seller Of The Month</h5>
                <h6 class="text-secondary">{{ $som ->realtor-> name }}</h6>
                <p class="card-text">
                </p>
                </div>
            </div>
            @endif
            </div>
        </div>
        </div>
    </section>

    <!-- Work -->
    <section id="work" class="bg-dark text-white text-center">
        <h2 class="display-4">We're Here For You</h2>
        <h4>Guiding you home with care and expertise. Find your perfect place with us.</h4>
        <hr>
    <a href="{{ route('listings') }}" class="btn btn-secondary text-white btn-lg">View Our Featured Listings</a>
    </section>

  <!-- Team -->
  <section id="team" class="py-5">
    <div class="container">
      <h2 class="text-center">Our Team</h2>
      <div class="row text-center">

        @foreach ($realtors as $realtor)
        
        <div class="col-md-4">
          <img src="{{ url($realtor -> image) }}" alt="" class="rounded-circle mb-3">
          <h4>{{ $realtor -> name }}</h4>
          <p class="text-success">
            <i class="fas fa-award text-success mb-3"></i> Realtor</p>
          <hr>
          <p>
            <i class="fas fa-phone"></i> {{ $realtor -> contact_number }}</p>
          <p>
            <i class="fas fa-envelope-open"></i> {{ $realtor -> email }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </section>

@endsection