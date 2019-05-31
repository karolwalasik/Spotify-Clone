<?php 
include("includes/classes/Account.php");

$account = new Account();
$account->register();
include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");
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
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="e.g mrSmith333" required>
        </div>
        
        
        <div>
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName" placeholder="e.g John" required>
        </div>
        

        <div>
        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName" placeholder="e.g Smith" required>
        </div>
      

        <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="e.g johnsmith@spotify.com" required>
        </div>
        


        <div>
        <label for="emailC">Email Confirmation</label>
        <input type="email" id="emailC" name="emailC" placeholder="e.g johnsmith@spotify.com" required></div>
      


        <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        </div>

        <div>
        <label for="passwordC">Password Confirmation</label>
        <input type="passwordC" id="passwordC" name="passwordC" required>
        </div>

        <button type="submit" name="registerButton">Register</button>
        </form>
    </div>
</body>
</html>