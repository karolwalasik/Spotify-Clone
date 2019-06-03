<?php 
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");

$account = new Account($con);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spotify</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <script   src="https://code.jquery.com/jquery-3.4.1.slim.min.js"   integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="   crossorigin="anonymous"></script>
    <script src="assets/js/register.js"></script>
</head>
<body> 
<?php
if(isset($_POST['registerButton'])){
echo '
<script>
$(document).ready(function(){
    $("#loginForm").hide();
    $("#registerForm").show();
};</script>';
}else{
   echo ' <script>
    $(document).ready(function(){
        $("#loginForm").show();
        $("#registerForm").hide();
    };</script>';
}
?>
    <div id="background">
    <div class="mainContainer">
           
                <div class="leftContainer">
                <form action="register.php" id="loginForm" method="POST" >
                <h2>Login to your account</h2>
                <div>
                <?php echo $account->getError(Constants::$loginFailed);?>
                <label for="loginUsername">Username</label>
                <input type="text" id="loginUsername" name="loginUsername" placeholder="e.g mrSmith333" value="<?php getInputValue('loginUsername') ?>" required>
                </div>
                <div>
                <label for="loginPassword">Password</label>
                <input type="password" id="loginPassword" name="loginPassword" required>
                </div> 
                <button type="submit" name="loginButton">Submit</button>
                <div class="hasAccount"><span id="hideLogin">Don't have an account yet? Signup now!</span></div>
                </form>


                <form action="register.php" id="registerForm" method="POST" >
                <h2>Create account</h2>
                <div>
                <?php echo $account->getError(Constants::$usernameCharacters);?>
                <?php echo $account->getError(Constants::$usernameTaken);?>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="e.g mrSmith333" value="<?php getInputValue('username') ?>" required>
                </div>
                
                
                <div>
                <?php echo $account->getError(Constants::$firstNameCharacters);?>
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" placeholder="e.g John" value="<?php getInputValue('firstName') ?>" required>
                </div>
                

                <div>
                <?php echo $account->getError(Constants::$lastNameCharacters);?>
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" placeholder="e.g Smith" value="<?php getInputValue('lastName') ?>" required>
                </div>
            

                <div>
                <?php echo $account->getError(Constants::$emailsDoNotMatch);?>
                <?php echo $account->getError(Constants::$emailInvalid);?>
                <?php echo $account->getError(Constants::$emailTaken);?>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="e.g johnsmith@spotify.com" value="<?php getInputValue('email') ?>" required>
                </div>
                


                <div>
                <label for="emailC">Email Confirmation</label>
                <input type="email" id="emailC" name="emailC" placeholder="e.g johnsmith@spotify.com" value="<?php getInputValue('emailC') ?>" required></div>
            


                <div>
                <?php echo $account->getError(Constants::$passwordsDoNotMatch);?>
                <?php echo $account->getError(Constants::$passwordNotAlphanumeric);?>
                <?php echo $account->getError(Constants::$passwordCharacters);?>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                </div>

                <div>
                <label for="passwordC">Password Confirmation</label>
                <input type="password" id="passwordC" name="passwordC" required>
                </div>

                <button type="submit" name="registerButton">Register</button>
                <div class="hasAccount"><span id="hideRegister">Already have an account? Log in here.</span></div>
                </form>
            </div>
            
            <div class="rightContainer">
                <div class="rightSection">
<h1>All your favourite songs right here.</h1>
<h2>Listen for free</h2>
<ul>
    <li><i class="fas fa-check"></i>Discover music you'll fall in love with</li>
    <li><i class="fas fa-check"></i>Create your own playlists</li>
    <li><i class="fas fa-check"></i>Follow artists to keep up to date</li>
</ul>
</div>
            </div>
        </div>
    </div>
</body>
</html>