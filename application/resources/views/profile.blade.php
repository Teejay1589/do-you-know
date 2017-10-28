@extends("layouts.$page->layout")

@section('title', $page->title)

@section('content')
<h4>{{ $page->title }}</h4>
@if ( isset($page->action) && $page->action == "create")

@elseif ( isset($page->action) && $page->action == "update")

@else
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<ul class="nav nav-tabs nav-justified">
		  <li class="active"><a data-toggle="tab" href="#profiledetails">Profile Details</a></li>
		  <li><a data-toggle="tab" href="#changepassword">Change Password</a></li>
		</ul>
		<div class="tab-content">
		  <div id="profiledetails" class="tab-pane fade in active">
		    <h3>Profile Details</h3>
		    <p>Update profile information here.</p>
		    <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					{{ csrf_field() }}
				</div>

				<div class="form-group {{ $errors->has('avatar') ? ' has-error' : '' }}"> 
            <div id="preview">
                <label for="avatar">Avatar: </label>
                @if ( session()->get('avatar_temp') != null )
                <img class="thumbnail img-responsive center-block change_avatar" src="{{ asset(session()->get('avatar_temp')) }}" alt="Avatar" height="150px" width="150px">
                @else
                <img class="thumbnail img-responsive center-block change_avatar" src="{{ asset(Auth::user()->avatar) }}" alt="Avatar" height="150px" width="150px">
                @endif
            </div>
            <div class="center-block text-center" style="position:abolute; margin: -50px auto 20px auto; z-index: 9;">
                <a class="change_avatar btn btn-xs btn-primary btn-cta">change</a>
            </div>
        </div>
				
				<div class="row">
					<div class="form-group col-md-4">
						<label for="username">Username: <span class="text-danger">*</span></label>
						<input class="form-control" placeholder="Your Username" type="text" name="username" value="{{ old('username', Auth::user()->username) }}" required>
					</div>

					<div class="form-group col-md-8">
						<label for="name">Name: <span class="text-danger">*</span></label>
						<input class="form-control" placeholder="Your Name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-md-8">
						<label for="email">Email: {{-- <span class="text-danger">*</span> --}}</label>
						<input class="form-control" placeholder="Your Email" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" >
					</div>
					<div class="form-group col-md-4">
						<label for="telephone">Telephone: {{-- <span class="text-danger">*</span> --}}</label>
						<input class="form-control" placeholder="Your Telephone" type="telephone" name="telephone" value="{{ old('telephone', Auth::user()->telephone) }}" >
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-4">
						<label for="gender">Gender: <span class="text-danger">*</span></label>
						<select class="form-control" name="gender" required>
							@if ( old('gender', Auth::user()->gender) == "MALE" )
								<option value="MALE" selected>MALE</option>
							@else
								<option value="MALE">MALE</option>
							@endif
							@if ( old('gender', Auth::user()->gender) == "FEMALE" )
								<option value="FEMALE" selected>FEMALE</option>
							@else
								<option value="FEMALE">FEMALE</option>
							@endif
						</select>
					</div>

					<div class="form-group col-md-8">
						<label for="role">Role: <span class="text-danger">*</span></label>
						<select class="form-control" name="role" required {{ (Auth::user()->role_id == 3) ? '' : 'disabled' }}>
							@foreach ($roles as $element)
								@if ($element->id == Auth::user()->role_id)
								<option value="{{ $element->id }}" selected>{{ $element->role }}</option>
								@else
								<option value="{{ $element->id }}">{{ $element->role }}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>

				<div class="text-right">
					<button type="submit" class="btn btn-primary">Update Profile</button>
				</div>
			</form>
		  </div>
		  <div id="changepassword" class="tab-pane fade">
		    <h3>Change Password</h3>
		    <p>change password here.</p>
		    {{-- <div class="panel panel-primary">
			    <div class="panel-heading">Change Password Form</div>
			    <div class="panel-body"> --}}
					<form action="{{ route('change_password') }}" method="POST">
						<div class="form-group">
							{{ csrf_field() }}
						</div>

						<div class="form-group">
							<label for="current_password">Current Password: <span class="text-danger">*</span></label>
							<input class="form-control" placeholder="Your Current Password" type="password" name="current_password" required>
						</div>

						<div class="form-group">
							<label for="new_password">New Password: <span class="text-danger">*</span></label>
							<input class="form-control" placeholder="Your New Password" type="password" name="new_password" required>
						</div>

						<div class="form-group">
							<label for="new_password_confirmation">Confirm New Password: <span class="text-danger">*</span></label>
							<input class="form-control" placeholder="Confirm New Password" type="password" name="new_password_confirmation" required>
						</div>

						<div class="text-right">
							<button type="submit" class="btn btn-primary">Change Password</button>
						</div>
					</form>
			    {{-- </div>
			</div> --}}
		  </div>
		</div>
	</div>
</div>
@endif
<br><br><br>
@endsection

@section('page_scripts')
<!-- AJAX Pic Upload - avatar -->
<form id="avatar" name="avatar" method="POST" enctype="multipart/form-data" class="center-block text-center" style="opacity: 0; position:absolute; margin-top:-50px; z-index: -1;">
    {{ csrf_field() }}
    <input type="file" name="avatar_temp" class="form-control input-sm" accept="image/gif, image/jpeg, image/png" onchange="$('#avatar').submit(); this.value='';" form="avatar" hidden>
</form>
<script type='text/javascript'>
    $('.change_avatar').click(function(e) {
        e.preventDefault();
        $('input[name="avatar_temp"]').click();
    });

    $("#avatar").on('submit',(function(e) {
      e.preventDefault();
      $.ajax({
        url: "{{ url('/upload-avatar') }}",
        type: 'POST',
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data) {
            // alert(data);
            if(data=='invalid file') {
             // invalid file format.
            } else {
             // view uploaded file.
             // $('#preview').html(data);
             $('img.change_avatar').attr('src', data);
             $('#avatar')[0].reset();
            }
          }         
        });
     }));
</script>
<!-- /AJAX Pic Upload -->
@endsection