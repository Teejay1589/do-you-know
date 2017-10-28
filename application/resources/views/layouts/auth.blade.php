<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}{{ (isset($page->title)) ? ' - '.$page->title : '' }}</title>

    <!-- Styles -->
    <link href="{{ asset('asset/css/color/blue-grey.css') }}" rel="stylesheet">
    @if( View::hasSection('page_styles') )
      @yield('page_styles')
    @endif

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> --}}

    <style type="text/css">
      /*html, body {
          font-family: 'Raleway', sans-serif;
      }*/
      * {
        border-radius: 0 !important;
      }
      .table-wrapper {
        overflow-x: scroll;
      }
      textarea {
        resize: vertical;
      }
      #sidebar .list-group-item {
        border: none;
      }
    </style>
</head>
<body style="background: #f7f7f7;">
	<div id="app">
    	<nav class="navbar navbar-inverse navbar-static-top" style="padding: 0; margin: 0;">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-parent="#app" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}" title="Do You Know?">
                  <small>
                      <img src="{{ asset('asset/img/user.png') }}" alt="LOGO" style="max-height: 30px;">
                    	{{ config('app.name', 'Laravel') }}
                  </small>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                  @if( View::getSection('title') == "Dashboard" )
                    <li class="active"><a href="{{ route('welcome') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                  @else
                    <li><a href="{{ route('welcome') }}"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
                  @endif

                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              <img class="img img-responsive" src="{{ asset(Auth::user()->avatar) }}" alt="Avatar" style="max-height: 20px; display: inline;"> 
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="divider" style="margin: 0;"></li>
                                <li class="disabled"><a href="javascript:void(0);" class=""><strong>{{ $roles[Auth::user()->role_id - 1]['role'] }}</strong></a></li>
                                <li class="divider" style="margin: 0;"></li>
                                @if ($page->title == "Dashboard")
                                <li class="active"><a href="{{ route('home') }}">Dashboard</a></li>
                                @else
                                <li><a href="{{ route('home') }}">Dashboard</a></li>
                                @endif
                                @if ($page->title == "Manage Profile")
                                <li class="active"><a href="{{ route('profile') }}">profile</a></li>
                                @else
                                <li><a href="{{ route('profile') }}">profile</a></li>
                                @endif
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    	</nav>

      <div id="sidebar" class="col-lg-3 col-md-3 col-sm-4 collapse in">
  			<div class="row">
  				<div class="panel panel-primary" style="padding: 0; margin: 0;">
  					<div class="panel-body" style="padding: 0; margin: 0;">
  						<div class="list-group list-unstyled">
  								<div class="clearfix"><br></div>
  								<img class="thumbnail img-responsive center-block" src="{{ asset(Auth::user()->avatar) }}" alt="Avatar" height="150px" width="150px">
  				            <li class="divider" style="margin: -15px auto;"><hr></li>
  				            @if( View::getSection('title') == "Dashboard" )
  				              <a class="list-group-item active" href="{{ url('/home') }}">Dashboard</a>
  				            @else
  				              <a class="list-group-item" href="{{ url('/home') }}">Dashboard</a>
  				            @endif
  				            @if( View::getSection('title') == "Update Profile" )
  				              <a class="list-group-item active" href="{{ url('/profile') }}">Update Profile</a>
  				            @else
                        <a class="list-group-item" href="{{ url('/profile') }}">Update Profile</a>
                      @endif
  				              <a class="list-group-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
  				            <li class="divider" style="margin: -15px auto;"><hr></li>
  				            @if( View::getSection('title') == "Manage Facts" )
  				              <a class="list-group-item active" data-toggle="collapse" data-parent="#sidebar" href="#m0">&mdash; Manage Facts <span class="badge">{{ count(Auth::user()->facts) }}</span></a>
  				            	<div id="m0" class="collapse in">
  				            @else
  				              <a class="list-group-item" data-toggle="collapse" data-parent="#sidebar" href="#m0">&mdash; Manage Facts <span class="badge">{{ count(Auth::user()->facts) }}</span></a>
  				            	<div id="m0" class="collapse">
                      @endif
                          <a class="list-group-item" href="{{ url('/fact/create') }}"><small>Create Facts</small></a>
                          <a class="list-group-item" href="{{ url('/fact') }}"><small>View Facts</small></a>
                        </div>
                      @if (Auth::user()->role_id == 3)
                        @if( View::getSection('title') == "Manage Users" )
                          <a class="list-group-item active" data-toggle="collapse" data-parent="#sidebar" href="#m7">&plus; Manage Users <span class="badge">{{ count($users) }}</span></a>
                          <div id="m7" class="collapse in">
                        @else
                          <a class="list-group-item" data-toggle="collapse" data-parent="#sidebar" href="#m7">&plus; Manage Users <span class="badge">{{ count($users) }}</span></a>
                          <div id="m7" class="collapse">
                        @endif
                            <a class="list-group-item" href="{{ url('/user') }}"><small>View Users</small></a>
                          </div>
                      @endif
  			            </div>
  					</div>
  				</div>
  			</div>
      </div>

        {{-- <div id="content" class="col-lg-9 col-md-9 col-sm-8 "> --}}
        {{-- <div id="content" class="col-lg-12 col-md-12 col-sm-12"> --}}
        <div class="col-lg-9 col-md-9 col-sm-8">
        	<div class="container-fluid">
	    		   <div class="clearfix"><br></div>
              <div class="row">
	     		      @include('shared.alerts')
	          
	          	  @yield('content')
             </div>
        	</div>
      	</div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('asset/js/app.js') }}"></script>
    @if( View::hasSection('page_scripts') )
      @yield('page_scripts')
    @endif
</body>
</html>
