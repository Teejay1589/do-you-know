@extends('layouts.'.$page->layout)

@section('title', $page->title)

@section('content')
<h4>Dashboard</h4>
<div class="row">
    <div class="col-md-3 col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">My Facts</div>
            <div class="panel-body text-center">
                <h1>{{ count(Auth::user()->facts) }}</h1>
            </div>
        </div>
    </div>
</div>
    
<div class="panel panel-primary">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        You are logged in!
    </div>
</div>
<br><br><br>
@endsection
