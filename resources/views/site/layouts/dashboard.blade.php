
@extends('site.base')

@section('title') About Us | @endsection
@section('content')

<section id="showcase-inner" class="py-5 text-white">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12">
        <h1 class="display-4">User Dashboard</h1>
        <p class="lead">Get The Real House</p>
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
          <a href="/">
            <i class="fas fa-home"></i> Home</a>
        </li>
        <li class="breadcrumb-item active"> Dashboard</li>
      </ol>
    </nav>
  </div>
</section>



<div class="container mt-5">

  <!-- Shortlisted Properties -->
  <div class="card mt-4">
      <div class="card-header">
          <h2>Shortlisted Properties</h2>
      </div>
      <div class="card-body">
          @if($shortlistedProperties->isEmpty())
              <p>No properties have been shortlisted yet.</p>
          @else
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>Property Title</th>
                          <th>Price</th>
                          <th>Description</th>
                          <th>Date Upload</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($shortlistedProperties as $shortlist)
                          <tr>
                              <td>{{ $shortlist->listing->title }}</td>
                              <td>${{ $shortlist->listing->price }}</td>
                              <td>{{ $shortlist->description }}</td>
                              <td>{{ $shortlist->created_at->format('d-m-Y') }}</td>
                              <td>
                                  <a href="{{ route('single.listing', $shortlist-> listing -> id) }}" class="btn btn-info">View Property</a>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          @endif
      </div>
  </div>
</div>

@endsection