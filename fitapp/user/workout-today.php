<?php include('partials/workouttoday.php'); ?>
<div class="container">
<!-- button top right of screen to go back to start-workout.php -->
<h2 class="text-center">
<a href="<?php echo SITEURL; ?>user/start-workout.php" class="btn btn-primary">Back to start workout page</a>
</h2>

<?php // Display workouts from database when date == today and if $_SESSION['user'] == user_id

    // Get the user id from the session
    $user_id = $_SESSION['user_id'];

    // Get the date given from the URL
    //$date = date('Y-m-d');
    $date = $_GET['date'];

    // Get the workouts from the database from current date
    $sql = "SELECT * FROM tbl_workout WHERE user_id = '$user_id' AND workout_date = '$date'";
    $res = mysqli_query($conn, $sql);

    //Count the rows
    $count = mysqli_num_rows($res);

    $sn = 1; //Create a Serial Number and set its initail value as 1
    ?>

    <?php if($count>0) { ?>
        <h2>Workouts for <?php echo $date; ?></h2>
        <!-- Display session message when workout is edited or deleted -->
        <?php if(isset($_SESSION['success'])) { ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; ?>
            </div>
        <?php unset($_SESSION['success']);
             } ?>
             <!-- Display session message when workout is deleted -->
                <?php if(isset($_SESSION['delete'])) { ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['delete']; ?>
                    </div>
                    <?php unset($_SESSION['delete']);
                } ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Exercise</th>
                    <th>Weight</th>
                    <th>Reps</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row=mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $row['exercise']; ?></td>
                        <td><?php echo $row['weight']. " kg"; ?></td>
                        <td><?php echo $row['sets']; ?></td>
                        <td><a href="edit-workout.php?id=<?php echo $row['id']; ?>" class="btn input-block-level form-control">Edit</a></td>
                        <td><a href="delete-workout.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <h2>No workouts for <?php echo $date; ?></h2>
    <?php } ?>
</div>

    <?php include('partials/footertoday.php'); ?>