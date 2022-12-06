<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="loginStyle.css">
</head>
<body>
<?php
require('db.php');
session_start();
// When form submitted, check and create user session.
if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);    // removes backslashes
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    // Check user is exist in the database
    $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $_SESSION['username'] = $username;
        // Redirect to user dashboard page
        header("Location: dice.php");
    } else {
        echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
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


                <div class="mb-2 mx-2">

                            <div class="login" align="center" name="login">
                                <form method="post" style="text-align: center;">
                                    <input type="text" class="form-control input-margin" placeholder="Nazwa użytkownika" name="username" required> <br><br>
                                    <input type="password" class="form-control input-margin" placeholder="Hasło" name="password" required> <br><br>
                                    <input type="submit"  class="btn btn-success submit-margin" value="Login" name="submit">
                                    <p class="login-text">Nie masz konta? <a href="registration.php">Zarejestruj</a></p>
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
</html><?php
