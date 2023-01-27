<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add User</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; 
                unset($_SESSION['add']); 
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

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
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" placeholder="Your Email">
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
                    <td>Profile image:</td>
                    <td>
                        <input type="file" name="profile_image">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //works

        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Encryption of password
        $role = $_POST['role'];
        $email = $_POST['email'];

        //2. Check whether the file is selected or not
        if(isset($_FILES['profile_image']['name']))
        {
            //echo "File Selected";
            //works

            $image_name = $_FILES['profile_image']['name'];

            //Works
            //echo $image_name;
            //die();

            //Check whether the image is selected or not and upload image if selected, else fill blank
            if($image_name!="")
            {
                //echo "Image Selected";
                //works
                //Get the extension of the image
                $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

                //echo $image_extension;
                //die();
                //Works


                //Check whether the extension is valid or not
                if(($image_extension=="jpg") || ($image_extension=="jpeg") || ($image_extension=="png") || ($image_extension=="gif"))
                {
                    //echo "Valid Extension";
                    //works
                    //A. Rename the Image
                    //Rename the image
                    $image_name = $username.rand(0000,9999).".".$image_extension; // New image name

                    //B. Upload the Image
                     //Get the src path and destination path

                        $src = $_FILES['profile_image']['tmp_name'];

                        $dest = "../images/profile/".$image_name;

                         //Move the image to the destination path
                    $upload = move_uploaded_file($src, $dest);

                    //Check whether the image is uploaded or not
                    if($upload==false)
                    {
                        //Failed to upload image
                        //Redirect to add-user.php with session message
                        $_SESSION['add'] = "<div class='alert alert-danger'>Failed to upload image</div>";
                        header("Location:".SITEURL."add-user.php");
                        die();
                    }
                }
                else
                {
                    //echo "Invalid Extension";
                    //works
                    //B. Display Error Message
                    $_SESSION['add'] = "<div class='alert alert-danger'>Invalid Extension</div>";
                    header("Location:".SITEURL."add-user.php");
                    die();
                }
                
            }
        }
        else
        {
            //echo "File Not Selected";
            //works
            $image_name = "";
        }

        $image_name = $image_name;

        //3. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_user SET 
            full_name='$full_name',
            username='$username',
            password='$password',
            role='$role',
            email='$email',
            profile_image='$image_name'
        ";
 
        //4. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

       //var_dump($res);
       // die();


        //5. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Account made successfully.</div>";
            //Redirect Page to User page
            header("location:".SITEURL.'user/manage-user.php');
        }
        else
        {
            //echo "Failed to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add User.</div>";
            //Redirect Page to Add User
            header("location:".SITEURL.'user/add-user.php');
        }
}
?>