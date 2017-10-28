@extends("layouts.$page->layout")

@section('title', $page->title)

@section('content')
<h4>{{ $page->title }}</h4>
@if ( isset($page->action) && $page->action == "create")
{{-- <div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
		    <div class="panel-heading">Create Goal Form</div>
		    <div class="panel-body">
				<form action="{{ route('save_goal') }}" method="POST">
					<div class="form-group">
						{{ csrf_field() }}
					</div>
					
					<div class="form-group">
						<label>Goal: <span class="text-danger">*</span></label>
						<textarea class="form-control" name="goal" rows="3" placeholder="Enter Goal" required>{{ old('goal') }}</textarea>
					</div>

					<div class="text-right">
						<button type="submit" class="btn btn-primary">Create</button>
					</div>
				</form>
		    </div>
		</div>
	</div>
</div> --}}
@elseif ( isset($page->action) && $page->action == "update")
{{-- <div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
		    <div class="panel-heading">Update Goal Form</div>
		    <div class="panel-body">
				<form action="{{ route('update_goal', ['id' => $active_object->id]) }}" method="POST">
					<div class="form-group">
						{{ csrf_field() }}
					</div>
					
					<div class="form-group">
						<label>Goal: <span class="text-danger">*</span></label>
						<textarea class="form-control" name="goal" rows="3" placeholder="Enter Goal" required>{{ old('goal', $active_object->goal) }}</textarea>
					</div>
					
					<div class="form-group">
                        <div class="checkbox">
                            <label>
                            	<input type="checkbox" name="is_achieved" {{ old('is_achieved', $active_object->is_achieved) ? 'checked' : '' }}> Is Achieved
                            </label>
                        	<span class="help-block">Check if you have achieved your GOAL</span>
                        </div>
                    </div>

					<div class="text-right">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
		    </div>
		</div>
	</div>
</div> --}}
@elseif ( isset($page->action) && $page->action == "view")
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
		    <div class="panel-heading">User View</div>
		@isset ($active_object)
		    <div class="panel-body">
					<div class="col-md-4">
						<img src="{{ asset($active_object->avatar) }}" class="thumbnail" alt="avatar" style="max-height: 200px;">
					</div>
					<div class="col-md-4">
						<dl>
							<dt>Username</dt>
							<dd>{{ $active_object->username }}</dd>
							<dt>Name</dt>
							<dd>{{ $active_object->name }}</dd>
							<dt>Email</dt>
							<dd>{{ $active_object->email }}</dd>
							<dt>Telephone</dt>
							<dd>{{ $active_object->telephone }}</dd>
						</dl>
					</div>
					<div class="col-md-4">
						<dl>
							<dt>Gender</dt>
							<dd>{{ $active_object->gender }}</dd>
							<dt>School</dt>
							<dd>
								@foreach ($schools as $element)
									@if ($element->id == $active_object->school_id)
										{{ $element->school }}
									@endif
									@break($element->id == $active_object->school_id)
								@endforeach
							</dd>
							<dt>Organisation</dt>
							<dd>
								@foreach ($organisations as $element)
									@if ($element->id == $active_object->organisation_id)
										{{ $element->organisation }}
									@endif
									@break($element->id == $obj->organisation_id)
								@endforeach
							</dd>
							<dt>Role</dt>
							<dd>
								<u class="mark">
									@foreach ($roles as $element)
										@if ($element->id == $active_object->role_id)
											{{ strtoupper($element->role) }}
										@endif
										@break($element->id == $active_object->role_id)
									@endforeach
								</u>
							</dd>
						</dl>
					</div>
		    </div>
		    <div class="panel-footer">
		    	<strong>Created At:</strong>
		    	@isset ($active_object->created_at)
		    	<span>{{ Carbon::createFromFormat('Y-m-d H:i:s', $active_object->created_at)->toDayDateTimeString() }}</span>
		    	@endisset
		    </div>
		@endisset
		</div>
	</div>
</div>
@else
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">All Users Table</div>
			<div class="panel-body">
				<div class="table-wrapper">
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Username</th>
								<th>Name</th>
								<th>Email</th>
								<th>Telephone</th>
								<th>Gender</th>
								<th>School</th>
								<th>Organization</th>
								<th>Avatar</th>
								<th>Role</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($users as $obj)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $obj->username }}</td>
								<td>{{ $obj->name }}</td>
								<td>{{ $obj->email }}</td>
								<td>{{ $obj->telephone }}</td>
								<td>{{ $obj->gender }}</td>
								<td>
									@foreach ($schools as $element)
										@if ($element->id == $obj->school_id)
											{{ $element->school }}
										@endif
										@break($element->id == $obj->school_id)
									@endforeach
								</td>
								<td>
									@foreach ($organisations as $element)
										@if ($element->id == $obj->organisation_id)
											{{ $element->organisation }}
										@endif
										@break($element->id == $obj->organisation_id)
									@endforeach
								</td>
								<td>
									<img src="{{ asset($obj->avatar) }}" alt="avatar" style="max-height: 50px;">
								</td>
								<td>
									@foreach ($roles as $element)
										@if ($element->id == $obj->role_id)
											{{ $element->role }}
										@endif
										@break($element->id == $obj->role_id)
									@endforeach
								</td>
								{{-- <td>{!! $obj->booleanLabel($obj->is_achieved) !!}</td> --}}
								<td>
									<a href="{{ url('/user/view/'.$obj->id) }}" title="view">view</a>
								</td>
							</tr>
							@empty
							<tr>
								<td class="text-danger">NO USERS</td>
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
