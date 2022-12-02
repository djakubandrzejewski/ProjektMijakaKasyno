<?php

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
if( ! isset( $_POST['emailButton'] ) ) {
    $message = 'not submitted';
    echo $message;
} else {
    $input = $_POST['email'];

    $sql = "UPDATE users SET email = '$input' WHERE username ='$usr'";

    if ($conn->query($sql) == TRUE) {

    } else {
        echo "Błąd, spróbuj później:" . $conn->error;
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
    <div class="col-lg-5 m-auto" >a
        <div class="card mt-5 bg-dark">
            <div class="card-title text-center mt-3">
                <a class="logo" href="profile.php"><img src="homeImg/logo.png" ></a>
            </div>
            <div class="card-body">

                <div class="mb-2 mx-2">

                    <div class="login" align="center">

                        <form action='' method="post">
                            <h5 style="color: #ffffff " align="left" class="mx-3" >Wprowadź adres email:</h5><br>
                            <input type="text" class="form-control input-margin md-3" placeholder="email..." name="email" required> <br><br>
                            <input type="submit" class="btn btn-success submit-margin" name="emailButton" >
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



</body>
</html>

