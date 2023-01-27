<?php 

    include('../config/constants.php'); 
    include('login-check.php');

?>


<html>
    <head>
        <title>Y-FITAPP - Home Page</title>

        <link rel="stylesheet" href="../css/admin.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <meta name="viewport" content="width=device-wdith, initial-scale=1.0">
    
    <body>
        <!-- Menu Section Starts -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li><a class="nav-link" href="<?php echo SITEURL ?>user/index.php">Home<span class="sr-only">(current)</span></a></li>
        <?php
        if($_SESSION['role'] == 1) {
            echo '<li><a class="nav-link" href="'.SITEURL.'user/manage-user.php">Account</a></li>';
            echo '<li><a class="nav-link" href="'.SITEURL.'user/manage-category.php">Category</a></li>';
            echo '<li><a class="nav-link" href="'.SITEURL.'user/manage-exercises.php">Exercises</a></li>';
            echo '<li><a class="nav-link" href="'.SITEURL.'user/manage-workouts.php">All Workouts</a></li>';
        }
        ?>
        <li><a class="nav-link" href="<?php echo SITEURL ?>user/start-workout.php">START Workout</a></li>
        <li><a class="nav-link" href="<?php echo SITEURL ?>user/view-workout.php">Workout History</a></li>
        <li><a class="nav-link" href="<?php echo SITEURL ?>user/profile.php">Profile Page(<?php echo $_SESSION['user']; ?>)</a></li>
        <li><a class="nav-link" href="<?php echo SITEURL ?>user/logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
        
        
        <!-- Menu Section Ends -->