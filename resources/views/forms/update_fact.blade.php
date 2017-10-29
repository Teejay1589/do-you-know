<form action="{{ route('update_fact', ['id' => $active_object->id]) }}" method="POST">
	<div class="form-group">
		{{ csrf_field() }}
	</div>
	
	<div class="row">
		<div class="form-group col-md-9">
			<label>Fact: <span class="text-danger">*</span></label>
			<textarea class="form-control" name="fact" rows="5" placeholder="Enter Fact" required>{{ old('fact', $active_object->fact) }}</textarea>
		</div>

		<div class="form-group col-md-3 {{ $errors->has('fact_image') ? ' has-error' : '' }}"> 
            <div id="preview">
                <label for="fact_image">Fact Image: </label>
                @if ( session()->get('fact_image_temp') != null )
                <img class="thumbnail img-responsive center-block change_fact_image" src="{{ asset(session()->get('fact_image_temp')) }}" alt="Image" style="min-height: 120px;">
                @else
                <img class="thumbnail img-responsive center-block change_fact_image" src="{{ asset($active_object->fact_image) }}" alt="Fact Image" style="min-height: 120px;">
                @endif
            </div>
            <div class="center-block text-center" style="position:abolute; margin: -50px auto 20px auto; z-index: 9;">
                <a class="change_fact_image btn btn-xs btn-primary btn-cta">Add</a>
            </div>
        </div>
	</div>

	<div class="row">
		<div class="form-group col-md-9">
			<label for="tags">Select Tags: </label>
			<select id="tags" name="tags[]" class="form-control" multiple>
				@php
					$active_object->tags = json_decode($active_object->tags);
				@endphp
	            @if ( old('tags', $active_object->tags) != null )
      				@foreach (old('tags', $active_object->tags) as $value)
              			<option value="{{ $value }}" selected>{{ $value }}</option>
      				@endforeach
  				@endif
	          	@foreach ($tags as $element)
          			@if ( old('tags', $active_object->tags) != null )
          				@if ( in_array($element->tag, old('tags', $active_object->tags))  )
	              		@else
	              			<option value="{{ $element->tag }}">{{ $element->tag }}</option>
	              		@endif
          			@else
		          		<option value="{{ $element->tag }}">{{ $element->tag }}</option>
          			@endif
	          	@endforeach
            </select>
          	<small class="help-block">Maximum of 10 tags, You can also type in ur own tags to add them</small>
        </div>

		@if (Auth::user()->role_id == 3)
			<div class="form-group col-md-3">
				<label for="tags">Approve Fact: </label>
	            <div class="checkbox">
	                <label>
	                	<input type="checkbox" name="is_approved" {{ old('is_approved', $active_object->is_approved) ? 'checked' : '' }}> Is Approved
	                </label>
	             	<span class="help-block">Check to approve FACT</span>
	            </div>
		    </div>
		@endif
	</div>

	<div class="text-right">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</form>