@extends('layouts.app')


@section('content')
    <h1>All Movies
        @auth
        <a href="{{ route('movies.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
        @endauth
    </h1>
    @unless (count($movies))
        <p>No movies</p>
    @endunless

    <div class="row">
        @if (count($movies))
            @foreach ($movies as $movie)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ $movie->image }}" class="card-image-top">
                    <div class="card-body">
                        <h3><a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a></h3>
                        <div class="text-danger">
                            @for ($i = 1; $i <= $movie->rating_star; $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <p>{{ Str::limit($movie->description, 100) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

@endsection
