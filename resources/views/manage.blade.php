@extends("layouts.$page->layout")

@section('title', $page->title)

@section('page_styles')
@endsection

@section('content')
<h4>{{ $page->title }} {{ ucwords($page->action) }}</h4>
@if ( isset($page->action) && $page->action == "users")
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Users Table</div>
			<div class="panel-body">
				<div class="table-wrapper">
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th style="width: 10px;">#</th>
								<th>Username</th>
								<th>Name</th>
								<th>Email</th>
								<th>Telephone</th>
								<th>Gender</th>
								<th>Avatar</th>
								{{-- <th>Actions</th> --}}
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
									<img src="{{ asset($obj->avatar) }}" alt="" style="max-height: 50px;">
								</td>
								{{-- <td>
									<a href="{{ url('/user/ban/'.$obj->id) }}" title="ban">ban</a>
								</td> --}}
							</tr>
							@empty
							<tr>
								<td></td>
								<td class="text-danger">THERE ARE NO USERS IN THE SYSTEM</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@elseif ( isset($page->action) && $page->action == "facts")
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Facts Table</div>
			<div class="panel-body">
				<div class="table-wrapper">
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th style="width: 10px;">#</th>
								<th>Fact</th>
								<th>Fact Image</th>
								<th>Fact Tags</th>
								<th>Is Approved</th>
								{{-- <th>Actions</th> --}}
							</tr>
						</thead>
						<tbody>
							@forelse ($facts as $obj)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ str_limit($obj->fact, 132) }}</td>
								<td>
									<img src="{{ asset($obj->fact_image) }}" alt="" style="max-height: 50px;">
								</td>
								<td>
									@php
										$obj->tags = json_decode($obj->tags);
									@endphp
									@isset ($obj->tags)
										@foreach ($obj->tags as $element)
											<span class="label label-primary">{{ $element }}</span> 
										@endforeach
									@endisset
								</td>
								<td>{!! $obj->booleanLabel($obj->is_approved) !!}</td>
								<td>
									<a href="{{ url('/fact/update/'.$obj->id) }}" title="update">upd</a>
									{{-- <a href="{{ url('/fact/delete/'.$obj->id) }}" title="delete" class="text-danger">del</a> --}}
								</td>
							</tr>
							@empty
							<tr>
								<td></td>
								<td class="text-danger">THERE ARE NO FACTS IN THE SYSTEM</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@elseif ( isset($page->action) && $page->action == "tags")
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Tags Table</div>
			<div class="panel-body">
				<div class="table-wrapper">
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th style="width: 10px;">#</th>
								<th>Tag</th>
								{{-- <th>Actions</th> --}}
							</tr>
						</thead>
						<tbody>
							@forelse ($tags as $obj)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $obj->tag }}</td>
								{{-- <td>
									<a href="{{ url('/tag/update/'.$obj->id) }}" title="update">upd</a>
									<a href="{{ url('/tag/delete/'.$obj->id) }}" title="delete" class="text-danger">del</a>
								</td> --}}
							</tr>
							@empty
							<tr>
								<td></td>
								<td class="text-danger">THERE ARE NO TAGS IN THE SYSTEM</td>
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

@section('page_scripts')
@endsection