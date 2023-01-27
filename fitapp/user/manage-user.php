<?php include('partials/menu.php'); ?>


        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage user</h1>

                <br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Displaying Session Message
                        unset($_SESSION['add']); //REmoving Session Message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }

                ?>
                <br><br><br>

                <!-- Button to Add user -->
<a href="add-user.php" class="btn-primary">Add user</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                        <th>Role</th>
                    </tr>

                    
                    <?php 
                        //Query to Get all user
                        $sql = "SELECT * FROM tbl_user";
                        //Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //Check whether the Query is Executed or not
                        if($res==TRUE)
                        {
                            // Count Rows to CHeck whether we have data in database or not
                            $count = mysqli_num_rows($res); // Function to get all the rows in database

                            $sn=1; //initializing serial number

                            //if count is greather then zero, we have data in database
                            if($count>0)
                            {
                                //WE HAve data 
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Using While loop to get all the data from database.

                                    //Get individual DAta
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];
                                    $role=$rows['role'];

                                    //Display the Values in our Table
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>user/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>user/update-user.php?id=<?php echo $id; ?>" class="btn-secondary">Update user</a>
                                            <a href="<?php echo SITEURL; ?>user/delete-user.php?id=<?php echo $id; ?>" class="btn-danger">Delete user</a>
                                        </td>
                                        <td><?php if ($role == 1) {
                                            echo "Admin";
                                        }
                                        elseif ($role ==2) {
                                            echo "User";
                                        }
                                        if ($role ==3) {
                                            echo "Guest";
                                        }
                                        
                                        ?></td>
                                    </tr>

                                    <?php

                                }
                            }
                            else
                            {
                                //We have no data in database
                            }
                        }

                    ?>


                    
                </table>

            </div>
        </div>
        <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>