<?php
/**
 * @file src/recover/recover.php
 * @brief Main recover module file
 * @author Paul Barbu
 *
 * @ingroup recoverFiles
 */

if(isset($_POST['proceed'])){
    list($email) = filterInput($_POST['email']);

    if(!$feedback_pre['connect']){
        $retval = RECOVER_ERR_DB_C;
    }
    elseif(isUser($feedback_pre['connect'], NULL, $email) !== MATCHING_MAIL){
        $retval = RECOVER_ERR_NOUSER;
    }
    else{
        $result = mysqli_query($feedback_pre['connect'],
            "SELECT id, activated, security_q, security_a, nick FROM user WHERE email = '"
            . $email . "';");

        if(!$result){
            $retval = RECOVER_ERR_DB;
        }
        else{
            $data = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if($data['activated'] == "0000-00-00 00:00:00"){
                $retval = RECOVER_ERR_INACTIVE;
            }
            else{
                $_SESSION['security_q'] = $data['security_q'];
                $_SESSION['security_a'] = $data['security_a'];
                $_SESSION['id'] = $data['id'];
                $_SESSION['nick'] = $data['nick'];
                $_SESSION['email'] = $email;

                $retval = RECOVER_PROCESSED;
            }
        }
    }

    if($retval == RECOVER_ERR_DB || $retval == RECOVER_ERR_DB_C){
        writeLog('../logs/recover.log', '(' . mysqli_errno($feedback_pre['connect'])
                . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);
    }

    return $retval;
}
elseif(isset($_POST['recover'])){

    list($answer) = filterInput($_POST['security_a']);

    if(!$feedback_pre['connect']){
        $retval = RECOVER_ERR_DB_C;
    }
    elseif(!(isValidSecurityData($answer) &&
             strcmp($answer, $_SESSION['security_a']) == 0)){

        $retval = RECOVER_ERR_ANSWER;

    }
    elseif(!mysqli_query($feedback_pre['connect'], 'BEGIN;')){
        $retval = RECOVER_ERR_DB;
    }
    elseif(!mysqli_query($feedback_pre['connect'],
            "UPDATE user SET password = NULL, security_q = NULL, security_a = NULL, activated = '0000-00-00 00:00:00' WHERE id = '"
            . $_SESSION['id'] . "';")){
        $retval = RECOVER_ERR_DB;
    }
    else{
        $activation_code = genActivationCode($_SESSION['nick']);

        if(!insertIntoDB($feedback_pre['connect'], 'pending',
                array('user_id' => $_SESSION['id'], 'code' => $activation_code))){
            $retval = RECOVER_ERR_DB;
        }
        else{

            $mail_data = require 'mail_data.php';
            $url = 'http://' . $_SERVER['SERVER_NAME'] . app_path()
                 . '/index.php?show=activate';

            $msg_specifiers = array(
                'nick' => $_SESSION['nick'],
                'code_link' => $url . '&code=' . $activation_code,
                'activation_link' => $url,
                'code' => $activation_code,
            );

            if(!mail($_SESSION['email'], vsprintf_named($mail_data['subject'],
                     array('nick' => $_SESSION['nick'])), vsprintf_named($mail_data['msg'],
                     $msg_specifiers), $mail_data['header'])){

                $retval = RECOVER_ERR_NOT_SENT;
            }
            else{
                $retval = RECOVERED;
            }

            if(!mysqli_query($feedback_pre['connect'], 'COMMIT;')){
                $retval = RECOVER_ERR_DB;
            }
        }
    }

    if($retval == RECOVER_ERR_DB || $retval == RECOVER_ERR_DB_C){
        writeLog('../logs/recover.log', '(' . mysqli_errno($feedback_pre['connect'])
                . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);
    }

    return array('recover' => $retval);
}

return TRUE;
