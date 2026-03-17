<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CompetitionController extends Controller
{
    public function index()
    {
        $apiKey = env('PANDASCORE_API_KEY');

       
        $upcoming = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey
        ])->get('https://api.pandascore.co/dota2/matches/upcoming')->json();
        
        $live = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey
        ])->get('https://api.pandascore.co/dota2/matches/running')->json();
        
        $matches = collect($live)
            ->merge($upcoming)
            ->sortBy('begin_at')
            ->take(20)
            ->values();

        return view('competition.index', compact('matches'));
    }
}