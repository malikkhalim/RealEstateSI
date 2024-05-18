

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-secondary sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('index') }}">
        <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav">
        <li class="nav-item {{ (request()->routeIs('index')) ? 'active' : '' }}  mr-3">
            <a class="nav-link" href="{{ route('index') }}">Home</a>
          </li>
          <li class="nav-item mr-3 {{ (request()->routeIs('listings')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('listings') }}">Featured Listings</a>
          </li>
          <li class="nav-item mr-3 {{ (request()->routeIs('about')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('about') }}">About</a>
          </li>
        </ul>
        
        
        <ul class="navbar-nav ml-auto">
          @auth
          <!-- <li class="nav-item mr-3 {{ (request()->routeIs('dashboard')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="fas fa-user-plus"></i> Dashboard</a>
            </li>
            <li class="nav-item mr-3"> -->
          <div class="dropdown mr-3 {{ (request()->routeIs('dashboard')) ? 'active' : '' }}">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: rgba(0, 0, 0, 0.5) !important;">
              {{ Auth::user()->get_full_name() }}
            </button>
            <ul class="dropdown-menu bg-secondary" aria-labelledby="dropdownMenuButton">
              @if (Auth::user()->role == 1)
              <li><a class="nav-link" href="{{ route('inquiry.index') }}" >
                <i class="fas fa-clipboard"></i> Inquiry</a></li>
              <li><a class="nav-link" href="{{ route('mylisting.index') }}" >
                <i class="fas fa-list"></i> My Listings</a></li>
              @endif

              @if (Auth::user()->role == 2)
              <li><a class="nav-link" href="{{ route('becomerealtor.index') }}">
                <i class="fas fa-window-maximize"></i> Realtor</a></li>
              @endif
              <li><a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-window-maximize"></i> Dashboard</a></li>
              <li><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                document.getElementById('frm-logout').submit();">
                <i class="fas fa-sign-in-alt"></i>  Logout
              </a></li>
            </ul>
          </div>    

          <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
            {{-- <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit">Logout</button>
            </form> --}}
            </li>
          @else
          <li class="nav-item mr-3 {{ (request()->routeIs('register')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('register') }}">
              <i class="fas fa-user-plus"></i> Register</a>
          </li>
          <li class="nav-item mr-3 {{ (request()->routeIs('login')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('login') }}">
              <i class="fas fa-sign-in-alt"></i>

              Login</a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>