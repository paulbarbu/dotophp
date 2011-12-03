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

/**
 * Possible chars for the captcha image
 */
const CHARS = '0123456789qwertyuioplkjhgfdsazxcvbnm';
/**
 * Flag for already used char
 */
$used = '!';
/**
 * Array of possible chars
 */
$chars_array = array();
/**
 * The captcha string
 */
$captcha = NULL;

$chars_array = str_split(CHARS);

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
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
