

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
    <div class="col-lg-3 m-auto" >
        <div class="card mt-5 bg-dark">
            <div class="card-title text-center mt-3">
                <a class="logo" href="homePage.php"><img src="homeImg/logo.png" ></a>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-2 mx-2">

                        <div class="login" align="center">
                            <form action="login1.php" method="post" style="text-align: center;">
                                <input type="text" class="form-control input-margin" placeholder="Nazwa użytkownika" id="user" name="user" required> <br><br>
                                <input type="password" class="form-control input-margin" placeholder="Hasło" id="pass" name="pass" required> <br><br>
                                <input type="submit"  class="btn btn-success submit-margin" value="Login" name="submit">
                                <p class="login-text">Nie masz konta? <a href="register.php">Zrejestruj</a></p>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</body>
</html>

<div class="row" >
    <div class="col-lg-3 m-auto" >
        <div class="card mt-5 bg-dark">
            <div class="card-title text-center mt-3">
                <a class="logo" href="homePage.php"><img src="homeImg/logo.png" ></a>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-2 mx-2">

                        <div class="login" align="center" name="login">
                            <form action="login1.php" method="post" style="text-align: center;">
                                <input type="text" class="form-control input-margin" placeholder="Nazwa użytkownika" name="username" required> <br><br>
                                <input type="password" class="form-control input-margin" placeholder="Hasło" name="password" required> <br><br>
                                <input type="submit"  class="btn btn-success submit-margin" value="Login" name="submit">
                                <p class="login-text">Nie masz konta? <a href="register.php">Zrejestruj</a></p>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>