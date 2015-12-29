@extends('layouts.master')

<div class="video_overlay">
	<div class="close_button">X</div>
	<div id="player"></div>
</div>

@section('content')
<div class="col-sm-2 col-xs-2 sidebar">
	<div class="logo">
		<strong>TORR</strong><span style="color:#fff">flix</span>
	</div>
	<form method="GET" action="{{ url('/home') }}">
		<input class="form-control" value="{{ Request::get('q') }}"  placeholder='Search' name='q'></input>

		<div id="main-search-fields">
			<div class="selects-container">
				<p>Quality:</p>
				<select class='form-control' name="quality">
					@foreach(["all", "720p", "1080p", "3D"] as $quality)
					@if(Request::get('quality') == $quality)
					<option value="{{ $quality }}" selected="selected">{{$quality}}</option>
					@else
					<option value="{{ $quality }}">{{$quality}}</option>					
					@endif
					@endforeach
				</select>
			</div>
			<div class="selects-container">
				<p>Genre:</p>
				<select class='form-control' name="genre" selected="{{ Request::get('genre') }}">
					@foreach($genres as $genre)
					@if(Request::get('genre') == $genre['value'])
					<option value="{{ $genre['value'] }}" selected="selected">{{ $genre['name'] }}</option>
					@else
					<option value="{{ $genre['value'] }}">{{ $genre['name'] }}</option>
					@endif
					@endforeach
				</select>
			</div>
			<div class="selects-container">
				<p>Rating:</p>
				<select class='form-control' name="rating">
					@foreach([0,1,2,3,4,5,6,7,8,9] as $rating)
					@if(Request::get('rating') == $rating)
					<option value="{{ $rating }}" selected="selected">{{$rating}}+</option>
					@else
					<option value="{{ $rating }}">{{$rating}}+</option>					
					@endif
					@endforeach
				</select>
			</div>
			<div class="selects-container selects-container-last">
				<p>Order By:</p>
				<select class='form-control' name="order_by">
					<option value="date_added">Date Added</option>
					<option value="seeds">Seeds</option>
					<option value="peers">Peers</option>
					<option value="year">Year</option>
					<option value="rating">Rating</option>
					<option value="like_count">Likes</option>
					<option value="download_count">Downloads</option>
				</select>
			</div>
		</div>
		<input type="submit" class="btn btn-primary col-md-12" style="margin-top: 10px;">
	</form>
</div>
<div class="col-md-2"></div>
<div class="col-md-10" style="padding: 20px 20px 0px 20px">
	@if(count($movies) == 0) 
	<div class="alert alert-danger">
		<strong>Oops</strong> No Movies Found
	</div>
	@else
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
								<a style="font-weight: bolder;" href="magnet:?xt=urn:btih:{{$link->hash . $trackers}}" class="btn btn-danger btn-xs glyphicon glyphicon-magnet">
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
	@endif
	<div class="row">
		<ul class="pagination" id="movie_pagination">
		@if($current_page == 1)
		<li class="disabled" aria-label="Previous"><a>&laquo;</a></li>
		@else
		<li><a href="{{ url('/home?page=' . ($current_page - 1)) }}" aria-label="Previous">&laquo;</a></li>
		@endif
		@for($i = 1; $i <= $total_pages; $i++)
		@if($i == $current_page)
		<li class='active'><a href="{{ url('/home?page=' . $i) }}">{{ $i }}</a></li>
		@else
		<li><a href="{{ url('/home?page=' . $i) }}">{{ $i }}</a></li>
		@endif
		@endfor
		<li aria-label="Next"><a href="{{ url('/home?page=' . ($current_page + 1)) }}" id="last_page">&raquo;</a></li>
	</ul>
	</div>
</div>
<!-- UI - X Ends -->
@endsection
