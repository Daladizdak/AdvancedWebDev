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
<button class="notify-btn"
    data-match-id="{{ $match['id'] }}"
    data-match-name="{{ $match['name'] ?? 'Match' }}"
    data-start-time="{{ $match['begin_at'] }}">
    🔔 Notify
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
document.addEventListener("DOMContentLoaded", () => {

let saved = JSON.parse(localStorage.getItem('notifiedMatches')) || [];

document.querySelectorAll('.notify-btn').forEach(button => {

    const matchId = button.dataset.matchId;


    if (saved.includes(matchId)) {
        button.classList.add("active");
        button.innerText = "🔔 Set";
    }

    button.addEventListener('click', function () {

        let matchName = this.dataset.matchName;
        let startTime = new Date(this.dataset.startTime);

        let saved = JSON.parse(localStorage.getItem('notifiedMatches')) || [];


        if (saved.includes(matchId)) {

            saved = saved.filter(id => id != matchId);
            localStorage.setItem('notifiedMatches', JSON.stringify(saved));

            this.classList.remove("active");
            this.innerText = "🔔 Notify";

            return;
        }


        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        }

        saved.push(matchId);
        localStorage.setItem('notifiedMatches', JSON.stringify(saved));

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

});
</script>

@endsection