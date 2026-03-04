@extends('layouts.app')

@section('content')
<h1>{{ $hero->name }}</h1>

<p>Attribute: {{ $hero->primary_attribute }}</p>
<p>Roles: {{ $hero->roles }}</p>

@if($hero->image_url)
    <img src="{{ $hero->image_url }}" width="200">
@endif

<br><br>
<a href="{{ route('heroes.index') }}">Back</a>
@endsection