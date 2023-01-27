<?php include('partials/menu.php'); ?>


<!-- Main Content Section Starts -->
<div class="main-content">
            <div class="wrapper">
                <h1>Home Page Of <?php echo $_SESSION['user']; ?></h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>


                
                <div class="col-4 text-center">
                    
                    <?php 


                    
                        //Sql Query 
                        $sql4 = "SELECT * FROM tbl_workout WHERE user_id = '$_SESSION[user_id]'";
                        //Execute Query
                        $res4 = mysqli_query($conn, $sql4);
                        //Count Rows
                        $count4 = mysqli_num_rows($res4);
                        
                    ?>
                    
                    <h1><?php echo $count4; ?></h1>
                    <br />
                    Total Workouts done by you

                </div>
                

                <div class="col-4 text-center">

                    <?php
                     
                        // Get info from tbl_workout where user_id = $_SESSION['user_id']
                        // Get the info from rows weight and sets
                        // Calculate the total weight and sets
                        // Display the total weight and sets

                        //Sql Query
                        $sql5 = "SELECT * FROM tbl_workout WHERE user_id = '$_SESSION[user_id]'";
                        //Execute Query
                        $res5 = mysqli_query($conn, $sql5);
                        //Count Rows
                        $count5 = mysqli_num_rows($res5);

                        $total_weight = 0;
                        $total_sets = 0;

                        while($row5 = mysqli_fetch_assoc($res5))
                        {
                            $total_weight += $row5['weight'];
                            $total_sets += $row5['sets'];
                        }

                        //Multiply total weight and sets by each other
                        $total_weight_sets = $total_weight * $total_sets;

                        
                    ?>

                    <h1><?php echo number_format($total_weight_sets, 0, '', '.'); ?>kg</h1>
                    <br />
                    <!-- Categories --> 
                    Total kg's moved by you 
                </div>

                <div class="col-4 text-center">

                    <?php 
                    
                        // Count the number of days this user has logged workouts in database
                        // Get the info from tbl_workout where user_id = $_SESSION['user_id']
                        // Get the info from row workout_date
                        // For every different workout_date, +1 to the count
                        // Display the count

                        //Sql Query
                        $sql6 = "SELECT * FROM tbl_workout WHERE user_id = '$_SESSION[user_id]'";
                        //Execute Query
                        $res6 = mysqli_query($conn, $sql6);
                        //Count Rows
                        $count6 = mysqli_num_rows($res6);

                        $workout_date = array();
                        $count_workout_date = 0;

                        while($row6 = mysqli_fetch_assoc($res6))
                        {
                            $workout_date[] = $row6['workout_date'];
                        }

                        //Count the number of different workout_date
                        $count_workout_date = count(array_unique($workout_date));

                        //Display the count

                        
                    ?>

                    <h1><?php echo $count_workout_date; ?> days</h1>
                    <br />
                    <!-- Exercises --> 
                    Total days you have logged workouts
                </div>

                <div class="col-4 text-center">
                    
                    <?php 


                    ?>

                    <h1>Test<?php //echo $; ?></h1>
                    
                    <br />
                    <!-- Total exercises done --> 
                    Test
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Setion Ends -->

        

<?php include('partials/footer.php') ?>