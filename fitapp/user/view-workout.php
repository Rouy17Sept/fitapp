<?php include('partials/workoutmenu.php'); ?>

<?php

// Get a list of every day this user has workouts on
$sql = "SELECT * FROM tbl_workout WHERE user_id = '$_SESSION[user_id]'";
$res = mysqli_query($conn, $sql);
$workout_days = array();
while($row = mysqli_fetch_assoc($res))
{
    $workout_days[] = $row['workout_date'];
}


echo '<div class="container">';
// Header text telling user what to do
echo '<h2 class="text-center">Workout History</h2>';
// Show todays date
echo '<h3 class="text-center">Today is '.date('l, F jS, Y').'</h3>';
echo '<h5 class="text-center">Click on a date to view your workout</h5>';
echo '<div class="row">';
echo '<div class="col-md-12">';
echo '<table class="table table-bordered">';
//Display every unique day this user has workouts on
$unique_days = array_unique($workout_days);
// Loop through each day and display a link to that day's workout
// If the day is today, display it in a different color
// Sort date by newest to oldest
rsort($unique_days);

foreach($unique_days as $day)
{
    // Convert date to readable format
    $date = date('l, F jS, Y', strtotime($day));
    // Create a link to the workout-today.php page with the workout date as a parameter
    // If the date is today, display it in a different color
    if($day == date('Y-m-d'))
    {
        echo '<a href="workout-today.php?date='.$day.'" class="btn btn-primary btn-lg btn-block">(Today) '.$date.'</a>';
    }
    else
    {
        echo '<a href="workout-today.php?date='.$day.'" class="btn btn-default btn-lg btn-block">'.$date.'</a>';
    }
    //echo '<a href="'.SITEURL.'user/workout-today.php?id='.$day.'" class="btn btn-primary btn-lg btn-block">View your workout from '.$date.'.</a>';
    echo '<br>';
}

echo '</table>';
echo '</div>';
echo '</div>';
echo '</div>';