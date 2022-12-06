<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>



<?php

include 'db_setting.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$bal = isset($_POST['balance']);

$code1 = 'free1000';
$code2 = 'f&f';
$message = '';
$usr = $_SESSION['username'];
if( ! isset( $_POST['creditButton'] ) ) {
    $message = 'not submitted';
    echo $message;
} else {
    $input = $_POST['balance'];
    $free = mysqli_query($conn, "SELECT free FROM users WHERE username ='$usr'");
    $ff = mysqli_query($conn, "SELECT free FROM users WHERE username ='$usr'");
    if ( $input == $code1 ) {

        echo $message;
        $sql = "UPDATE users SET balance=balance + '1000', free = true WHERE username ='$usr'";
        if ($conn->query($sql) == TRUE) {
            echo "<script type='text/javascript'>alert('Sukces! Otrzymujesz 1000 kredytów.');</script>";
        } else {
            echo "Błąd, spróbuj później:" . $conn->error;
        }


        $conn->close();
    } elseif ( $input == $code2 AND $ff == false) {
        echo $message;
        $sql = "UPDATE users SET balance=balance + '10000', ff = true WHERE username ='$usr'";
        if ($conn->query($sql) == TRUE) {
            echo "<script type='text/javascript'>alert('Sukces! Otrzymujesz 10000 kredytów.');</script>";
        } else {
            echo "Błąd, spróbuj później: " . $conn->error;
        }

    }else{
        echo "<script type='text/javascript'>alert('Kod błędny lub wykorzystany.');</script>";
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
            <div class="card-title text-center mt-3">
                <a class="logo" href="profile.php"><img src="homeImg/logo.png" ></a>
            </div>
            <div class="card-body">

                <div class="mb-2 mx-2">

                    <div class="login" align="center">

                        <form action='' method="post">
                            <input type="text" class="form-control input-margin" placeholder="Wprowadź kod" name="balance" required> <br><br>
                            <input type="submit" class="btn btn-success submit-margin" name="creditButton" >
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



</body>
</html>

