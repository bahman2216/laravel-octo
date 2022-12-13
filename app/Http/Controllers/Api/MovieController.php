<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MoviePerformerResource;
use App\Http\Resources\MovieResource;
use App\Http\Resources\MovieTimeSlotResource;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Movie;
use App\Models\Performer;
use App\Models\Theater;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addMovie(Request $request)
    {
        if ( $request->user()->tokenCan('movie-add') ) {
            $input = $request->all();
            $movie = Movie::create($input);

            $genres = $input['genre'];
            $directors = $input['director'];
            $performers = $input['performer'];
            $languages = $input['language'];

            $genres_ids = Genre::whereIn('name', $genres)->get('id');

            $movie->genres()->attach(
                $genres_ids
            );

            $directors_ids = Director::whereIn('name', $directors)->get('id');

            $movie->directors()->attach(
                $directors_ids
            );

            $performers_ids = Performer::whereIn('name', $performers)->get('id');

            $movie->performers()->attach(
                $performers_ids
            );

            $languages_ids = Language::whereIn('name', $languages)->get('id');

            $movie->languages()->attach(
                $languages_ids
            );

            return response()->json([
                    "message" => "Successfully added movie ".$input['title']." with Movie_ID ".$movie->id,
                    "success" => true
            ]);

        } else {
            return response()->json(['error' => 'Forbidden.'], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }

    /**
     * Display a list of the resource by Genre.
     *
     * @return \Illuminate\Http\Response
     */
    public function byGenre(Request $request)
    {
        $genreName = $request->has('genre') ? $request->input('genre') : null;
        if ($genreName !== null) {
            $movies = Movie::withWhereHas('genres', function ($query) use ($genreName) {
                $query->where('name', $genreName);
            })->get();

            return MovieResource::collection($movies);
        }
    }

    /**
     * Display a list of the resource by Time Slot.
     *
     * @return \Illuminate\Http\Response
     */
    public function byTimeSlot(Request $request)
    {
        $theaterName = $request->has('theater_name') ? $request->input('theater_name') : null;

        $timeStart = $request->has('time_start') ? $request->input('time_start') : null;
        $timeEnd = $request->has('time_end') ? $request->input('time_end') : null;

        if ($theaterName !== null && $timeStart !== null && $timeEnd !== null) {
            $theater = Theater::where('name', ($theaterName))->first();

            if ( $theater ) {
                $timeSlot = TimeSlot::with('theater')->where('theater_id', $theater->id)
                    ->where('time_start', '>=', $timeStart)->where('time_end', '<=', $timeEnd)->with('movie')->get();

                return MovieTimeSlotResource::collection($timeSlot);
            } else {
                return response()->json(['success' => false, 'message' => 'Movei not found']);
            }
        }
    }

    /**
     * Display a list of the resource by Specific Time Slot.
     *
     * @return \Illuminate\Http\Response
     */
    public function bySpecificMovieTheater(Request $request)
    {
        $theaterName = $request->has('theater_name') ? $request->input('theater_name') : null;

        $dDate = $request->has('d_date') ? $request->input('d_date') : null;

        if ($theaterName !== null && $dDate !== null) {
            $theater = Theater::where('name', ($theaterName))->first();

            if ( $theater ) {
                $timeSlot = TimeSlot::with('theater')->where('theater_id', $theater->id)
                    ->where('time_start', 'like', $dDate.'%')->where('time_end', 'like', $dDate.'%')->with('movie')->get();

                return MovieTimeSlotResource::collection($timeSlot);
            } else {
                return response()->json(['success' => false, 'message' => 'Movei not found']);
            }
        }
    }

    /**
     * Display a list of the resource by Specific Performer.
     *
     * @return \Illuminate\Http\Response
     */
    public function byPerformer(Request $request)
    {
        $performerName = $request->has('performer_name') ? $request->input('performer_name') : null;

        if ( $performerName ) {
                $movies = Movie::withWhereHas('avgRating')->withWhereHas('performers', function($query) use ($performerName) {
                    $query->where('name', $performerName);
                })->get();

                return MoviePerformerResource::collection($movies);
            } else {
                return response()->json(['success' => false, 'message' => 'Movei not found']);
            }
    }

    /**
     * Display a list of the resource by release date.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNewMovies(Request $request)
    {
        $rDate = $request->has('r_date') ? $request->input('r_date') : null;

        if ( $rDate ) {
                $movies = Movie::with('avgRating')->where('release', '<=', $rDate)->get();

                return MoviePerformerResource::collection($movies);
            } else {
                return response()->json(['success' => false, 'message' => 'No movie where found!']);
            }
    }
}
