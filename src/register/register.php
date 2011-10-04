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
    //TODO: check captcha then call addUser and is it gives an error then report it to view
    //add pending account, send mail with activation code

    if(isValidCaptcha($_SESSION['last_captcha'], $_POST['captcha'])){
        //TODO: proceed registration
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DATABASE);

        if(!$link){
            die('Connect error (' . mysqli_connect_errno() . '): ' . mysqli_connect_error());
            //TODO: ERR_DB_CONNECTION
        }

        //TODO: fileter the input

        var_dump(addUser($link, $_POST['first_name'], $_POST['last_name'], $_POST['nick'],
            $_POST['email'], isset($_POST['private']) ? 1 : 0, $_POST['timezone'], $_POST['country'],
            $_POST['city'], $_POST['sex'], $_POST['description'], $_POST['phone'],
            $_POST['birthday']));

        //TODO: check the return value of addUser and take action accordignly

        mysqli_close($link);

        //TODO: do mail here
    }
    else{
        var_dump("CAPTCHA");
        //TODO: invent ERR_CAPTCHA and return it to the view
    }
}
