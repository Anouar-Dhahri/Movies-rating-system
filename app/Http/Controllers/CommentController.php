<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'destroy']);
    }

    public function store(Request $request, Movie $movie)
    {
        $request->validate(['comment' => 'required']);

        Comment::create([
            'user_id' => Auth::user()->id,
            'movie_id' => $movie->id,
            'content' => $request->comment
            
        ]);
        return back();
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user->id !== Auth::user()->id) {
            abort(403);
        }
        $comment->delete();
        return back();
    }
}
