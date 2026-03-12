@extends('layouts.app')

@section('content')

<div class="container">

<h1 class="mb-4">Hero Workshop</h1>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createHeroModal">
Submit New Hero
</button>

<div class="row">

@foreach($heroes as $hero)

<div class="col-md-4 mb-4">

<div class="card shadow-sm p-3 h-100">

@if($hero->image)
<img src="{{ asset('storage/'.$hero->image) }}" class="img-fluid mb-2">
@endif

<h5>{{ $hero->hero_name }}</h5>

<span class="badge bg-secondary mb-2">
{{ $hero->role }}
</span>

<p>{{ $hero->description }}</p>

<div class="d-flex justify-content-between mt-auto">

<button class="btn btn-sm btn-warning"
data-bs-toggle="modal"
data-bs-target="#editHero{{ $hero->id }}">
Edit
</button>

<form method="POST" action="{{ route('workshop.destroy', $hero->id) }}">
@csrf
@method('DELETE')

<button class="btn btn-sm btn-danger">
Delete
</button>
</form>

</div>

</div>

</div>



<div class="modal fade" id="editHero{{ $hero->id }}" tabindex="-1">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST" action="{{ route('workshop.update', $hero->id) }}" enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="modal-header">
<h5 class="modal-title">Edit Hero</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

@if ($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div class="mb-3">
<label class="form-label">Hero Name</label>
<input type="text" name="hero_name" class="form-control"
value="{{ $hero->hero_name }}" required>
</div>

<div class="mb-3">
<label class="form-label">Role</label>
<select name="role" class="form-control">

<option {{ $hero->role == 'Carry' ? 'selected' : '' }}>Carry</option>
<option {{ $hero->role == 'Support' ? 'selected' : '' }}>Support</option>
<option {{ $hero->role == 'Nuker' ? 'selected' : '' }}>Nuker</option>
<option {{ $hero->role == 'Initiator' ? 'selected' : '' }}>Initiator</option>
<option {{ $hero->role == 'Disabler' ? 'selected' : '' }}>Disabler</option>

</select>
</div>

<div class="mb-3">
<label class="form-label">Description (min 10 characters)</label>
<textarea name="description" class="form-control" rows="4" required>{{ $hero->description }}</textarea>
</div>

</div>

<div class="modal-footer">
<button class="btn btn-primary">Update Hero</button>
</div>

</form>

</div>

</div>

</div>

@endforeach

</div>

</div>




<div class="modal fade" id="createHeroModal" tabindex="-1">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST" action="{{ route('workshop.store') }}" enctype="multipart/form-data">

@csrf

<div class="modal-header">
<h5 class="modal-title">Submit Hero Idea</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

@if ($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div class="mb-3">
<label class="form-label">Hero Image</label>
<input type="file" name="image" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Hero Name</label>
<input type="text" name="hero_name" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Role</label>
<select name="role" class="form-control">
<option>Carry</option>
<option>Support</option>
<option>Nuker</option>
<option>Initiator</option>
<option>Disabler</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Description (min 10 characters)</label>
<textarea name="description" class="form-control" rows="4" required></textarea>
</div>

</div>

<div class="modal-footer">
<button class="btn btn-primary">Submit Hero</button>
</div>

</form>

</div>

</div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

@if ($errors->any())
var createHeroModal = new bootstrap.Modal(document.getElementById('createHeroModal'));
createHeroModal.show();
@endif

});

</script>

@endsection