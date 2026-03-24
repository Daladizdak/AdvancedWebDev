@extends('layouts.app')

@section('content')

<div class="container">

<h1 class="mb-4">Dota 2 Heroes</h1>


<input type="text" id="searchInput" class="form-control mb-3" placeholder="Search hero...">


<div class="mb-3">
    <button class="btn btn-sm btn-outline-primary filter-btn" data-attr="all">All</button>
    <button class="btn btn-sm btn-outline-primary filter-btn" data-attr="str">Strength</button>
    <button class="btn btn-sm btn-outline-primary filter-btn" data-attr="agi">Agility</button>
    <button class="btn btn-sm btn-outline-primary filter-btn" data-attr="int">Intelligence</button>
</div>

<div class="row" id="heroContainer">

@foreach($heroes as $hero)

<div class="col-md-3 mb-4 hero-card"
     data-name="{{ strtolower($hero['localized_name'] ?? '') }}"
     data-attr="{{ $hero['primary_attr'] ?? '' }}">

    <div class="card text-center h-100 shadow-sm">

        <img src="{{ $hero['image'] }}"
             class="card-img-top p-2"
             alt="{{ $hero['localized_name'] ?? 'Hero' }}">

        <div class="card-body">

            <h6>{{ $hero['localized_name'] ?? 'Unknown' }}</h6>

            <span class="badge bg-primary">
                {{ strtoupper($hero['primary_attr'] ?? 'N/A') }}
            </span>

            <span class="badge bg-secondary">
                {{ $hero['roles'][0] ?? 'N/A' }}
            </span>

        </div>

    </div>

</div>

@endforeach

</div>

</div>

<script>


const searchInput = document.getElementById("searchInput");
const filterButtons = document.querySelectorAll(".filter-btn");
const heroes = document.querySelectorAll(".hero-card");

let currentFilter = "all";

function filterHeroes(){

    let search = searchInput.value.toLowerCase();

    heroes.forEach(hero => {

        let name = hero.dataset.name;
        let attr = hero.dataset.attr;

        let matchSearch = name.includes(search);
        let matchFilter = (currentFilter === "all" || attr === currentFilter);

        if(matchSearch && matchFilter){
            hero.style.display = "block";
        } else {
            hero.style.display = "none";
        }

    });
}


searchInput.addEventListener("input", filterHeroes);


filterButtons.forEach(btn => {
    btn.addEventListener("click", function(){

        currentFilter = this.dataset.attr;

        filterHeroes();
    });
});

</script>

@endsection