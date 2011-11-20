<?php
/**
 * @file src/notreceived/notreceived.php
 * @brief No activation email was sent, it must be resent
 * @author Paul Barbu
 *
 * @ingroup notreceivedFiles
 */

/**
 * @defgroup notreceivedFiles Resend the activation email
 */

if(isset($_POST['resend'])){

    if(!$feedback_pre['connect']){
        writeLog('../logs/register.log', '(' . mysqli_errno($feedback_pre['connect'])
                 . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);
        return NR_ERR_DB_CONNECTION;
    }

    if(!isset($_POST['email'])){
        return NR_ERR_NO_MAIL;
    }

    list($email) = filterInput($_POST['email']);

    if(!isValidMail($email)){
        return NR_ERR_MAIL;
    }

    $result = mysqli_query($feedback_pre['connect'],
                    "SELECT id, nick FROM user WHERE email = '" . $email . "';");

    list($id, $nick) = mysqli_fetch_array($result, MYSQLI_NUM);

    if($id === NULL){
        return NR_ERR_MAIL;
    }

    $result = mysqli_query($feedback_pre['connect'],
                    "SELECT code FROM pending WHERE user_id = " . $id . ";");

    list($activation_code) = mysqli_fetch_array($result, MYSQLI_NUM);

    if($activation_code === NULL){
        return NR_ERR_ACTIVE;
    }

    $mail_data = require 'mail_data.php';
    $url = 'http://' . $_SERVER['SERVER_NAME'] . app_path()
         . '/index.php?show=activate';

    $msg_specifiers = array(
        'nick' => $nick,
        'code_link' => $url . '&code=' . $activation_code,
        'activation_link' => $url,
        'code' => $activation_code,
    );

    if(!mail($email, vsprintf_named($mail_data['subject'], array('nick' => $nick)),
            vsprintf_named($mail_data['msg'], $msg_specifiers), $mail_data['header'])){
        return NR_ERR_NOT_SENT;
    }

    return ERR_NONE;
}

return TRUE;
