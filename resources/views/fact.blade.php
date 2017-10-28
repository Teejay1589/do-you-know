@extends("layouts.$page->layout")

@section('title', $page->title)

@section('content')
<h4>{{ $page->title }}</h4>
@if ( isset($page->action) && $page->action == "create")
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
		    <div class="panel-heading">Create Fact Form</div>
		    <div class="panel-body">
				<form action="{{ route('save_fact') }}" method="POST">
					<div class="form-group">
						{{ csrf_field() }}
					</div>
					
					<div class="row">
						<div class="form-group col-md-9">
							<label>Fact: <span class="text-danger">*</span></label>
							<textarea class="form-control" name="fact" rows="5" placeholder="Enter Fact" required>{{ old('fact') }}</textarea>
						</div>

						<div class="form-group col-md-3 {{ $errors->has('avatar') ? ' has-error' : '' }}"> 
		            <div id="preview">
		                <label for="fact_image">Fact Image: </label>
		                @if ( session()->get('avatar_temp') != null )
		                <img class="thumbnail img-responsive center-block change_avatar" src="{{ asset(session()->get('avatar_temp')) }}" alt="Avatar" height="150px" width="150px">
		                @else
		                <img class="thumbnail img-responsive center-block change_avatar" src="{{ asset('') }}" alt="Fact Image" height="150px" width="150px">
		                @endif
		            </div>
		            <div class="center-block text-center" style="position:abolute; margin: -50px auto 20px auto; z-index: 9;">
		                <a class="change_avatar btn btn-xs btn-primary btn-cta">Add</a>
		            </div>
		        </div>
					</div>

					<div class="text-right">
						<button type="submit" class="btn btn-primary">Create</button>
					</div>
				</form>
		    </div>
		</div>
	</div>
</div>
@elseif ( isset($page->action) && $page->action == "update")
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
		    <div class="panel-heading">Update Fact Form</div>
		    <div class="panel-body">
				<form action="{{ route('update_fact', ['id' => $active_object->id]) }}" method="POST">
					<div class="form-group">
						{{ csrf_field() }}
					</div>
					
					<div class="form-group">
						<label>Fact: <span class="text-danger">*</span></label>
						<textarea class="form-control" name="fact" rows="3" placeholder="Enter Fact" required>{{ old('fact', $active_object->fact) }}</textarea>
					</div>
					
					@if (Auth::user()->role_id == 3)
						<div class="form-group">
	              <div class="checkbox">
	                  <label>
	                  	<input type="checkbox" name="is_approved" {{ old('is_approved', $active_object->is_approved) ? 'checked' : '' }}> Is Approved
	                  </label>
	              	<span class="help-block">Check to approve FACT</span>
	              </div>
	          </div>
					@endif

					<div class="text-right">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
		    </div>
		</div>
	</div>
</div>
@else
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">My Facts Table</div>
			<div class="panel-body">
				<div class="table-wrapper">
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Fact</th>
								<th>Is Approved</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse (Auth::user()->facts as $obj)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ str_limit($obj->fact, 100) }}</td>
								<td>{!! $obj->booleanLabel($obj->is_approved) !!}</td>
								<td>
									<a href="{{ url('/fact/update/'.$obj->id) }}" title="update">upd</a>
									<a href="{{ url('/fact/delete/'.$obj->id) }}" title="delete" class="text-danger">del</a>
								</td>
							</tr>
							@empty
							<tr>
								<td></td>
								<td class="text-danger">YOU HAVE NO SAVED FACTS</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
<br><br><br>
@endsection
