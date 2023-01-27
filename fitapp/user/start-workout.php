<?php include('partials/workoutmenu.php'); ?>

<div class="container">
<!-- Start of workout starts here -->
<div class="">
    <div class="wrapper">
        <h1 class="header">Start Workout <?php echo $_SESSION['user']; ?></h1>
      <!---  <h2><?php echo $_SESSION['user']; ?></h2> --->
        <br><br>
        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            // Display session message $_SESSION['workoutadded']
            if(isset($_SESSION['workoutadded'])) { ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['workoutadded']; ?>
                </div>
                <?php unset($_SESSION['workoutadded']);
            }

            // Display session message $_SESSION['workoutadded']
            if(isset($_SESSION['workoutadded'])) { ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['workoutadded']; ?>
                </div>
                <?php unset($_SESSION['workoutadded']);
            }

        ?>
    </div>
        </div>
    </div>
    <!-- End of workout starts here -->
    </div>
    </div>

    <?php


    ?>
        
            
        <form action="" method="post" enctype="multipart/form-data">
            <table>
            <div class="container">
            <div class="form-group">
                <div class="row">
                    <label for="">Workout Name:</label>
                    <input type="text" name="exercise" id="" value="" list="exercise" class="form-control">

                            <datalist id='exercise'>

                            <?php 
                                //Create PHP Code to display exercises from Database
                                //1. CReate SQL to get all active exercises from database
                                $sql = "SELECT * FROM tbl_exercises WHERE active='Yes'";

                                //Executing qUery
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have exercises or not
                                $count = mysqli_num_rows($res);
                                
                                //IF count is greater than zero, we have exercises else we don't have exercises
                                if($count>0)
                                {
                                    //2. Create a while loop to display all the exercises
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        //3. Display the exercise name in the dropdown
                                        echo '<option value="'.$row['title'].'">'.$row['title'].'</option>';
                                    }
                                }
                                else
                                {
                                    echo '<option value="">No exercises found</option>';
                                }
                            ?>
                            </datalist>
                            </input>
                </div>
                <div class="row">
                    <label for="">Weight</label>
                    <input type="number" name="weight" placeholder="" step="0.5" class="form-control">
                </div>
                <div class="row">
                    <label for="">Sets</label>
                    <input type="number" name="sets" placeholder="" step="1" class="form-control">
                </div>
                
                <div class="row">
                <div class="button-group text-center">

                <!-- 



                    <div class="col"> 
                        <input type="submit" name="submit" class="btn btn-primary button" value=" Add workout to database ">
                    </div>


                            -->

                            <button type="submit" name="submit" class="btn btn-primary" value="Add workout to database">
                                Add workout
                    </button>
                    
                    &nbsp; &nbsp; &nbsp; &NonBreakingSpace;
                        
                        <?php 
                        //Get date of today
                        $date = date('Y-m-d');
                        ?>
                        
                        <a href="workout-today.php?date=<?php echo $date; ?>" class="btn btn-primary">Today's saved</a>

                        
                    
                    
                   <!-- 

                    <button type="button" class="btn btn-primary button">
                                hoihoi
                    </button>
                            -->

                    
                
            </div>
            </div>
            </div>

            <?php

                


                //If add button is clicked
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form
                    $exercise = $_POST['exercise'];
                    $weight = $_POST['weight'];
                    $sets = $_POST['sets'];

                    $workout_date = date('Y-m-d');

                    //Get user id from session
                   // $user_id = $_SESSION['user_id'];

                    //Get username from session
                    $username = $_SESSION['user'];

                    //Get user id from username
                    $sql = "SELECT * FROM tbl_user WHERE username='$username'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);
                    $user_id = $row['id'];

                    //Insert the workout into the database
                    $sql = "INSERT INTO tbl_workout(exercise, user_id, username, weight, sets, workout_date) VALUES('$exercise', '$user_id', '$username', '$weight', '$sets', '$workout_date')";

                    //echo  $sql;
                    //die();
                    
                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    //Check whether the query is executed or not
                    if($res)
                    {
                        $_SESSION['workoutadded'] = 'Workout Added Successfully';
                        echo '<script>window.location.href="'.SITEURL.'/user/start-workout.php"</script>';
                    }
                    else
                    {
                        $_SESSION['workoutadded'] = 'Error Adding Workout';
                        echo '<script>window.location.href="'.SITEURL.'/user/start-workout.php"</script>';
                    }
                }

                ?>


                </table>
        </form>

                </div>






<?php include('partials/footertoday.php'); ?>    