<?php
session_start();

$code = rand(1000, 9999);
$_SESSION["captcha"] = $code;

$image = imagecreatetruecolor(50, 24);
$background_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagefilledrectangle($image, 0, 0, 50, 24, $background_color);
imagestring($image, 5, 5, 5, $code, $text_color);
header("Content-Type: image/jpeg");
imagejpeg($image);
imagedestroy($image);
?>
