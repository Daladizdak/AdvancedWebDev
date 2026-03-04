@extends('layouts.app')

@section('content')
<h1>Add Hero</h1>

<form method="POST" action="{{ route('heroes.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Name"><br><br>
    <input type="text" name="primary_attribute" placeholder="Primary Attribute"><br><br>
    <input type="text" name="roles" placeholder="Roles"><br><br>
    <input type="text" name="image_url" placeholder="Image URL"><br><br>
    <button type="submit">Save</button>
</form>
@endsection