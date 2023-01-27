<?php 

    include('../config/constants.php'); 
    include('login-check.php');

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Side Bar Navigation</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Work+Sans:400,600" rel="stylesheet">
  </head>
  <body>
    <link rel="stylesheet" href="../../css/workoutapp.css">
    
    <div class="container">
      <div class="phone">
        <div class="content">
          
          <nav role="navigation">
            <div id="menuToggle">
              <input type="checkbox" />
                <span></span>
                <span></span>
                <span></span>
            <ul id="menu">
              <li><a href="#">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Info</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
           </div>
          </nav>
        </div>
       </div>
    </div>
   
  </body>
</html>