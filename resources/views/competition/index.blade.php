@extends('layouts.app')

@section('content')

<div class="container">

<h1 class="mb-4">Pro Dota 2 Matches</h1>

<table class="table table-striped">

<thead>
<tr>
<th>Notify</th>
<th>League</th>
<th>Team 1</th>
<th>Team 2</th>
<th>Start Time</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($matches as $match)

@php
    $start = \Carbon\Carbon::parse($match['begin_at']);
    $now = now();
@endphp

<tr>

<td>
<button class="btn btn-sm btn-info notify-btn"
    data-match-name="{{ $match['name'] ?? 'Match' }}"
    data-start-time="{{ $match['begin_at'] }}">
    🔔
</button>
</td>

<td>{{ $match['league']['name'] ?? 'Unknown' }}</td>

<td>
{{ $match['opponents'][0]['opponent']['name'] ?? 'TBD' }}
</td>

<td>
{{ $match['opponents'][1]['opponent']['name'] ?? 'TBD' }}
</td>

<td>
{{ $start->format('d M Y H:i') }}
</td>

<td>

@if($match['status'] == 'running')
    <span class="badge bg-danger">LIVE</span>

@elseif($match['status'] == 'finished')
    <span class="badge bg-secondary">Finished</span>

@else
    <span class="text-muted">Upcoming</span>
@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<script>
document.querySelectorAll('.notify-btn').forEach(button => {

button.addEventListener('click', function () {

    const matchName = this.dataset.matchName;
    const startTime = new Date(this.dataset.startTime);

    if (Notification.permission !== "granted") {
        Notification.requestPermission();
    }

    this.classList.add("active");
    this.innerText = "🔔 Set";

    const interval = setInterval(() => {

        const now = new Date();

        if (now >= startTime) {

            if (Notification.permission === "granted") {
                new Notification("Match Started!", {
                    body: matchName + " is now LIVE 🔥"
                });
            }

            clearInterval(interval);
        }

    }, 10000);

});

});
</script>

@endsection