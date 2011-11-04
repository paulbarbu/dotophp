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

                if(!mysqli_query($feedback_pre['connect'], 'BEGIN;')){
                    $retval = R_ERR_DB;
                }
                else{

                    $result = addUser($feedback_pre['connect'], $first_name, $last_name, $nick,
                        $email, isset($_POST['private']) ? 1 : 0, $_POST['timezone'], $_POST['country'],
                        $city, $sex, $description, $phone, $birthday);

                    if(!$result[0]){
                        $retval = $result[1];
                    }
                    else{
                        $activation_code = genActivationCode($nick);

                        if(!addPendingUser($feedback_pre['connect'], $activation_code)){
                            $retval = R_ERR_DB;
                        }
                        else{

                            $mail_data = require 'mail_data.php';
                            $url = 'http://' . $_SERVER['SERVER_NAME'] . app_path() . '/index.php?show=activate';

                            $msg_specifiers = array(
                                'nick' => $nick,
                                'code_link' => $url . '&code=' . $activation_code,
                                'activation_link' => $url,
                                'code' => $activation_code,
                            );

                            if(!mail($email, vsprintf_named($mail_data['subject'], array('nick' => $nick)),
                                     vsprintf_named($mail_data['msg'], $msg_specifiers), $mail_data['header'])){

                                mysqli_query($feedback_pre['connect'], 'DELETE FROM pending WHERE user_id = LAST_INSERT_ID();');
                                mysqli_query($feedback_pre['connect'], 'DELETE FROM user WHERE id = LAST_INSERT_ID();');

                                $retval = R_ERR_MAIL;
                            }
                            else{

                                if(!mysqli_query($feedback_pre['connect'], 'COMMIT;')){
                                    $retval = R_ERR_DB;
                                }
                                else{
                                    $retval = ERR_NONE;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    else{
        $retval = R_ERR_CAPTCHA;
    }

    if($retval == R_ERR_DB || $retval == R_ERR_DB_CONNECTION){
        writeLog('../logs/register.log', '(' . mysqli_errno($feedback_pre['connect']) . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);
    }

    return $retval;
}

return TRUE;
