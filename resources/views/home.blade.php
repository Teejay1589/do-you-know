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
            <div class="panel-footer">
                <div class="btn-group">
                    <a href="{{ url('fact/create') }}" class="btn btn-link">Create</a>
                    <a href="{{ url('fact') }}" class="btn btn-link">View</a>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->role_id == 3)
        <div class="col-md-3 col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Facts</div>
                <div class="panel-body text-center">
                    <h1>{{ count($facts) }}</h1>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('manage.users') }}" class="btn btn-link btn-block">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Tags</div>
                <div class="panel-body text-center">
                    <h1>{{ count($tags) }}</h1>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('manage.facts') }}" class="btn btn-link btn-block">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Users</div>
                <div class="panel-body text-center">
                    <h1>{{ count($users) }}</h1>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('manage.tags') }}" class="btn btn-link btn-block">Manage</a>
                </div>
            </div>
        </div>
    @endif
</div>
    
<div class="panel panel-primary">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        You are logged in!
    </div>
</div>
<br><br><br>
@endsection
