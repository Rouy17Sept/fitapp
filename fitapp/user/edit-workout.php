<?php include('partials/workoutmenu.php'); ?>

<?php 

    //Check if id is set or not
    if(isset($_GET['id']))
    {
        //Get the id from the url
        $id = $_GET['id'];

        //Get the workout from the database
        $sql = "SELECT * FROM tbl_workout WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        //Get the user id from the session
        $user_id = $_SESSION['user_id'];

        //Get the username from the session
        $username = $_SESSION['user'];

        //Get the individual values of the workout if the user is the owner of the workout
        if($user_id == $row['user_id'])
        {
            $exercise = $row['exercise'];
            $weight = $row['weight'];
            $sets = $row['sets'];
        }
        else
        {
            //If the user is not the owner of the workout, redirect to the home page
            header('Location:'.SITEURL.'user/index.php');
        }


    }
    else
    {
        //If the id is not set, redirect to the home page
        header('Location:'.SITEURL.'user/index.php');
    }
?>


<h2 class="text-center">Edit Workout</h2>


<form action="" method="post">
    <table class="table table-bordered">
        <tr>
            <th>Exercise</th>
            <td><input type="text" name="exercise" value="<?php echo $exercise; ?>" class="form-control"></td>
        </tr>
        <tr>
            <th>Weight</th>
            <td><input type="text" name="weight" value="<?php echo $weight; ?>" class="form-control"></td>
        </tr>
        <tr>
            <th>Sets</th>
            <td><input type="text" name="sets" value="<?php echo $sets; ?>" class="form-control"></td>
        </tr>
        <tr>  
            <td colspan="2" class="text-center">
                <input type="submit" name="update" value="Update" class="btn btn-primary">
            </td>
        </tr>

    </table>
</form>


<?php
    //If update button is clicked
    if(isset($_POST['update']))
    {
        //Get the values from the form
        $exercise = $_POST['exercise'];
        $weight = $_POST['weight'];
        $sets = $_POST['sets'];

        //Update the workout in the database
        $sql2 = "UPDATE tbl_workout SET exercise = '$exercise', weight = '$weight', sets = '$sets' WHERE id = '$id'";
        $res2 = mysqli_query($conn, $sql2);

        //Check if the update was successful
        if($res2==true){
            //If successful, redirect to workout-today.php with session success message
            $_SESSION['success'] = 'Workout updated successfully';
            header('Location:'.SITEURL.'user/workout-today.php');
        }
        else{
            //If not successful, show error
            echo '<div class="alert alert-danger">
                    <strong>Error!</strong> Workout could not be updated.
                </div>';
        }
    }
?>


