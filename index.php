<!DOCTYPE html>

<?php
include("includes/config.php");
if(isset($_SESSION['userLoggedIn'])){
    $userLoggedIn=$_SESSION['userLoggedIn'];
}
else{
    header("Location: register.php");
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spotify clone</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="mainContainer">
<div class="topContainer">
    <div id="navBarContainer">
        <nav class="navBar">
            <a href="index.php" class="logo">
                <i class="fab fa-spotify"></i>
            </a>

            <div class="group">
                <div class="navItem">
                    <a href="search.php"class="navItemLink searchIcon">Search
                    <i class="fas fa-search"></i> 
                    </a>
                </div>
            </div>
            <div class="group">
            <div class="navItem">
                    <a href="browse.php"class="navItemLink">Browse</a>
                </div>
                <div class="navItem">
                    <a href="yourmusic.php"class="navItemLink">Your Music</a>
                </div>
                <div class="navItem">
                    <a href="profile.php"class="navItemLink">Karol Walasik</a>
                </div>
            </div>

        </nav>
    </div>

</div>
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

    </div>
</body>
</html>