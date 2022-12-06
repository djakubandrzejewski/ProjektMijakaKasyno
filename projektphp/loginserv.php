<?php
$error="";
if(isset($_POST['submit'])){
    if(empty($_POST['user']) || empty($_POST['pass']) ){
        $error = "usermane or password is invalid";
    }
    else{
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $conn = mysqli_connect("localhost","root","", "test");

        $query = mysqli_query($conn, "SELECT * FORM userspass WHERE pass='$pass' AND user='$user'");

        $rows = mysqli_num_rows($query);
        if($rows == 1){
            header("Location: welcome.php");
        }
        else{
            $error = "usermane or password is invalid";
        }
        mysqli_close($conn);
    }
}
