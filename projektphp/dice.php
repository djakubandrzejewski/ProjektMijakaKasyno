<?php

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



if (isset($_POST['bet'])) {
    // echo "true---".$_POST['bet'];

    // setcookie("bet", $_POST['bet'], time() + 36000);

}

$betCookie = (isset($_POST['bet'])) ?  $_POST['bet'] : 0;

$usr = $_SESSION['username'];

$balance = mysqli_query($conn, "SELECT balance FROM users WHERE username ='$usr'");
$balance = mysqli_fetch_array($balance);
$curr_balance = $balance[0];

$registerDate = mysqli_query($conn, "SELECT create_datetime FROM users WHERE username ='$usr'");
$registerDate = mysqli_fetch_array($registerDate);

$email = mysqli_query($conn, "SELECT email FROM users WHERE username ='$usr'");
$email = mysqli_fetch_array($email);

$diceOne = '<i class="fas fa-dice-one"></i>';
$diceTwo = '<i class="fas fa-dice-two"></i>';
$diceThree = '<i class="fas fa-dice-three"></i>';
$diceFour = '<i class="fas fa-dice-four"></i>';
$diceFive = '<i class = "fas fa-dice-five"></i>';
$diceSix = '<i class="fas fa-dice-six"></i>';
$arrayOfDices = array($diceOne, $diceTwo, $diceThree, $diceFour, $diceFive, $diceSix);
$rolledNumber = rand(0, count($arrayOfDices) - 1) + 1;
$roll1 = $arrayOfDices[$rolledNumber - 1];
$komunikat;
$betBalance = 0;
$GLOBALS['money_error'] = false;


function checkZaklad()
{
    global $conn, $rolledNumber, $betCookie, $usr, $komunikat, $balance, $curr_balance;
    if (isset($_POST['zaklad'])) {
        $bet_sum = 0;

        $zaklad = $_POST['zaklad'];

        if($betCookie > $balance[0]){
            $GLOBALS['money_error'] = true;
        }else if($betCookie > 0){
            $GLOBALS['money_error'] = false;
            if ($zaklad == 'low' && $rolledNumber >= 1 && $rolledNumber <= 3 || $zaklad == 'high' && $rolledNumber >= 4 && $rolledNumber <= 6) {
                $komunikat = "Wygrałeś!";
                $bet_sum = $balance[0] + $betCookie * 1.8;
                $sql = "UPDATE users SET balance=$bet_sum WHERE username ='$usr'";
                echo $sql;
                $conn->query($sql);
                $curr_balance = $bet_sum;
    
                return;
                // Header('Location: '.$_SERVER['PHP_SELF']);
            }
    
            $zaklad = intval($zaklad);
    
            if ($zaklad === $rolledNumber) {
                $komunikat = "Wygrałeś!";
                
                $bet_sum = $balance[0] + $betCookie * 5;
                $sql = "UPDATE users SET balance=$bet_sum WHERE username ='$usr'";
                $conn->query($sql);
    
                $curr_balance = $bet_sum;
                return;
                // Header('Location: '.$_SERVER['PHP_SELF']);
            }
    
            $komunikat = "Przegrałeś!";
            $bet_sum = $balance[0] - $betCookie;
            $sql = "UPDATE users SET balance=$bet_sum WHERE username ='$usr'";
            $curr_balance = $bet_sum;
            $conn->query($sql);
        }



        // Header('Location: '.$_SERVER['PHP_SELF']);
    }
}

// $bal = isset($_POST['balance']);

checkZaklad();

// echo $curr_balance;
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Title</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="homePageStyles.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4cb54da156.js" crossorigin="anonymous"></script>
</head>

<body style="background-color:darkgreen;">
    <header>
        <a class="logo" href="/dice.php"><img src="homeImg/logo.png"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="./dice.php">Kości</a></li>
                <li><a href="flipCoin_view.php">Moneta</a></li>
            </ul>
        </nav>
        <a class="cta" href="profile.php">Profil</a>

    </header>

    <div class="text-center w-50 mx-auto" style="margin-top: 100px;">
        <h5 class="mb-3" style="color:#ffffff;">Kredyty: <?php echo $curr_balance; ?></h5>

        <?php if($GLOBALS['money_error'] == true): ?>
            <div class=""> Brak środków</div>
        <?php endif; ?>

        <form action='dice.php' class="mx-auto" method="post">
            <div class="d-flex w-50 mx-auto">

                
                    <input type="number" class="form-control" placeholder="Wysokość zakładu" name="bet" value="<?php echo $betCookie ?>" required>
               

                <button class="btn btn-success submit-margin btn-lg">
                    OBSTAW
                </button>
            </div>

            <?php if (isset($komunikat) && $komunikat) : ?>
                <p class="message" style="color: <?php echo ($komunikat == 'Przegrałeś!') ? 'red' : 'green' ?>">
                    <?php echo $komunikat; ?>
                </p>
            <?php endif; ?>

            <p style="font-size: 200px; color:#ffffff;"><?php echo $roll1 ?> </p>

            <h3 style="color:#ffffff;">MNOŻNIK X5</h3>

            <div class="button-box">
                <div>
                    <input type="radio" id="zaklad1" class="btn btn-success submit-margin btn-lg" name="zaklad" value="1">
                    <label for="zaklad1">1</label>
                </div>
                <div>
                    <input type="radio" id="zaklad2" class="btn btn-success submit-margin btn-lg" name="zaklad" value="2">
                    <label for="zaklad2">2</label>
                </div>
                <div>
                    <input type="radio" id="zaklad3" class="btn btn-success submit-margin btn-lg" name="zaklad" value="3">
                    <label for="zaklad3">3</label>
                </div>
                <div>
                    <input type="radio" id="zaklad4" class="btn btn-success submit-margin btn-lg" name="zaklad" value="4">
                    <label for="zaklad4">4</label>
                </div>
                <div>
                    <input type="radio" id="zaklad5" class="btn btn-success submit-margin btn-lg" name="zaklad" value="5">
                    <label for="zaklad5">5</label>
                </div>
                <div>
                    <input type="radio" id="zaklad6" class="btn btn-success submit-margin btn-lg" name="zaklad" value="6">
                    <label for="zaklad6">6</label>
                </div>
            </div>

            <h3 class="mt-4" style="color:#ffffff;">MNOŻNIK X1.8</h3>
            <div class="button-box button-box--wide">
                <div>
                    <input type="radio" id="low" class="btn btn-danger submit-margin btn-lg" name="zaklad" value="low">
                    <label for="low">NISKIE [1-3]</label>
                </div>
                <div>
                    <input id="high" type="radio" class="btn btn-danger submit-margin btn-lg" name="zaklad" value="high">
                    <label for="high">WYSOKIE [4-6]</label>
                </div>
            </div>
        </form>
    </div>
</body>

</html>