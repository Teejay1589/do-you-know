@extends("layouts.$page->layout")

@section('title', $page->title)

@section('page_styles')
@if ( isset($page->action) && $page->action != "")
	{{-- Select2 Plugin CSS --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/plugin/select2-4.0.3/dist/css/select2.min.css') }}">
@endif
@endsection

@section('content')
<h4>{{ $page->title }}</h4>
@if ( isset($page->action) && $page->action == "create")
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
		    <div class="panel-heading">Create Fact Form</div>
		    <div class="panel-body">
				@include('forms.create_fact')
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
				@include('forms.update_fact')
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
								<th style="width: 10px;">#</th>
								<th>Fact</th>
								<th>Fact Image</th>
								<th>Fact Tags</th>
								<th>Is Approved</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse (Auth::user()->facts as $obj)
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

@section('page_scripts')
<!-- AJAX Pic Upload - fact_image -->
<form id="fact_image" name="fact_image" method="POST" enctype="multipart/form-data" class="center-block text-center" style="opacity: 0; position:absolute; margin-top:-50px; z-index: -1;">
    {{ csrf_field() }}
    <input type="file" name="fact_image_temp" class="form-control input-sm" accept="image/gif, image/jpeg, image/png" onchange="$('#fact_image').submit(); this.value='';" form="fact_image" hidden>
</form>
<script type='text/javascript'>
    $('.change_fact_image').click(function(e) {
        e.preventDefault();
        $('input[name="fact_image_temp"]').click();
    });

    $("#fact_image").on('submit',(function(e) {
      e.preventDefault();
      $.ajax({
        url: "{{ url('/upload-fact_image') }}",
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
             $('img.change_fact_image').attr('src', data);
             $('#fact_image')[0].reset();
            }
          }         
        });
     }));
</script>
<!-- /AJAX Pic Upload -->

@if ( isset($page->action) && $page->action != "")
	{{-- Select2 Plugin JS --}}
	<script src="{{ asset('asset/plugin/select2-4.0.3/dist/js/select2.min.js') }}"></script>
	<script type="text/javascript">
	    $('#tags').select2({
	        tags: true,
	        placeholder: "Select fact tags",
	        allowClear: true,
	        maximumSelectionLength: 10
	    });
	</script>
@endif
@endsection