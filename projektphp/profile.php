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
$usr = $_SESSION['username'];
$balance = mysqli_query($conn, "SELECT balance FROM users WHERE username ='$usr'");
$balance = mysqli_fetch_array($balance);

$registerDate = mysqli_query($conn, "SELECT create_datetime FROM users WHERE username ='$usr'");
$registerDate = mysqli_fetch_array($registerDate);

$email = mysqli_query($conn, "SELECT email FROM users WHERE username ='$usr'");
$email = mysqli_fetch_array($email);
?>



<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="loginStyle.css">
    <link rel="stylesheet" href="styles.css">

</head>
<body>

<div class="row" >
    <div class="col-lg-5 m-auto" >
        <div class="card mt-5 bg-dark">
            <div class="card-title text-center mt-3">
                <a class="logo" href="dice.php"><img src="homeImg/logo.png" ></a>
            </div>
            <div class="card-body">

                    <div class="mb-2 mx-2 ">

                        <div class="mb-3 mx-5" align="center" >
                            <div align="left">
                            <h5 style="color:#ffffff;">Nazwa: <?php echo $_SESSION['username']; ?></h5>
                            <h5 style="color:#ffffff;">Kredyty: <?php echo $balance[0];?></h5>
                            <h5 style="color:#ffffff;">Użytkownik od: <?php echo $registerDate[0];?></h5>
                            <h5 style="color:#ffffff;">Mail: <?php echo $email[0];?></h5>
                            </div>
                             <br><br>
                            <form action=''>
                                <input type="submit" style="display: none;">
                            </form>
                            <form action='email.php'>
                                <input type="submit" class="btn btn-success submit-margin" name="feedbackButton" value="Dodaj Maila">
                            </form>
                            <form action='addBal.php'>
                                <input type="submit" class="btn btn-success submit-margin" name="addButton" value="Dodaj kredyty">
                            </form>

                            <form action='feedback.php'>
                                <input type="submit" class="btn btn-success submit-margin" name="feedbackButton" value="Zgłoś problem">
                            </form>

                            <form action='deleteAcc.php'>
                                <input type="submit" class="btn btn-danger submit-margin" name="deleteAccButton" value="Usuń konto">
                            </form>

                            <form action='logout.php'>
                                <input type="submit" class="btn btn-danger submit-margin" name="logoutButton" value="Wyloguj się">
                            </form>
                            </div>

                    </div>

            </div>
        </div>
    </div>
</div>



</body>
</html>

