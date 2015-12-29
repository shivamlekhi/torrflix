<?php

namespace TorrFlix\Http\Controllers;
use Request;

class HomeController extends Controller
{
    /**
    * Create a new controller instance.
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
        $genres = array(
            ['value' => "all", 'name' => 'All'],
            ['value' => "action", 'name' => 'Action'],
            ['value' => "adventure", 'name' => 'Adventure'],
            ['value' => "animation", 'name' => 'Animation'],
            ['value' => "biography", 'name' => 'Biography'],
            ['value' => "comedy", 'name' => 'Comedy'],
            ['value' => "crime", 'name' => 'Crime'],
            ['value' => "documentary", 'name' => 'Documentary'],
            ['value' => "drama", 'name' => 'Drama'],
            ['value' => "family", 'name' => 'Family'],
            ['value' => "fantasy", 'name' => 'Fantasy'],
            ['value' => "film-noir", 'name' => 'Film Noir'],
            ['value' => "game-show", 'name' => 'Game'],
            ['value' => "history", 'name' => 'History'],
            ['value' => "horror", 'name' => 'Horror'],
            ['value' => "music", 'name' => 'Music'],
            ['value' => "musical", 'name' => 'Musical'],
            ['value' => "mystery", 'name' => 'Mystery'],
            ['value' => "news", 'name' => 'News'],
            ['value' => "reality", 'name' => 'Reality'],
            ['value' => "romance", 'name' => 'Romance'],
            ['value' => "sci-fi", 'name' => 'Sci'],
            ['value' => "sport", 'name' => 'Sport'],
            ['value' => "talk-show", 'name' => 'Talk'],
            ['value' => "thriller", 'name' => 'Thriller'],
            ['value' => "war", 'name' => 'War'],
            ['value' => "western", 'name' => 'Western']         
        );

        // Trackers for Yify`
        $trackers = '&tr=udp://open.demonii.com:1337/announce';
        $trackers .= '&tr=udp://tracker.openbittorrent.com:80';
        $trackers .= '&tr=udp://tracker.coppersurfer.tk:6969';
        $trackers .= '&tr=udp://glotorrents.pw:6969/announce';
        $trackers .= '&tr=udp://tracker.opentrackr.org:1337/announce';
        $trackers .= '&tr=udp://torrent.gresille.org:80/announce';
        $trackers .= '&tr=udp://p4p.arenabg.com:1337';
        $trackers .= '&tr=udp://tracker.leechers-paradise.org:6969';

        $search = Request::has('q') ? '&query_term=' . Request::get('q') : '';
        $quality = Request::has('quality') ? '&quality=' . Request::get('quality') : '';
        $genre = Request::has('genre') ? '&genre=' . Request::get('genre') : '';
        $rating = Request::has('rating') ? '&minimum_rating=' . Request::get('rating') : '';
        $order_by = Request::has('order_by') ? '&sort_by=' . Request::get('order_by') : '';


        $url = "https://yts.ag/api/v2/list_movies.json?order_by=asc&limit=50" . $search
        . $quality
        . $genre
        . $rating
        . $order_by;

        if(Request::get('page')) {
            $movies = json_decode(file_get_contents($url . '&page=' . Request::get('page')))->{'data'};
        } else {
            $movies = json_decode(file_get_contents($url))->{'data'};
        }

        $total_pages = round($movies->{'movie_count'} / $movies->{'limit'});
        $current_page = Request::has('page') ? Request::get('page') : 1;
        //   dd($movies->{'movies'}[0]);
        //   dd($trackers);

        if($movies->{'movie_count'} != 0) {

            foreach ($movies->{'movies'} as $movie) {
                $words = explode(' ', $movie->summary);
                $summary = implode(' ', array_splice($words, 0, 50));

                $movie->summary = $summary;
            }
        }

        return view('home.index', [
            'movies' => isset($movies->{'movies'}) ? $movies->{'movies'} : [],
            'trackers' => $trackers,
            'total_pages' => $total_pages,
            'current_page' => $current_page,
            'genres' => $genres
            ]);
    }
}
