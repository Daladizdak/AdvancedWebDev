<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HeroController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.opendota.com/api/heroStats');

        $heroes = collect($response->json())->map(function ($hero) {

            $hero['image'] = 'https://cdn.cloudflare.steamstatic.com/apps/dota2/images/heroes/' .
                str_replace('npc_dota_hero_', '', $hero['name']) . '_full.png';

            return $hero;
        });

        return view('heroes.index', compact('heroes'));
    }
}