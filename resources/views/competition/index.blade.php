@extends('layouts.app')

@section('content')

<div class="container">

<h1 class="mb-4">Pro Dota 2 Matches</h1>

<div class="row">

@foreach($matches as $match)

@php
    $team1 = $match['opponents'][0]['opponent']['name'] ?? 'TBD';
    $team2 = $match['opponents'][1]['opponent']['name'] ?? 'TBD';
    $league = $match['league']['name'] ?? 'Unknown';
    $start = \Carbon\Carbon::parse($match['begin_at']);
@endphp

<div class="col-md-4 mb-4">

<div class="card shadow-sm h-100">

<div class="card-body text-center">

<h6 class="text-muted">{{ $league }}</h6>

<h5>{{ $team1 }} vs {{ $team2 }}</h5>

<p class="text-muted">
{{ $start->format('d M Y H:i') }}
</p>

@if($match['status'] == 'running')
<span class="badge bg-danger">LIVE</span>
@else
<span class="badge bg-secondary">Upcoming</span>
@endif

<br><br>

<button class="notify-btn"
    data-id="{{ $match['id'] }}"
    data-name="{{ $team1 }} vs {{ $team2 }}"
    data-time="{{ $match['begin_at'] }}">
    🔔 Notify
</button>

</div>

</div>

</div>

@endforeach

</div>

</div>

<style>
.notify-btn {
    border: 1px solid #0dcaf0;
    background: transparent;
    color: #0dcaf0;
    padding: 5px 10px;
    border-radius: 20px;
}

.notify-btn.active {
    background: #0dcaf0;
    color: white;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function(){

    let saved = JSON.parse(localStorage.getItem('matches')) || [];

    document.querySelectorAll(".notify-btn").forEach(btn => {

        let id = btn.dataset.id;

    
        if(saved.includes(id)){
            btn.classList.add("active");
            btn.innerText = "🔔 Set";
        }

        btn.addEventListener("click", function(){

            let name = this.dataset.name;
            let time = new Date(this.dataset.time);

            let saved = JSON.parse(localStorage.getItem('matches')) || [];

           
            if(saved.includes(id)){
                saved = saved.filter(x => x != id);
                localStorage.setItem('matches', JSON.stringify(saved));

                this.classList.remove("active");
                this.innerText = "🔔 Notify";
                return;
            }

            
            if(Notification.permission !== "granted"){
                Notification.requestPermission();
            }

            saved.push(id);
            localStorage.setItem('matches', JSON.stringify(saved));

            this.classList.add("active");
            this.innerText = "🔔 Set";

            setInterval(() => {
                if(new Date() >= time){
                    new Notification("Match Started!", {
                        body: name + " is LIVE"
                    });
                }
            }, 10000);

        });

    });

});
</script>

@endsection