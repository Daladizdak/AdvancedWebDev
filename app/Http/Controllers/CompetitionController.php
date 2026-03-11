<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CompetitionController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.opendota.com/api/proMatches');

        $matches = collect($response->json())->take(20);

        return view('competition.index', compact('matches'));
    }
}