// start video code
var player;
var player_width='650';
var player_height='400';

if(isMobile()){
    player_width='100%';
    player_height=getWindowWidth()*0.50;
    $('#hs-video-screen').css('height', getWindowWidth()*0.50 + 'px');
}else{
    player_width='650';
    player_height='400';
}

function onYouTubeIframeAPIReady(video_id) {
    console.info(video_id);

    var video;
    if(!video_id){
        video=$('.ha-first-video').val();
    }else{
        video=video_id;
    }

    player = new YT.Player('hs-video-screen', {
        width: player_width,
        height: player_height,
        videoId: video,
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
    // event.target.playVideo();
    console.info('ready to play');

    // $('.ha-video-list-wrp__inner').eq(0).addClass('ha-video-link-active');
}

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
var done = false;

function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING && !done) {
        setTimeout(stopVideo, 6000);
        done = true;
    }
}

function stopVideo() {
    player.stopVideo();
}

var btnLinkVideo=$('.hs-video-link');
btnLinkVideo.bind('click', function (e) {
    e.preventDefault();

    var _self=$(this);
    var video_id=_self.attr('data-url-id');
    var video_title=_self.attr('data-title');
    console.info(video_id);

    // 제목 변경
    $('.hs-video-viewer .hs-video-title').text(video_title);

    // 포인터 처리
    // $('.ha-video-list-wrp__inner').removeClass('ha-video-link-active');
    // _self.parent().addClass('ha-video-link-active');

    player.loadVideoById(video_id);
});