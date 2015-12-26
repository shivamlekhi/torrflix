<?php

namespace TorrFlix\Http\Controllers;

use TorrFlix\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $movies = json_decode(file_get_contents('https://yts.ag/api/v2/list_movies.json'))->{'data'};

        // dd($movies->{'movies'}[0]);

        foreach ($movies->{'movies'} as $movie) {
            $words = explode(" ",$movie->summary);
            $summary = implode(" ",array_splice($words,0,50));
            
            $movie->summary = $summary;
        }

        return view('home.index',[
            'movies' => $movies->{'movies'}
        ]);
    }
}
