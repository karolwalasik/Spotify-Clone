<?php
    $songQuery = mysqli_query($con, "SELECT id FROM Songs ORDER BY RAND() LIMIT 10");
    $resultArray=array();
    while($row=mysqli_fetch_array($songQuery)){
        array_push($resultArray,$row['id']);
    }
    
    $jsonArray = json_encode($resultArray);


?>

<script>


$(document).ready(function(){
    currentPlaylist = <?php echo $jsonArray?>;
    audioElement = new Audio();
    setTrack(currentPlaylist[0],currentPlaylist,false);


    $(".playbackBar .progressBar").mousedown(function(){
        mouseDown=true;
    });

    $(".playbackBar .progressBar").mousemove(function(e){
        if(mouseDown){
            timeFromOffset(e,this);
        }
    });

    $(".playbackBar .progressBar").mouseup(function(e){
        timeFromOffset(e,this);
    });

    $(document).mouseup(function(){
        mouseDown = false;
    });



});

function timeFromOffset(mouse,progressBar){
    var percentage = mouse.offsetX / $(progressBar).width()*100;
    var seconds = audioElement.audio.duration * (percentage/100);
    audioElement.setTime(seconds); 
}

function setTrack(trackId, newPlaylist,play){
    
    $.post("includes/handlers/ajax/getSongJson.php",{ songId: trackId}, function(data){
        var track = JSON.parse(data);
        $(".trackName").text(track.title);

        $.post("includes/handlers/ajax/getArtistJson.php",{ artistId: track.artist}, function(data){
            var artist = JSON.parse(data);
            $(".artistName").text(artist.name);
        });

        $.post("includes/handlers/ajax/getAlbumJson.php",{ albumId: track.album}, function(data){
            var album = JSON.parse(data);
            console.log(album);
            $(".albumArtwork").attr("src",album.artworkPath);
        });

        audioElement.setTrack(track);
        playSong();
    });

    if(play){
        audioElement.play();
    }
}

function playSong(){

    if(audioElement.audio.currentTime ==0){
        $.post("includes/handlers/ajax/updatePlays.php",{songId: audioElement.currentlyPlaying.id})
       
    }

    $(".controlButton.playNow").hide();
    $(".controlButton.pause").show();

    audioElement.play();
}

function pauseSong(){
    $(".controlButton.playNow").show();
    $(".controlButton.pause").hide();
    audioElement.pause();
}


</script>
    
    
    <div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
    <div id="nowPlayingLeft">
        <div class="content">
            <div class="albumLink">
                <img class="albumArtwork" src="" alt="">
            </div>
<div class="trackInfo">
    <span class="trackName">
    
    </span>
    <span class="artistName">
    Metallica
    </span>
</div>

        </div>
    </div>
    <div id="nowPlayingCenter">
        <div class="content playerControls">
            <div class="buttons">
                  <button class="controlButton shuffle" title="shuffle"> <i class="fas fa-random"></i></button>
                  <button class="controlButton previous" title="previous"> <i class="fas fa-step-backward"></i></button>
                  <button class="controlButton playNow" title="play" onclick="playSong()"> <i class="far fa-play-circle"></i></button>
                  <button class="controlButton pause" title="pause" onclick="pauseSong()"> <i class="fas fa-pause"></i></button>
                  <button class="controlButton next" title="next"> <i class="fas fa-step-forward"></i></button>
                  <button class="controlButton loop" title="loop"> <i class="fas fa-retweet"></i></button>
            </div>
            <div class="playbackBar">
            <span class="progressTime current">0.00</span>
            <div class="progressBar">
                <div class="progressBarBg">
                    <div class="progress"></div>
                </div>
            </div>
            <span class="progressTime remaining">0.00</span>
            </div>
        </div>
    </div>
    <div id="nowPlayingRight">
<div class="volumeBar">

<button class="controlButton volume" title="Volume button">
<i class="fas fa-volume-up playSound"></i>
<i class="fas fa-volume-mute muteSound"></i>
</button>
<div class="progressBar">
                <div class="progressBarBg">
                    <div class="progress"></div>
                </div>
            </div>
</div>


    </div>



    </div>
    </div>