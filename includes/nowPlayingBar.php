<?php
    $songQuery = mysqli_query($con, "SELECT id FROM Songs ORDER BY RAND() LIMIT 10");
    $resultArray=array();
    while($row=mysqli_fetch_array($songQuery)){
        array_push($resultArray,$row['id']);
    }
    
    $jsonArray = json_encode($resultArray);


?>

<script>
console.log(<?php echo $jsonArray?>);

</script>
    
    
    <div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
    <div id="nowPlayingLeft">
        <div class="content">
            <div class="albumLink">
                <img class="albumArtwork" src="https://www.nuclearblast.de/static/articles/253/253456.jpg/1000x1000.jpg" alt="">
            </div>
<div class="trackInfo">
    <span class="trackName">
    Fade to black
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
                  <button class="controlButton playNow" title="play"> <i class="far fa-play-circle"></i></button>
                  <button class="controlButton pause" title="pause"> <i class="fas fa-pause"></i></i></button>
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