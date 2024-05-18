@extends('site.base')
@section('title'){{ $listing->title }} | @endsection

@section('content')

<!-- Breadcrumb -->
<section id="bc" class="mt-3">
    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('listings') }}">Listings</a>
                </li>
                <li class="breadcrumb-item active">{{ $listing->title }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Listing -->
<section id="listing" class="py-4">
    <div class="container">
        <a href="{{ route('listings') }}" class="btn btn-light mb-4">Back To Listings</a>
        <div class="row">
            <div class="col-md-9">
                <!-- Home Main Image -->
                <img src="{{ url($listing->thumbnail_0) }}" alt="" class="img-main img-fluid mb-3">
                <!-- Thumbnails -->
                <div class="row mb-5 thumbs">
                    @for ($i = 1; $i <= 6; $i++)
                        @php $thumbnail = "thumbnail_$i"; @endphp
                        @if ($listing->$thumbnail)
                            <div class="col-md-2">
                                <a href="{{ url($listing->$thumbnail) }}" data-lightbox="home-images">
                                    <img src="{{ url($listing->$thumbnail) }}" alt="" class="img-fluid">
                                </a>
                            </div>
                        @endif
                    @endfor
                </div>
                <!-- Fields -->
                <div class="row mb-5 fields">
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-money-bill-alt"></i> Asking Price:
                                <span class="float-right">${{ $listing->price }}</span>
                            </li>
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-bed"></i> Bedrooms:
                                <span class="float-right">{{ $listing->bedroom }}</span>
                            </li>
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-bath"></i> Bathrooms:
                                <span class="float-right">{{ $listing->bathroom }}</span>
                            </li>
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-car"></i> Garage:
                                <span class="float-right">{{ $listing->garage }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-th-large"></i> Square Feet:
                                <span class="float-right">{{ $listing->square_feet }}</span>
                            </li>
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-square"></i> Lot Size:
                                <span class="float-right">{{ $listing->lot_size }} Acres</span>
                            </li>
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-calendar"></i> Listing Date:
                                <span class="float-right">{{ $listing->created_at->diffForHumans() }}</span>
                            </li>
                            <li class="list-group-item text-secondary">
                                <i class="fas fa-bed"></i> Realtor:
                                <span class="float-right">{{ $listing->realtor->name }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Description -->
                <div class="row mb-5">
                    <div class="col-md-12">
                        {{ $listing->description }}
                    </div>
                </div>

                <!-- Reviews -->
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h5>Reviews</h5>
                        @foreach ($listing->reviews as $review)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6>{{ $review->user->name }} - <small>{{ $review->created_at->diffForHumans() }}</small></h6>
                                    <div>
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                        @for ($i = $review->rating; $i < 5; $i++)
                                            <i class="fas fa-star text-secondary"></i>
                                        @endfor
                                    </div>
                                    <p>{{ $review->review }}</p>
                                </div>
                            </div>
                        @endforeach

                        <!-- Review Form -->
                        @auth
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                            <input type="hidden" name="realtor_id" value="{{ $listing->realtor->id }}">
                            <div class="form-group">
                                <label for="rating">Rating:</label>
                                <select name="rating" class="form-control" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="review">Review:</label>
                                <textarea name="review" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                        @else
                        <p><a href="{{ route('login') }}">Log in</a> to leave a review.</p>
                        @endauth
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="card mb-3">
                    <img class="card-img-top" src="{{ url($listing->realtor->image) }}" alt="Realtor">
                    <div class="card-body">
                        <h5 class="card-title">Property Realtor</h5>
                        <h6 class="text-secondary">{{ $listing->realtor->name }}</h6>
                    </div>
                </div>
                <button class="btn-primary btn-block btn-lg" data-toggle="modal" data-target="#inquiryModal">Make An Inquiry</button>
                <a href="{{ route('calculation', $listing->id) }}" class="btn btn-primary btn-block btn-lg mt-3">Mortgage Calculator</a>
                
                <!-- Shortlist Button -->
                @auth
                @if ($listing->shortlists()->where('user_id', auth()->id())->exists())
                    <form action="{{ route('shortlist.destroy') }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <button type="submit" class="btn btn-danger btn-block">Remove from Shortlist</button>
                    </form>
                @else
                    <form action="{{ route('shortlist.store') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <button type="submit" class="btn btn-primary btn-block">Add to Shortlist</button>
                    </form>
                @endif
            @endauth

                <!-- Views and Shortlist Counts -->
                <div class="col-12 mt-3">
                    <div class="row ">
                        <div class="col">
                            <p>Views : {{ $listing->views()->count() }}</p>
                        </div>
                        <div class="col">
                            <p>Shortlisted: {{ $listing->shortlists()->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>



<!-- Inquiry Modal -->
<div class="modal fade" id="inquiryModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inquiryModalLabel">Make An Inquiry</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('send-message') }}" method="POST">
                    @csrf
                    <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <div class="form-group">
                        <label for="property_name" class="col-form-label">Property:</label>
                        <input type="text" name="listing" class="form-control" value="{{ $listing->title }}" disabled="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" name="name" class="form-control" @auth value="{{ Auth::user()->name }}" @endauth required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" name="email" class="form-control" @auth value="{{ Auth::user()->email }}" @endauth required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Phone:</label>
                        <input type="text" name="contact_number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-form-label">Message:</label>
                        <textarea name="message" class="form-control" required></textarea>
                    </div>
                    <hr>
                    <input type="submit" value="Send" class="btn btn-block btn-secondary">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
