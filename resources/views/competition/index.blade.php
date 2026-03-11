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
<th>Countdown</th>
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

<td class="countdown"></td>

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

document.querySelectorAll('.star-btn').forEach(button => {

button.addEventListener('click', function(){

let row = this.closest('tr');

if(this.textContent === "☆"){

this.textContent = "★";
row.parentNode.prepend(row);

}else{

this.textContent = "☆";

}

});

});

</script>

@endsection