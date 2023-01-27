<?php

//authorize if user is logged in or not
//Check whether user is logged in or not

if(!isset($_SESSION['user'])) //If user session is not set
{
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to use this app.</div>";
    //Redirect to Login Page 
    header('location:'.SITEURL.'user/login.php');
}

?>