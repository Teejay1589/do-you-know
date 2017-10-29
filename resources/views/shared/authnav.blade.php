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
				@if( View::getSection('title') == "Home" )
                    <li class="active"><a href="{{ route('welcome') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                @else
                    <li><a href="{{ route('welcome') }}"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
                @endif
                <li style="margin: auto 15px;">
	                <form class="navbar-form navbar-left" role="search" action="#">
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
{{-- @auth
    <a href="{{ url('/home') }}">Home</a>
@else
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>
@endauth --}}