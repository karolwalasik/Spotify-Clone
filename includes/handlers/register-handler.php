<?php


function sanitizeFormPassword($inputText){
    $inputText = strip_tags($inputText);
    return $inputText;
}

function sanitizeFormUsername($inputText){
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "",$inputText);
    return $inputText;
}

function sanitizeFormString($inputText){
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "",$inputText);
    $inputText = ucfirst(strtolower($inputText));
    return $inputText;
}





if(isset($_POST['registerButton'])){
   
    $username = sanitizeFormUsername($_POST['username']);
    $firstName =  sanitizeFormString($_POST['firstName']);
    $lastName =  sanitizeFormString($_POST['lastName']);
    $email =  sanitizeFormString($_POST['email']);
    $emailC=  sanitizeFormString($_POST['emailC']);
    $password = sanitizeFormPassword($_POST['password']);
    $passwordC = sanitizeFormPassword($_POST['passwordC']);

    $wasSuccessful=$account->register($username,$firstName,$lastName,$email,$emailC,$password,$passwordC);

    if($wasSuccessful){
        $_SESSION['userLoggedIn']=$username;

        header("Location: index.php");
    }
  
}

?>