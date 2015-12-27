var myPlayer = null;

var containerId = 'player';
var Video = 'abc123';

$(document).ready(function() {
    $(document).on('click', '.close_button', function() {
        $('.video_overlay').fadeOut();

        if(myPlayer != null) { myPlayer.stopVideo(); }
    });

    $(document).on('click', '.open_youtube_button', function() {
        var title = $(this).parent().parent().find('#movie_title').html();
        var year = $(this).parent().parent().find('#movie_year').html();
        

        search(title + ' ' + year + ' Official Trailer');
    });
});

var done = false;
function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING && !done) {
        // setTimeout(stopVideo, 6000);
        done = true;
    }
}


function search(query) {    
    // run get request on API
    $.get(
      "https://www.googleapis.com/youtube/v3/search", {
        part: 'id',
        q: query,
        type: 'video',
        maxResults: 1,
        key: 'AIzaSyCFkrCnkDAgPo7mdc8aY1uWod4FVAE0V8g'
    }, function(data) {

        $.each(data.items, function(i, item) {
            // Video = videoId;
            $('.video_overlay').fadeIn();
            playVideo(containerId, item.id.videoId);
        });
    });
}

function playVideo(container, videoId) {
    if (typeof(YT) == 'undefined' || typeof(YT.Player) == 'undefined') {
        window.onYouTubePlayerAPIReady = function() {
            loadPlayer(container, videoId);
        };
        $.getScript('//www.youtube.com/player_api');
    } else {
        loadPlayer(container, videoId);
    }
}

function loadPlayer(container, videoId) {

    if(myPlayer != null) {
        myPlayer.loadVideoById(videoId);
    } else {
        myPlayer = new YT.Player(container, {
            playerVars: {
                modestbranding: 1,
                rel: 0,
                showinfo: 0,
                autoplay: 1
            },
            height: '100%',
            width: '100%',
            videoId: videoId,
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    }
}
