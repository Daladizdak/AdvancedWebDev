@extends('layouts.app')

@section('content')

<div class="container text-center">

    <h1 class="mb-3">Welcome to Dota 2 Hub</h1>
    <p class="mb-5 text-muted">
        Explore heroes, track live matches, and create your own hero ideas.
    </p>

    <div class="row">

        
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm p-4 h-100">
                <h4>Heroes</h4>
                <p>Browse all Dota 2 heroes and view their stats.</p>
                <a href="{{ url('/heroes') }}" class="btn btn-primary">View Heroes</a>
            </div>
        </div>


        <div class="col-md-4 mb-4">
            <div class="card shadow-sm p-4 h-100">
                <h4>Workshop</h4>
                <p>Create, edit, and share your own hero ideas.</p>
                <a href="{{ url('/workshop') }}" class="btn btn-success">Go to Workshop</a>
            </div>
        </div>

        
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm p-4 h-100">
                <h4>Competition</h4>
                <p>View live and upcoming Dota 2 matches.</p>
                <a href="{{ url('/competition') }}" class="btn btn-warning">View Matches</a>
            </div>
        </div>

    </div>

</div>

@endsection