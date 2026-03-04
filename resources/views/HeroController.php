<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();
        return view('heroes.index', compact('heroes'));
    }

    public function create()
    {
        return view('heroes.create');
    }

    public function store(Request $request)
    {
        Hero::create($request->except('_token'));
        return redirect('/heroes');
    }

    public function show(Hero $hero)
    {
        return view('heroes.show', compact('hero'));
    }
}