<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ $title ?? 'AdvancedWebDev - Dota 2 Hub' }}</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:#f4f4f4;
}

.hero-card img{
width:100%;
height:auto;
}

.star-btn{
font-size:15px;
background:none;
border:none;
cursor:pointer;
}
</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">

<a class="navbar-brand" href="{{ url('/') }}">
Dota 2 Hub
</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarNav">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="{{ url('/') }}">Home</a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{ url('/heroes') }}">Heroes</a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{ url('/workshop') }}">Workshop</a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{ url('/competition') }}">Competition</a>
</li>


</ul>

</div>
</div>
</nav>

<div class="container mt-4">

@yield('content')

</div>

<footer class="text-center mt-5 mb-4 text-muted">
<small>© {{ date('Y') }} Dota 2 Hub - Advanced Web Dev</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>