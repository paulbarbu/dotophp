<?php
/**
 * @file src/captcha/generate_code.php
 * @brief Random captcha code generator
 * @author Paul Barbu
 *
 * @ingroup captchaFiles
 */

/**
 * @defgroup captchaFiles Captcha module
 */

$chars = '0123456789qwertyuioplkjhgfdsazxcvbnm';
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

/**
 * Motivation: upon hitting submit the captcha is regenerated so the code won't
 * match, so we keep the last captcha code to match with
 */
if(isset($_SESSION['captcha'])){
    $_SESSION['last_captcha'] = $_SESSION['captcha'];
}
else{
    $_SESSION['last_captcha'] = NULL;
}

$_SESSION['captcha'] = $captcha;
