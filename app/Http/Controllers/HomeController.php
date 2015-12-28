<?php

namespace TorrFlix\Http\Controllers;

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
        // Trackers for Yify`
        $trackers = '&tr=udp://open.demonii.com:1337/announce';
        $trackers .= '&tr=udp://tracker.openbittorrent.com:80';
        $trackers .= '&tr=udp://tracker.coppersurfer.tk:6969';
        $trackers .= '&tr=udp://glotorrents.pw:6969/announce';
        $trackers .= '&tr=udp://tracker.opentrackr.org:1337/announce';
        $trackers .= '&tr=udp://torrent.gresille.org:80/announce';
        $trackers .= '&tr=udp://p4p.arenabg.com:1337';
        $trackers .= '&tr=udp://tracker.leechers-paradise.org:6969';

        $movies = json_decode(file_get_contents('https://yts.ag/api/v2/list_movies.json'))->{'data'};

      //   dd($movies->{'movies'}[0]);
      //   dd($trackers);

        foreach ($movies->{'movies'} as $movie) {
            $words = explode(' ', $movie->summary);
            $summary = implode(' ', array_splice($words, 0, 50));

            $movie->summary = $summary;
        }

        return view('home.index', [
            'movies' => $movies->{'movies'},
            'trackers' => $trackers,
        ]);
    }
}
