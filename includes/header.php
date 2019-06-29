<?php
include("includes/config.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");

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
    <script src="assets/js/script.js"></script>
</head>
<body>

<div class="mainContainer">
<div class="topContainer">
   <?php include("includes/navBar.php"); ?>
   <div id="mainViewContainer">
        <div id="mainContent">