<?php
require_once ("inc/main.php");

if(isset($_POST['login-in'])){    
    // username and password sent from form 
    $username = $_POST['username']; 
    $mypassword = $_POST['password']; 
   
    //Check username and password
    if($username == 'admin' && $mypassword == 'secretpassword') {
		// Correct
        $_SESSION['username'] = $username;
        header("location: admin.php");        
    } else {        
        //Incorrect
        $msg="Your Username or Password is invalid.";
        header("location: sign-in.php?msg=".$msg);
    }
}			
//header("location: index.php?msg=Something went wrong in login!");
?>
