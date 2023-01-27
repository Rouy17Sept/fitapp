<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Y-FITAPP</title>
        <link rel="stylesheet" href="../css/login.css">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>


<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
<br><br>
<h2>
    <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
</h2>
            <br><br>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="https://cdn.dribbble.com/users/2936109/screenshots/9104861/media/adb7ea3582831c9dc959cfca049c534b.jpg?compress=1&resize=800x600&vertical=top" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="" method="POST">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="Enter Username">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Enter Password">
      <input type="submit" name="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
  <p class="text-center">Created By - <a href="www.yjilderda.nl">Youri Jilderda</a></p>
</div>
</body>
</html>

<?php 

    //CHeck whether the Submit Button is Clicked or NOt
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. COunt rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User AVailable and Login Success
            $_SESSION['login'] = "<div class='alert alert-success'>Welcome back $username!</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            //Get the user id
            $row = mysqli_fetch_assoc($res);
            $user_id = $row['id'];

            //Store the user id in session
            $_SESSION['user_id'] = $user_id;

            //Get user role
            $role = $row['role'];

            //Store role in session
            $_SESSION['role'] = $role;

            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'user/');
        }
        else
        {
            //User not Available and Login FAil
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'user/login.php');
        }


    }

?>

