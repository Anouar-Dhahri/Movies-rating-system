<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'destroy']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cast_name' => 'required',
            'cast_image' => 'required'
        ]);

        Cast::create([
            'name' => $request->cast_name,
            'image' => $request->cast_image,
        ]);
        return back();
    }

    public function show(Cast $cast)
    {
        return view('casts.show', compact('cast'));
    }

    public function destroy(Cast $cast)
    {
        $cast->delete();
        return redirect()->route('movies.index');
    }
}
