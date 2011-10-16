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

    list($captcha, $first_name, $last_name, $nick, $email, $city, $description,
        $phone, $birthday) = filterInput($_POST['captcha'], $_POST['first_name'],
                             $_POST['last_name'], $_POST['nick'], $_POST['email'],
                             $_POST['city'], $_POST['description'], $_POST['phone'],
                             $_POST['birthday']);

    if(isValidCaptcha($_SESSION['last_captcha'], $captcha)){

        if(!$feedback_pre['connect']){
            return R_ERR_DB_CONNECTION;
        }

        if(isUser($feedback_pre['connect'], $nick, $email)){
            return R_ERR_USER;
        }

        isset($_POST['sex']) ? $sex = $_POST['sex'] : $sex = NULL;

        $result = addUser($feedback_pre['connect'], $first_name, $last_name, $nick,
            $email, isset($_POST['private']) ? 1 : 0, $_POST['timezone'], $_POST['country'],
            $city, $sex, $description, $phone, $birthday);

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
