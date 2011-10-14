<?php
/**
 * @file src/register/register.php
 * @brief Main file for register module
 * @author Paul Barbu
 *
 * @ingroup registerFiles
 */

var_dump($_SESSION['captcha']);

if(isset($_POST['register'])){
    $result = array();
    //TODO: add pending account, send mail with activation code

    if(isValidCaptcha($_SESSION['last_captcha'], $_POST['captcha'])){

        isset($_POST['sex']) ? $sex = $_POST['sex'] : $sex = NULL;

        //TODO: proceed registration, check isUser()

        if(!$feedback_pre['connect']){
            return R_ERR_DB_CONNECTION;
        }

        //TODO: filter the input

        $result = addUser($feedback_pre['connect'], $_POST['first_name'], $_POST['last_name'], $_POST['nick'],
            $_POST['email'], isset($_POST['private']) ? 1 : 0, $_POST['timezone'], $_POST['country'],
            $_POST['city'], $sex, $_POST['description'], $_POST['phone'],
            $_POST['birthday']);

        if(!$result[0]){
            return $result[1];
        }
        else{
            return ERR_NONE;
        }

        //TODO: do mail here
    }
    else{
        return R_ERR_CAPTCHA;
    }
}

return TRUE;
