<?php include('partials/workoutmenu.php'); ?>

<?php

// Get all info from row['exercise'] and row['weight'] and row['sets']
$sql = "SELECT * FROM tbl_workout WHERE user_id = '$_SESSION[user_id]'";
$res = mysqli_query($conn, $sql);

//Get all unique data from ['exercise']
$unique_exercises = array();
while($row = mysqli_fetch_assoc($res))
{
    $unique_exercises[] = $row['exercise'];
}
$unique_exercises = array_unique($unique_exercises);




echo '<div class="container">';
// Search bar to search on this page by exercise name registered as id
echo '<div class="row">';
echo '<div class="col-md-12">';
echo '<form action="" method="GET">';
echo '<div class="input-group">';
echo '<input type="text" class="text-center" name="search" placeholder="Search by exercise name">';
echo '<span class="input-group-btn">';
echo '<button class="btn btn-default" type="submit">Search</button>';
echo '</span>';
echo '</div>';
echo '</form>';
echo '</div>';
echo '</div>';

// End of search bar
//Display all unique exercises
foreach($unique_exercises as $exercise)
{
    echo '<h2 id="$exercise">'.$exercise.'</h2>';
    echo '<table class="table table-bordered">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Date</th>';
    echo '<th>Weight</th>';
    echo '<th>Sets</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    // Get all info from row['exercise'] and row['weight'] and row['sets']
    $sql = "SELECT * FROM tbl_workout WHERE user_id = '$_SESSION[user_id]' AND exercise = '$exercise'";
    $res = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($res))
    {
        echo '<tr>';
        echo '<td>'.$row['workout_date'].'</td>';
        echo '<td>'.$row['weight'].'</td>';
        echo '<td>'.$row['sets'].'</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}

