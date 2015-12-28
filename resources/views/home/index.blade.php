@extends('layouts.master')

<div class="video_overlay">
	<div class="close_button">X</div>
	<div id="player"></div>
</div>

@section('content')
<!-- UI - X Starts -->
@foreach($movies as $movie)
<div class="ui-313">
	<div class="container-fluid">
		<!-- Item -->
		<div class="ui-item">
			<!-- Head -->
			<div class="ui-head">
				<!-- Background Image -->
				<img src="{{ $movie->background_image }}" alt="" class="img-responsive bg-img" />
				<!-- Transparent Background -->
				<div class="ui-trans clearfix">
					<!-- Image -->
					<img src="{{ $movie->large_cover_image }}" alt="" class="img-responsive" />
					<!-- Details -->
					<div class="ui-details clearfix">
						<!-- Movie Name -->
						<h2><a href="#" id="movie_title">{{ $movie->title }}</a></h2>
						<!-- Labels -->
						<a href="#" class="label" id="movie_year">{{ $movie->year }}</a>
						<a href="#" class="label">{{ $movie->mpa_rating }}</a>
						<a href="#" class="label">{{ $movie->runtime }}</a>
						@foreach($movie->genres as $genre)
						<a href="#" class="label">{{ $genre }}</a>
						@endforeach
						<!-- Paragraph -->
						<p>{{ $movie->summary }}</p>
						<!-- Heading -->
						<h4><span>IMDB Link</span>:</h4>
						<!-- Director Name -->
						<h5><a class="btn btn-xs btn-warning" style="font-weight: bolder;" href="{{'http://www.imdb.com/title/' . $movie->imdb_code}}"> Imdb Link</a></h5>
						<!-- Heading -->

						<h4 style="margin-top: 10px;"><span>Rating</span>:</h4>
						<!-- Writers -->
						<h5 style="margin-top: 10px;">
							<p class="btn btn-success btn-xs" style="background: green"> {{ $movie->rating }}</p>
						</h5>

						<!-- Heading -->
						<h4><span>Torrents</span>:</h4>
						<!-- Stars -->
						<h5 style="margin-top: 10px;">
							@foreach($movie->torrents as $link)
							<a href="{{ $link->url }}" class="btn btn-danger btn-xs">{{$link->quality}}</a>
							@endforeach
						</h5>

						<!-- Magnet -->
						<h4 style="margin-top: 10px;">
							<span>Magnet</span>:
						</h4>
						<h5 style="margin-top: 10px;">
							@foreach($movie->torrents as $link)
								<a style="font-weight: bolder;" href="magnet:?xt=urn:btih:{{$link->hash}}{{$trackers}}" class="btn btn-danger btn-xs glyphicon glyphicon-magnet">
									{{$link->quality}}
								</a>
							@endforeach
						</h5>

						<!-- youtube-trailer -->
						<h4 style="margin-top: 10px;"><span>Trailer</span>:</h4>
						<h5 style="margin-top: 10px;">
							<a class="btn btn-info btn-xs open_youtube_button">
								Watch Official Trailer
							</a>
						</h5>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach
<!-- UI - X Ends -->
@endsection
