<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>


<?php

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "loginsystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$bal = isset($_POST['balance']);



$usr = $_SESSION['username'];
if( isset( $_REQUEST['yesDelete'] ) ) {
    $sql = "DELETE FROM users WHERE username ='$usr'";
    if(mysqli_query($conn, $sql))
    {

        header("Location: homePage.php");
        exit;
    }
    else
    {
        echo "Error deleting record"; // display error message if not delete
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="loginStyle.css">

</head>
<body>

<div class="row" >
    <div class="col-lg-5 m-auto" >
        <div class="card mt-5 bg-dark">

            <div class="card-body">

                <div class="mb-2 mx-2 ">

                    <div class="mb-3 mx-5" align="center" >

                        <h2 style="color:#ffffff;" >Czy na pewno chcesz usunąć konto?</h2>
                        <div class="btn-group">

                        <div class="mt-3">
                        <form action='' method="post">
                            <input type="submit" class="btn btn-success  submit-margin" name="yesDelete" value="Tak">
                        </form>
                        </div>
                        <div class="mt-3">
                        <form action='profile.php' method="post">
                            <input type="submit" class="btn btn-danger submit-margin" name="noDelete" value="Nie">
                        </form>
                        </div>

                        </div>
                    </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



</body>
</html>