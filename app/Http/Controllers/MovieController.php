<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'destroy']);
    }

    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'rating_star' => 'required',
            'description' => 'required'
        ]);

        $movie = Movie::create($request->all());

        return redirect()->route('movies.show', $movie->id);
    }

    public function show(Movie $movie)
    {
        $casts = Cast::all();
        return view('movies.show', compact('movie', 'casts'));
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index');
    }

    public function movie_cast_store(Request $request, Movie $movie) {
        $request->validate([
            'cast_movie_name' => 'required',
            'cast_movie_role' => 'required'
        ]);
        $movie->casts()->attach($request->cast_movie_name, ['role' => $request->cast_movie_role]);
        return back();
    }
    public function movie_cast_destroy(Movie $movie, Cast $cast) {
        $movie->casts()->detach($cast->id);
        return back();
    }
}
