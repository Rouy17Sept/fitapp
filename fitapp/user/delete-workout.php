<?php 
    //Include COnstants Page
    include('../config/constants.php');

    //Echo "Delete workout page";

    if(isset($_GET['id']))
    {
        //Process to Delete
        //echo "Process to Delete";

        //1.  Get ID and Image NAme
        $id = $_GET['id'];
        //echo $id;

        //2. Delete workout from Database
        $sql = "DELETE FROM tbl_workout WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed or not and set the session message respectively
        // Redirect to workout-today.php with session message
        if($res==true)
        {
            //workout Deleted
            $_SESSION['delete'] = "<div class='success'>workout Deleted Successfully.</div>";
            header('location:'.SITEURL.'user/workout-today.php');
        }
        else
        {
            //Failed to Delete workout and redirect to previous page with session message
            $_SESSION['delete'] = "<div class='error'>Failed to Delete workout.</div>";
            header('location:'.SITEURL.'user/workout-today.php');
        }
    }
    else
    {
        //Redirect to workout-today.php with session message if no id is passed
        $_SESSION['delete'] = "<div class='error'>No ID is passed.</div>";
        header('location:'.SITEURL.'user/manage-workouts.php');
    }

    ?>