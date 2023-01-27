<?php

//Start session
session_start();

//Bootstrap
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php

//Repeating values
define('SITEURL', 'https://fitapp.yjilderda.nl/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'yjilderda_nl_fitapp');
define('DB_PASSWORD', 'hsat7ypj2h4u');
define('DB_NAME', 'yjilderda_nl_fitapp');


$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting database

?>



