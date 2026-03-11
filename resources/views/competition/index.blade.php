@extends('layouts.app')

@section('content')

<div class="container">

<h1 class="mb-4">Pro Dota 2 Matches</h1>

<table class="table table-striped">

<thead>
<tr>
<th>League</th>
<th>Team Radiant</th>
<th>Team Dire</th>
<th>Start Time</th>
</tr>
</thead>

<tbody>

@foreach($matches as $match)

<tr>

<td>{{ $match['league_name'] ?? 'Unknown' }}</td>

<td>{{ $match['radiant_name'] ?? 'TBD' }}</td>

<td>{{ $match['dire_name'] ?? 'TBD' }}</td>

<td>
{{ date('d M Y H:i', $match['start_time']) }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection