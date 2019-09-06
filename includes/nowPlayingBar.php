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
    var newPlaylist = <?php echo $jsonArray?>;
    audioElement = new Audio();
    setTrack(newPlaylist[0],newPlaylist,false);
    updateVolumeProgressBar(audioElement.audio);

    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e){
        e.preventDefault();
    });


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


    $(".volumeBar .progressBar").mousedown(function(){
        mouseDown=true;
    });

    $(".volumeBar .progressBar").mousemove(function(e){
        if(mouseDown){
            var percentage = e.offsetX/$(this).width();
            if(percentage>=0 && percentage<=1){
                audioElement.audio.volume = percentage;
            }
            
       
        }
    });

    $(".volumeBar .progressBar").mouseup(function(e){
        var percentage = e.offsetX/$(this).width();
            if(percentage>=0 && percentage<=1){
                audioElement.audio.volume = percentage;
            }
            
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


function prevSong(){
    if(audioElement.audio.currentTime>=3 || currentIndex==0){
        audioElement.setTime(0);
    }
    else{
        currentIndex = currentIndex-1;
        setTrack(currentPlaylist[currentIndex],currentPlaylist,true);
    }
}

function nextSong(){
    if(repeat ==true){
        audioElement.setTime(0);
        playSong();
        return;
    }
    if(currentIndex == currentPlaylist.length-1){
        currentIndex=0;
    }
    else{
        currentIndex=currentIndex+1;
    }

    var trackToPlay=shuffle?shufflePlaylist[currentIndex]:currentPlaylist[currentIndex];
    setTrack(trackToPlay,currentPlaylist,true);
}

function setRepeat(){
    repeat = !repeat;
   $(".loop .fas.fa-retweet").toggleClass("buttonOn");
}

function setShuffle(){
    shuffle=!shuffle;
   $(".fas.fa-random").toggleClass("buttonOn");

   if(shuffle){
    shuffleArray(shufflePlaylist);
    currentIndex= shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
   }
   else{
    currentIndex= currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
   }
}

function shuffleArray(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
}

function setMute(){
    audioElement.audio.muted=!audioElement.audio.muted;
   if(audioElement.audio.muted){
       $(".playSound").hide();
       $(".muteSound").show();
   }
   else{
    $(".playSound").show();
       $(".muteSound").hide();
   }
}

function setTrack(trackId, newPlaylist,play){

    if(newPlaylist!=currentPlaylist){
        currentPlaylist = newPlaylist;
        shufflePlaylist=currentPlaylist.slice();
        shuffleArray(shufflePlaylist);
    }
    if(shuffle){
        currentIndex = shufflePlaylist.indexOf(trackId);
    }
    currentIndex = currentPlaylist.indexOf(trackId);
    pauseSong();
    
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
                  <button class="controlButton shuffle" onclick="setShuffle()"title="shuffle"> <i class="fas fa-random"></i></button>
                  <button class="controlButton previous" onclick="prevSong()"title="previous"> <i class="fas fa-step-backward"></i></button>
                  <button class="controlButton playNow" title="play" onclick="playSong()"> <i class="far fa-play-circle"></i></button>
                  <button class="controlButton pause" title="pause" onclick="pauseSong()"> <i class="fas fa-pause"></i></button>
                  <button class="controlButton next" title="next" onclick="nextSong()"> <i class="fas fa-step-forward"></i></button>
                  <button class="controlButton loop" onclick="setRepeat()" title="loop"> <i class="fas fa-retweet"></i></button>
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

<button class="controlButton volume" onclick="setMute()" title="Volume button">
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