<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CompetitionController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.opendota.com/api/proMatches');
    
        $tier1 = [
            'The International',
            'DreamLeague',
            'ESL',
            'PGL',
            'Riyadh',
            'Major',
            'BetBoom',
            'BLAST'
        ];
    
        $now = time();
    
        $matches = collect($response->json())
            ->filter(function ($match) use ($tier1, $now) {
    
                if(empty($match['league_name'])) return false;
    
               
                $tierCheck = false;
                foreach($tier1 as $league){
                    if(stripos($match['league_name'], $league) !== false){
                        $tierCheck = true;
                        break;
                    }
                }
    
                if(!$tierCheck) return false;
    
                
                return $match['start_time'] >= ($now - 86400);
            })
            ->sortBy('start_time')
            ->take(20)
            ->values();
    
        return view('competition.index', compact('matches'));
    }
}