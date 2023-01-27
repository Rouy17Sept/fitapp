<?php include('partials/menu.php'); ?>

<?php 
       /* 
        //CHeck whether user id is set or not
        if(isset($_GET['id']))
        {
            //Get the user id and details of the selected user
            $id = $_GET['id'];

            //Get the DEtails of the SElected user
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count the rows
            $count = mysqli_num_rows($res);
            //CHeck whether the data is available or not
            if($count==1)
            {
                //WE Have DAta
                //GEt the Data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //user not Availabe
                //REdirect to Home Page
                //header('location:'.SITEURL);      =================== kijken\11!!!!!
            }
        }
        else
        {
            //Redirect to homepage
                //header('location:'.SITEURL);      =================== kijken\11!!!!!
            }
        
    ?>


<section class="user-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected user</legend>

                    <div class="user-menu-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/user/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>


<?php */ ?>


<h1>Start Workout</h1>


<form action="" method="POST" class="order">
    <fieldset>
        <legend>Selected user</legend>

        <div class="user-menu-img">
            <?php 
            
                //CHeck whether the image is available or not
                if($image_name=="")
                {
                    //Image not Availabe
                    echo "<div class='error'>Image not Available.</div>";
                }
                else
                {
                    //Image is Available
                    ?>
                    <img src="<?php echo SITEURL; ?>images/user/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php
                }
            
            ?>

        </div>

        <div class="user-menu-info">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td>Role:</td>
                    <td>
                        <select name="role" id="role">
                            <option value="1">Admin</option>
                            <option value="2">Operator</option>
                            <option value="3">Guest</option>
                            </select>    
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </div>

    </fieldset>

    <?php 
        //Check whether the user is Submitted or not
        if(isset($_POST['submit']))
        {
            //Get the values from the form
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            //Check whether the user is available or not
            $sql = "SELECT * FROM tbl_user WHERE username='$username'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //User is already available
                echo "<div class='error'>User is already available.</div>";
            }
            else
            {
                //User is not available
                //Insert the user into the database
                $sql = "INSERT INTO tbl_user(full_name, username, password, role) VALUES('$full_name', '$username', '$password', '$role')";
                $res = mysqli_query($conn, $sql);

                if($res)
                {
                    //User is added
                    echo "<div class='success'>User is added.</div>";
                }
                else
                {
                    //User is not added
                    echo "<div class='error'>User is not added.</div>";
                }
            }
        }
    ?>

    </form>
        
        
        </div>
    </section>



    






<?php include('partials/footer.php'); ?>