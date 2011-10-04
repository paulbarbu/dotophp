<?php
/**
 * @file src/register/register.php
 * @brief Main file for register module
 * @author Paul Barbu
 *
 * @ingroup registerFiles
 */

if(isset($_POST['register'])){
    //TODO: check captcha then call addUser and is it gives an error then report it to view
    //add pending account, send mail with activation code

    if(isValidCaptcha($_SESSION['last_captcha'], $_POST['captcha'])){
        var_dump("hello");
        //TODO: proceed registration
    }
    else{
        var_dump("CAPTCHA");
        //TODO: invent ERR_CAPTCHA and return it to the view
    }
}
