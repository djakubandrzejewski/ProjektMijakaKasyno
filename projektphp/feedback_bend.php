<?php
$textField = $_POST['textField'];

$date = date("Y-m-d H:i:s");

$file = fopen('feedback.txt', 'a');
$end = '<br><br>';
fwrite($file, $date. PHP_EOL);
fwrite($file, $textField. PHP_EOL. PHP_EOL);
fclose($file);

echo "<script type='text/javascript'>alert('Wysłano.');</script>";

include 'feedback.php';

?>
