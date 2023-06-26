<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Character;
use App\Models\User;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Character::all();

        return view('character', compact('characters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);

        return view('character_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);

        $character = new Character();
        $character->name = $request->name;
        $character->save();

        return redirect()->route('character.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $character = Character::find($id);

        return view('character_show', compact('character'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);

        $character = Character::find($id);

        return view('character_edit', compact('character'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);

        $character = Character::find($id);
        $character->name = $request->name;
        $character->save();

        return redirect()->route('character.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);

        $character = Character::find($id)->delete();

        return redirect()->route('character.index');
    }
}
