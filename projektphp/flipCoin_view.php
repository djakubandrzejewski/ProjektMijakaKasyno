<?php

include("auth_session.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
include 'db_setting.php';

$betCookie = (isset($_POST['bet'])) ?  $_POST['bet'] : 0;

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
$curr_balance = $balance[0];

$registerDate = mysqli_query($conn, "SELECT create_datetime FROM users WHERE username ='$usr'");
$registerDate = mysqli_fetch_array($registerDate);

$email = mysqli_query($conn, "SELECT email FROM users WHERE username ='$usr'");
$email = mysqli_fetch_array($email);


$GLOBALS['money_error'] = false;

$arrayOfPossibleResults = array('reszka', 'orzeł');
$flippedCoin = $arrayOfPossibleResults[rand(0, count($arrayOfPossibleResults) - 1)];

function checkZaklad()
{

    $img =[
        'reszka' => '<img src="https://cdn.discordapp.com/attachments/915923559388442647/1046906558623264778/reszka.png" height="100px" width="100px" alt=""/>',
        'orzeł' => '<img src="https://cdn.discordapp.com/attachments/915923559388442647/1046906588474122322/orzel.png" height="100px" width="100px" alt=""/>'
    ];

    global $conn, $usr, $komunikat, $flippedCoin, $betCookie,  $balance, $curr_balance;
    if (isset($_POST['zaklad'])) {
        $zaklad = $_POST['zaklad'];
        $bet_sum = 0;

        if($betCookie > $balance[0]){
            $GLOBALS['money_error'] = true;
        }else if($betCookie > 0){
            $GLOBALS['money_error'] = false;
            if (strtolower($zaklad) == $flippedCoin) {
                $komunikat = "Wygrałeś!".$img[$flippedCoin];
                $bet_sum = $balance[0] + $betCookie * 2;
                $sql = "UPDATE users SET balance=$bet_sum WHERE username ='$usr'";
                $conn->query($sql);
                $curr_balance = $bet_sum;
                return;
            }
    
            $komunikat = "Przegrałeś!".$img[$flippedCoin];
            $bet_sum = $balance[0] - $betCookie;
            $sql = "UPDATE users SET balance=$bet_sum WHERE username ='$usr'";
            $curr_balance = $bet_sum;
            $conn->query($sql);
        }

        
    }
}

checkZaklad();


// print_r($_POST);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Title</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="homePageStyles.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    <style type="text/css">
        p {
            width: 200px;
            height: 200px;
            text-align: center;
            background-color: transparent;
            padding: 5px;
            display: flex;
            margin-left: auto;
            margin-right: auto;

        }

        .przyciski {
            display: flex;
            width: 100%;
        }

        .monety {
            width: 50%;
            text-align: right;
            background-color: transparent;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;

        }

        .monety1 {
            width: 50%;
            background-color: transparent;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        .zero {
            width: 100px;
            margin-left: auto;
            margin-right: auto;
            width: 10em
        }
    </style>
</head>

<body style="background-color: grey;">
    <header>
        <a class="logo" href="dice.php"><img src="homeImg/logo.png"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="dice.php">Kości</a></li>
                <li><a href="flipCoin_view.php">Moneta</a></li>
            </ul>
        </nav>
        <a class="cta" href="profile.php">Profil</a>

    </header>


    <div class="d-flex w-50 mx-auto">
        <h5 class="mb-3" style="color:#ffffff;">Kredyty: <?php echo $curr_balance; ?></h5>

        <?php if($GLOBALS['money_error'] == true): ?>
            <div class=""> Brak środków</div>
        <?php endif; ?>

        <form action="" method="POST" class="mx-auto">
            <div class="d-flex w-50 mx-auto">
                <input type="number" class="form-control" placeholder="Wysokość zakładu" name="bet" value="<?php echo $betCookie ?>" required>
            </div>
            <input type="submit" class="form-control" name="zaklad" value="Reszka">
            <input type="submit" class="form-control" name="zaklad" value="Orzeł">
        </form>
    </div>


    <?php if (isset($komunikat) && $komunikat) : ?>
        <p class="message" style="color: <?php echo ($komunikat == 'Przegrałeś!') ? 'red' : 'green' ?>">
            <?php echo $komunikat; ?>
        </p>
    <?php endif; ?>


    <script>
        var balance = 1000;
        // console.log(balance);

        function coinRandom() {
            var drawnNumber = Math.floor(Math.random() * 2);
            console.log(drawnNumber);
            

            return drawnNumber;
        }

        function heads(balance) {

            if (coinRandom() === 1) {
                var balance = 1000;
                var str = "Wygrałeś!";



                balance += 100;
                document.getElementById("demo").innerHTML = str + balance + $image_url;
                console.log(100);
            } else {
                var str = "Przegrałeś!";
                document.getElementById("demo").innerHTML = str + $image_url2;
                balance -= 100;
            }

        }

        function tails() {

            if (coinRandom() === 0) {
                var str = "Wygrałeś!";
                document.getElementById("demo").innerHTML = str + $image_url2;
            } else {
                var str = "Przegrałeś!";
                document.getElementById("demo").innerHTML = str + $image_url;
            }
        }

    </script>
    <div class="zero">
        <p id="demo"></p>
    </div>
</body>

</html>