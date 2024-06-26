@extends('site.base')

@section('title') BecomeRealtor | @endsection
@section('content')

<section id="showcase-inner" class="py-5 text-white">
    <div class="container">
    <div class="row text-center">
        <div class="col-md-12">
        <h1 class="display-4">Realtor</h1>
        <p class="lead">Become a realtor to sell your house & property.</p>
        </div>
    </div>
    </div>
</section>

    
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row px-3">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Add Realtor</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Realtor</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
                @endif
                    <form action="{{ route('becomerealtor.store') }}" method="POST" class="form-horizontal m-t-30" enctype="multipart/form-data"> 
                        @csrf
                        
                        <div class="form-group">
                            <label>Realtor Name :</label>
                            <input readonly type="text" name="name" class="form-control" placeholder="Realtor Name" value="{{ Auth::user()->get_full_name() }}">
                        </div>
                        <div class="form-group">
                            <label>Email :</label>
                            <input readonly type="email" id="example-email" name="email" class="form-control" placeholder="Email" value="{{ Auth::user()->get_email() }}">
                        </div>

                        <div class="form-group">
                            <label>Address :</label>
                            <input type="text" id="example-email" name="address" class="form-control" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label>Contact Number :</label>
                            <input type="number" name="contact_number" class="form-control" placeholder="Contact Number">
                            <!-- <textarea class="form-control" rows="5"></textarea> -->
                        </div>

                        <div class="form-group">
                            <label>Upload Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input">
                                <label for="image" class="custom-file-label"> Choose Image
                                </label>                              
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

@endsection