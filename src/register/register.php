<?php
/**
 * @file src/register/register.php
 * @brief Main file for register module
 * @author Paul Barbu
 *
 * @ingroup registerFiles
 */

if(isset($_POST['register'])){
    $result = array();
    $retval = NULL;

    list($captcha, $first_name, $last_name, $nick, $email, $city, $description,
        $phone, $birthday) = filterInput($_POST['captcha'], $_POST['first_name'],
                             $_POST['last_name'], $_POST['nick'], $_POST['email'],
                             $_POST['city'], $_POST['description'], $_POST['phone'],
                             $_POST['birthday']);

    if(isValidCaptcha($_SESSION['last_captcha'], $captcha)){

        if(!$feedback_pre['connect']){
            $retval = R_ERR_DB_CONNECTION;
        }
        else{
            $existing_user = isUser($feedback_pre['connect'], $nick, $email);
            if($existing_user == MATCHING_NICK){
                $retval = R_ERR_USED_NICK;
            }
            elseif($existing_user == MATCHING_MAIL){
                $retval = R_ERR_USED_MAIL;
            }
            else{
                isset($_POST['sex']) ? $sex = $_POST['sex'] : $sex = NULL;

                $result = validateUserData($first_name, $last_name, $nick, $email,
                    isset($_POST['private']) ? 1 : 0, $_POST['timezone'], $_POST['country'],
                    $city, $sex, $description, $phone, $birthday);

                if(isset($result[0]) && $result[0] === FALSE){
                    $retval = $result[1];
                }
                elseif(!mysqli_query($feedback_pre['connect'], 'BEGIN;')){
                    $retval = R_ERR_DB;
                }
                elseif(insertIntoDB($feedback_pre['connect'], 'user', $result)){

                    $activation_code = genActivationCode($nick);

                    if(!addPendingUser($feedback_pre['connect'], $activation_code)){
                        $retval = R_ERR_DB;
                    }
                    else{

                        $mail_data = require 'mail_data.php';
                        $url = 'http://' . $_SERVER['SERVER_NAME'] . app_path()
                             . '/index.php?show=activate';

                        $msg_specifiers = array(
                            'nick' => $nick,
                            'code_link' => $url . '&code=' . $activation_code,
                            'activation_link' => $url,
                            'code' => $activation_code,
                        );

                        if(!mail($email, vsprintf_named($mail_data['subject'],
                                 array('nick' => $nick)), vsprintf_named($mail_data['msg'],
                                 $msg_specifiers), $mail_data['header'])){

                            $retval = R_ERR_NOT_SENT;
                        }
                        else{
                            $retval = ERR_NONE;
                        }

                        if(!mysqli_query($feedback_pre['connect'], 'COMMIT;')){
                            $retval = R_ERR_DB;
                        }
                    }
                }
                else{
                    $retval = R_ERR_DB;
                }
            }
        }
    }
    else{
        $retval = R_ERR_CAPTCHA;
    }

    if($retval == R_ERR_DB || $retval == R_ERR_DB_CONNECTION){
        writeLog('register', '(' . mysqli_errno($feedback_pre['connect'])
                 . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);
        mysqli_query($feedback_pre['connect'], 'ROLLBACK;');
    }

    return $retval;
}

return TRUE;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
