<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="loginStyle.css">
</head>
<body>
<?php
require('db.php');

if (isset($_REQUEST['username'])) {

    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $create_datetime = date("Y-m-d H:i:s");
    $query    = "INSERT into `users` (username, password, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$create_datetime')";
    $result   = mysqli_query($con, $query);
    if ($result) {
        header("Location: login.php");
    } else {
        echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
    }
} else {
    ?>

    <div class="row" >
        <div class="col-lg-3 m-auto" >
            <div class="card mt-5 bg-dark">
                <div class="card-title text-center mt-3">
                    <a class="logo" href="homePage.php"><img src="homeImg/logo.png" ></a>
                </div>
                <div class="card-body">

                        <div class="mx-2 mb-2">

                            <div class="login" align="center">
                                <form action="" method="post" style="text-align: center;">
                                    <input type="text" class="form-control input-margin" placeholder="Nazwa użytkownika" name="username"> <br><br>
                                    <input type="password" class="form-control input-margin" placeholder="Hasło" id="pass" name="password" required> <br><br>
                                  <!--  <input type="password" class="form-control input-margin" placeholder="Powtórz hasło" id="cpass" name="cpass" required> <br><br>
-->
                                    <input type="submit"  class="btn btn-success submit-margin" value="Zarejestruj" name="submit">
                                    <p class="login-text">Masz konto? <a href="login.php">Zaloguj</a></p>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
</body>
</html>