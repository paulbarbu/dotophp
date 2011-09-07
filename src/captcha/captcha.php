<?php

$chars = '0123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
$used = '!';
$chars_array = array();
$captcha = NULL;

for($i=0;$i<strlen($chars);$i++){
    $chars_array[$i] = $chars[$i];
}

shuffle($chars_array);
$i=0;
while($i<5){
    $pos = rand(0, count($chars_array) - 1);

    if($used != $chars_array[$pos]){
        $captcha .= $chars_array[$pos];
        $chars_array[$pos] = $used;
        $i++;
    }
}

$_SESSION['captcha'] = $captcha;

$im = imagecreatetruecolor(141, 50);

if($im){
    $red = rand(10, 240);
    $green = rand(10, 240);
    $blue = rand(10, 240);

    $bg = imagecolorallocate($im, $red, $green, $blue);
    $black = imagecolorallocate($im, 0, 0, 0);

    imagefill($im, 0, 0, $bg);

    $code = $_SESSION['captcha'];

    //write chars in random positions
    for($i=0;$i<5;$i++){
        $x = rand(1 + (27 * $i), 27 + (27 * $i)); //every char in its part of the image
        $y = rand(1, 36);

        $red = rand(10, 240);
        $green = rand(10, 240);
        $blue = rand(10, 240);

        $char_color = imagecolorallocate($im, $red, $green, $blue);

        imagechar($im, 5, $x, $y, $code[$i], $char_color);
    }
    $style = array($bg, $bg, $bg, $bg, $bg, $bg, $bg,
        $black, $black, $black, $black, $black, $black);
    imagesetstyle($im, $style);

    $y_line_top = rand(0, 12);
    $y_line_bot = rand(38, 50);
    imageline($im, 0, $y_line_top, 140, $y_line_bot, IMG_COLOR_STYLED);

    $y_line_top = rand(0, 12);
    $y_line_bot = rand(38, 50);
    imageline($im, 0, $y_line_bot, 140, $y_line_top, IMG_COLOR_STYLED);

    header("Content-Type: image/png");
    imagepng($im);
    imagedestroy($im);
}
