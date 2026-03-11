@extends('layouts.app')

@section('content')

<div class="container">

<h1 class="mb-4">Pro Dota 2 Matches</h1>

<table class="table table-striped">

<thead>
<tr>
<th>Favourite</th>
<th>League</th>
<th>Team Radiant</th>
<th>Team Dire</th>
<th>Start Time</th>
<th>Status</th>
<th>Result</th>
</tr>
</thead>

<tbody id="matchesTable">

@foreach($matches as $match)

<tr data-start="{{ $match['start_time'] }}">

<td>
<button class="star-btn">☆</button>
</td>

<td>{{ $match['league_name'] ?? 'Unknown' }}</td>

<td>{{ $match['radiant_name'] ?? 'TBD' }}</td>

<td>{{ $match['dire_name'] ?? 'TBD' }}</td>

<td>
{{ date('d M Y H:i', $match['start_time']) }}
</td>

<td>

@if($match['start_time'] <= time())

<span class="badge bg-danger">LIVE</span>

@else

<span class="text-muted">
{{ date('d M H:i', $match['start_time']) }}
</span>

@endif

</td>

<td>

@if(isset($match['radiant_score']))

{{ $match['radiant_name'] ?? 'Radiant' }}
{{ $match['radiant_score'] }}

-

{{ $match['dire_score'] }}
{{ $match['dire_name'] ?? 'Dire' }}

@if($match['radiant_win'])
<span class="badge bg-success">Radiant Win</span>
@else
<span class="badge bg-danger">Dire Win</span>
@endif

@else

<span class="text-muted">Live</span>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</div>


<script>

function updateCountdowns() {

document.querySelectorAll('#matchesTable tr').forEach(row => {

let startTime = row.dataset.start * 1000;
let now = new Date().getTime();
let diff = startTime - now;

let countdownCell = row.querySelector('.countdown');

if(diff <= 0){

let passed = Math.abs(diff);

let hours = Math.floor(passed / (1000 * 60 * 60));
let minutes = Math.floor((passed % (1000 * 60 * 60)) / (1000 * 60));

countdownCell.innerHTML = "Started " + hours + "h " + minutes + "m ago";

return;
}

let hours = Math.floor(diff / (1000 * 60 * 60));
let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
let seconds = Math.floor((diff % (1000 * 60)) / 1000);

countdownCell.innerHTML = hours + "h " + minutes + "m " + seconds + "s";

});

}

setInterval(updateCountdowns, 1000);

</script>

<script>

document.addEventListener("DOMContentLoaded", function(){

const table = document.getElementById("matchesTable");

function sortTable(){

let rows = Array.from(table.querySelectorAll("tr"));

rows.sort((a,b)=>{

let aStar = a.querySelector(".star-btn").textContent === "★";
let bStar = b.querySelector(".star-btn").textContent === "★";

let aTime = parseInt(a.dataset.start);
let bTime = parseInt(b.dataset.start);

if(aStar !== bStar){
return bStar - aStar;
}

return aTime - bTime;

});

rows.forEach(row => table.appendChild(row));

}

document.querySelectorAll(".star-btn").forEach(button=>{

button.addEventListener("click", function(){

this.textContent = this.textContent === "☆" ? "★" : "☆";

sortTable();

});

});

sortTable();

});

</script>

@endsection