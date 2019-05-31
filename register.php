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
</head>
<body>
    <div id="inputContainer">
        <form action="register.php" id="loginForm" method="POST" >
        <h2>Login to your account</h2>
        <div>
       
        <label for="loginUsername">Username</label>
        <input type="text" id="loginUsername" name="loginUsername" placeholder="e.g mrSmith333" required>
        </div>
        <div>
        <label for="loginPassword">Password</label>
        <input type="password" id="loginPassword" name="loginPassword" required>
        </div> 
        <button type="submit" name="loginButton">Submit</button>
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
        </form>
    </div>
</body>
</html>