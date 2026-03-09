<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkshopHero;

class WorkshopController extends Controller
{
    public function index()
    {
        $heroes = WorkshopHero::latest()->get();
        return view('workshop.index', compact('heroes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hero_name' => 'required|min:3|max:50',
            'role' => 'required',
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('heroes', 'public');
            $validated['image'] = $path;
        }

        WorkshopHero::create($validated);

        return redirect()->route('workshop.index')
            ->with('success', 'Hero submitted successfully!');
    }

    public function update(Request $request, $id)
    {
        $hero = WorkshopHero::findOrFail($id);

        $validated = $request->validate([
            'hero_name' => 'required|min:3|max:50',
            'role' => 'required',
            'description' => 'required|min:10'
        ]);

        $hero->update($validated);

        return redirect()->route('workshop.index')
            ->with('success', 'Hero updated successfully!');
    }

    public function destroy($id)
    {
        $hero = WorkshopHero::findOrFail($id);
        $hero->delete();

        return redirect()->route('workshop.index')
            ->with('success', 'Hero deleted successfully!');
    }
}