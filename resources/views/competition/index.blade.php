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

@php
$start = $match['start_time'];
$duration = $match['duration'] ?? 0;
$end = $start + $duration;
$now = time();
@endphp

<tr data-start="{{ $match['start_time'] }}">

<td>
<button class="star-btn" style="border:none;background:none;font-size:18px;cursor:pointer;">
☆
</button>
</td>

<td>{{ $match['league_name'] ?? 'Unknown' }}</td>

<td>{{ $match['radiant_name'] ?? 'TBD' }}</td>

<td>{{ $match['dire_name'] ?? 'TBD' }}</td>

<td>
{{ date('d M Y H:i', $match['start_time']) }}
</td>

<td>

@if($now < $start)

<span class="text-muted">
Upcoming
</span>

@elseif($now >= $start && $now <= $end)

<span class="badge bg-danger">LIVE</span>

@else

<span class="badge bg-secondary">Finished</span>

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