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

		            {{-- Admin Manage System --}}
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