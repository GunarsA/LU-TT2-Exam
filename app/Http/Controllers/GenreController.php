<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();

        return view('genre', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('modify')) {
            abort(403);
        }

        return view('genre_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('modify')) {
            abort(403);
        }

        $genre = new Genre();
        $genre->genre = $request->genre;
        $genre->save();

        Log::info('Genre [' . $genre->genre . ' (' . $genre->id . ')] created by user [' . Auth::user()->name . ' (' . Auth::user()->id . ')]');

        return redirect('genre');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genre = Genre::findOrFail($id);
        if (!$genre) {
            abort(404);
        }

        return view('genre_show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Gate::allows('modify')) {
            abort(403);
        }

        $genre = Genre::findOrFail($id);
        if (!$genre) {
            abort(404);
        }

        return view('genre_edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('modify')) {
            abort(403);
        }

        $genre = Genre::findOrFail($id);
        $genre->genre = $request->genre;
        $genre->save();

        Log::info('Genre [' . $genre->genre . ' (' . $genre->id . ')] updated by user [' . Auth::user()->name . ' (' . Auth::user()->id . ')]');

        return redirect('genre');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::allows('modify')) {
            abort(403);
        }

        $genre = Genre::findOrFail($id);
        $genre->delete();

        Log::info('Genre [' . $genre->genre . ' (' . $genre->id . ')] deleted by user [' . Auth::user()->name . ' (' . Auth::user()->id . ')]');

        return redirect('genre');
    }
}
