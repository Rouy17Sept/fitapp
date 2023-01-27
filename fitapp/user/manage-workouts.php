<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Workouts</h1>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>Nr.</th>
                        <th>Exercise ID</th>
                        <th>Weight</th>
                        <th>Sets</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM tbl_workout ORDER BY id DESC"; // DIsplay the Latest Order at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        // When user role = 1, show all the workouts

                        if($_SESSION['role'] == 1)
                        {
                            //IF count is greater than zero, we have orders else we don't have orders
                            if($count>0)
                        {
                            //Workouts Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the Workout details
                                $id = $row['id'];
                                $exercise = $row['exercise'];
                                $weight = $row['weight'];
                                $sets = $row['sets'];
                                $workout_date = $row['workout_date'];
                                $user_id = $row['user_id'];
                                $username = $row['username'];
                                $image_name = $row['image_name'];
                                
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $exercise; ?></td>
                                        <td><?php echo $weight; ?></td>
                                        <td><?php echo $sets; ?></td>
                                        <td><?php echo "total"; ?></td>
                                        <td><?php echo $workout_date; ?></td>

                                        <td>
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled
                                                /*
                                                if($status=="Ordered")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                                */

                                                echo $user_id;
                                            ?>
                                        </td>

                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $image_name; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-workout.php?id=<?php echo $id; ?>" class="btn-secondary">Edit Workout</a>
                                            <a href="<?php echo SITEURL; ?>user/view-workout.php?id=<?php echo $id; ?>" class="btn-secondary">View Workout</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12' class='error'>No workouts available or in history.</td></tr>";
                        }

                        }

                        // When user role = 2, show only his workouts
                        else if($_SESSION['role'] == 2)
                        {
                            //if count is greater then zero, user has workouts in history
                            if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the Workout details
                                 //3. Display the order in the table
                                 if($row['user_id'] == $_SESSION['user_id'])
                                 {
                                $id = $row['id'];
                                $exercise = $row['exercise'];
                                $weight = $row['weight'];
                                $sets = $row['sets'];
                                $workout_date = $row['workout_date'];
                                $user_id = $row['user_id'];
                                $username = $row['username'];
                                $image_name = $row['image_name'];
                                 }
                                
                                //If user_id is equal to the logged in user's id, show the workout

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $exercise; ?></td>
                                        <td><?php echo $weight; ?></td>
                                        <td><?php echo $sets; ?></td>
                                        <td><?php echo "total"; ?></td>
                                        <td><?php echo $workout_date; ?></td>

                                        <td>
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled
                                                /*
                                                if($status=="Ordered")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                                */

                                                echo $user_id;
                                            ?>
                                        </td>

                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $image_name; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-workout.php?id=<?php echo $id; ?>" class="btn-secondary">Edit Workout</a>
                                            <a href="<?php echo SITEURL; ?>user/view-workout.php?id=<?php echo $id; ?>" class="btn-secondary">View Workout</a>
                                        </td>
                                    </tr>

                                    <?php

                                 
                        }

                    }
                    else
                    {
                        //No Workouts Available
                        echo "<tr><td colspan='12' class='error'>No workouts available or in history.</td></tr>";
                    }

                }

                    ?>

                </table>

                <br><br>

                <?php

                        
                    ?>

 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>