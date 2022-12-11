<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\MovieRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class MovieRatingController extends Controller
{
    public function giveMovieRating( Request $request ) {
        $username = Auth::user()->email;
        $uid = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'movie_title' => 'required|max:255',
            'rating' => 'required|integer|between:1,10',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Validation Error. ', $validator->errors()], 400);
        }

        $input = $request->all();

        //retrive movie title
        $movie = Movie::where('title', $input['movie_title'])->first();
        if ( !$movie ) {
            return response()->json(['error' => 'Movie not found!.'], 404);
        }

        //check if user already rated this movie
        $MovieRating = MovieRating::where('user_id', $uid)->where('movie_id', $movie['id'])->first();

        if( $MovieRating ) {
            return response()->json(['error' => 'You have already rated this movie.'], 200);
        }

        $input['user_id'] = $uid;
        $input['movie_id'] = $movie['id'];
        $input['rating'] = $input['rating'];
        $input['r_description'] = $input['r_description'];
        MovieRating::create($input);

        return response()->json([
            'message' => 'Successfully added review for the '.$input['movie_title'].' by user: '. $username,
            'success'=> true
        ]);

    }
}
