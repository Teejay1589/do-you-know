@extends('layouts.'.$page->layout)

@section('title', $page->title)

@section('page_styles')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <h1>
                <img src="{{ asset('asset/img/user.png') }}" alt="DYK LOGO" style="max-height: 100px;"> 
                Do You Know?
            </h1>
            <p class="text-primary">Tunji is a graduate</p>
            <p class="lead">Coming Soon...</p>
        </div>
    </div>
</div>
@endsection

@section('page_scripts')
@endsection