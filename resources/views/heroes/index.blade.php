@extends('layouts.app')

@section('content')
<h1>Heroes</h1>

<a href="{{ route('heroes.create') }}">Add Hero</a>

@foreach($heroes as $hero)
    <div class="card" style="margin-bottom:10px;">
        <h3>{{ $hero->name }}</h3>
        <p>Attribute: {{ $hero->primary_attribute }}</p>
        <p>Roles: {{ $hero->roles }}</p>
        <a href="{{ route('heroes.show', $hero->id) }}">View</a>
    </div>
@endforeach
@endsection