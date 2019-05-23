

<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
    @if (Auth::guest())
        {{-- <li><a href="{{ url('/login') }}">Login</a></li> --}}
    @else
    <ul class="nav navbar-nav navbar-right">
        @include('layouts.komponen.backend.tombol_pilih_cabang')                        
            <li class="dropdown @if(isset($backend_profile_home)) active @endif"     >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->nama }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li role="separator" class="divider"></li>                            
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                </ul>
            </li>
        </ul>
    @endif   
    </ul>
  </div>

</nav>