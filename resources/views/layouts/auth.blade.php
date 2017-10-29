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
      select.form-control {
         width: 100%;
      }
      .nav-btn:hover {
				background: transparent;
      }

      #login-dp {
		    min-width: 250px;
		    padding: 14px 14px 0;
		    overflow:hidden;
		    background-color:rgba(255,255,255,1);
		}
		#login-dp .help-block {
		    font-size:12px    
		}
		#login-dp .bottom {
		    background-color:rgba(255,255,255,1);
		    border-top:1px solid #ddd;
		    clear:both;
		    padding:14px;
		}
		#login-dp .social-buttons {
		    margin:12px 0    
		}
		#login-dp .social-buttons a {
		    width: 49%;
		}
		#login-dp .form-group {
		    margin-bottom: 10px;
		}
		.btn-fb {
		    color: #fff;
		    background-color:#3b5998;
		}
		.btn-fb:hover {
		    color: #fff;
		    background-color:#496ebc 
		}
		.btn-tw {
		    color: #fff;
		    background-color:#55acee;
		}
		.btn-tw:hover {
		    color: #fff;
		    background-color:#59b5fa;
		}
		@media(max-width:768px) {
		    #login-dp {
		        /*background-color: inherit;*/
		        /*color: #fff;*/
		    }
		    #login-dp .bottom {
		        /*background-color: inherit;*/
		        border-top:0 none;
		    }
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
                <ul class="nav navbar-nav navbar-left">
					@if( View::getSection('title') == "Dashboard" )
	                    <li class="active"><a href="{{ route('welcome') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
	                @else
	                    <li><a href="{{ route('welcome') }}"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
	                @endif
	                <li style="margin: auto 15px;">
		                <form class="navbar-form navbar-left" role="search">
		                	<div class="form-group">
						        <input type="text" class="form-control" placeholder="Search">
						        <button type="submit" class="btn btn-link nav-btn">
						        	<i class="glyphicon glyphicon-search"></i>
						        </button>
		                	</div>
				      	</form>
	                </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        {{-- <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li> --}}
                        <li class="navbar-text">Already have an account?</li>
				        <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
							<ul id="login-dp" class="dropdown-menu">
								<li>
									 <div class="row">
										<div class="col-md-12">
											{{-- <p class="text-center">Login via</p>
											<div class="social-buttons">
												<a href="#" class="btn btn-fb"><i class="glyphicon glyphicon-facebook"></i> Facebook</a>
												<a href="#" class="btn btn-tw"><i class="glyphicon glyphicon-twitter"></i> Twitter</a>
											</div>
			                                <p class="text-center">OR</p> --}}
											 <form class="form" role="form" method="POST" action="{{ route('login') }}" id="login-nav">
											 	{{ csrf_field() }}

												<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
													 <label for="username" class="sr-only control-label">Username</label>
													 <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus placeholder="Username">
												</div>
												<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
													 <label for="password" class="sr-only control-label">Password</label>
													 <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
												</div>
												<div class="form-group">
													<div class="checkbox">
														 <label>
														 	<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
														 </label>
													</div>
		                                             <div class="help-block text-right"><a href="{{ route('password.request') }}">Forgot Your Password?</a></div>
												</div>
												<div class="form-group">
													 <button type="submit" class="btn btn-primary btn-block">Login</button>
												</div>
											 </form>
										</div>
										<div class="bottom text-center">
											New here? <a href="{{ route('register') }}"><b>Register Now</b></a>
										</div>
									 </div>
								</li>
							</ul>
				        </li>
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
                        @if( View::getSection('title') == "Manage System" )
                          <a class="list-group-item active" data-toggle="collapse" data-parent="#sidebar" href="#m7">&plus; Manage System</a>
                          <div id="m7" class="collapse in">
                        @else
                          <a class="list-group-item" data-toggle="collapse" data-parent="#sidebar" href="#m7">&plus; Manage System</a>
                          <div id="m7" class="collapse">
                        @endif
                            <a class="list-group-item" href="{{ url('/facts') }}"><small>Facts</small> <span class="badge">{{ count($facts) }}</span></a>
                            <a class="list-group-item" href="{{ url('/tags') }}"><small>Tags</small> <span class="badge">{{ count($tags) }}</span></a>
                            <a class="list-group-item" href="{{ url('/users') }}"><small>Users</small> <span class="badge">{{ count($users) }}</span></a>
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
    {{-- <script src="{{ asset('asset/js/app.js') }}"></script> --}}
    <script src="{{ asset('asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    @if( View::hasSection('page_scripts') )
      @yield('page_scripts')
    @endif
</body>
</html>
