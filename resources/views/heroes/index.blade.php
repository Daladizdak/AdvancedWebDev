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

<div class="col-md-3 mb-4 hero-card hero-clickable"
     data-id="{{ $hero['id'] }}"
     data-name="{{ $hero['localized_name'] }}"
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

<div class="modal fade" id="heroModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="heroModalName"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center" id="heroModalBody">
        <div class="spinner-border"></div>
      </div>

    </div>
  </div>
</div>



<style>
.hero-clickable {
    cursor: pointer;
}
</style>



<script>


document.addEventListener("DOMContentLoaded", function(){

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

        hero.style.display = (matchSearch && matchFilter) ? "block" : "none";
    });
}

searchInput.addEventListener("input", filterHeroes);

filterButtons.forEach(btn => {
    btn.addEventListener("click", function(){
        currentFilter = this.dataset.attr;
        filterHeroes();
    });
});


const heroModal = new bootstrap.Modal(document.getElementById('heroModal'));

document.querySelectorAll('.hero-clickable').forEach(card => {

    card.addEventListener('click', function(){

        

        let heroId = this.dataset.id;
        let heroName = this.dataset.name;

        document.getElementById('heroModalName').innerText = heroName;
        document.getElementById('heroModalBody').innerHTML =
            '<div class="spinner-border"></div>';

        heroModal.show();

        fetch('https://api.opendota.com/api/heroStats')
            .then(res => res.json())
            .then(data => {

                let hero = data.find(h => h.id == heroId);

                if(!hero){
                    document.getElementById('heroModalBody').innerHTML =
                        "Hero not found";
                    return;
                }
                
                let health = hero.base_health + (hero.base_str * 22);
                let mana = hero.base_mana + (hero.base_int * 12);

                document.getElementById('heroModalBody').innerHTML = `
                    <p><strong>Attack:</strong> ${hero.attack_type}</p>
                    <p><strong>Roles:</strong> ${hero.roles.join(', ')}</p>
                    <p><strong>Health:</strong> ${health}</p>
                    <p><strong>Mana:</strong> ${mana}</p>
                    <p><strong>Armor:</strong> ${hero.base_armor}</p>
                    <p><strong>Speed:</strong> ${hero.move_speed}</p>
                `;
            })
            .catch(() => {
                document.getElementById('heroModalBody').innerHTML =
                    '<p class="text-danger">Error loading stats</p>';
            });

    });

});

});
</script>

@endsection