@extends('layouts.app')

@section('content')

<div class="container">

<h1 class="text-center mb-4">Dota 2 Heroes</h1>

<div class="row">

@foreach($heroes as $hero)

<div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">

<div class="card h-100 text-center shadow-sm">

<img 
src="{{ $hero['image'] }}"
class="card-img-top p-2"
alt="{{ $hero['localized_name'] }}">

<div class="card-body">

<h6 class="card-title">
{{ $hero['localized_name'] }}
</h6>

<span class="badge bg-primary">
{{ strtoupper($hero['primary_attr']) }}
</span>

<span class="badge bg-secondary">
{{ $hero['roles'][0] }}
</span>

</div>

</div>

</div>

@endforeach

</div>

</div>

@endsection