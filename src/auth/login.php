<?php
/**
 * @file src/auth/login.php
 * @brief Main file for the login part of the authentication module
 * @author Paul Barbu
 *
 * @ingroup authFiles
 */

if(isset($_POST['login'])){
    list($nick, $_POST['pass']) = filterInput($_POST['nick'], $_POST['pass']);
    $remember = isset($_POST['remember']) ? TRUE : FALSE;

    if(!$feedback_pre['connect']){
        $retval = L_ERR_DB_CONNECTION;
    }
    else if(isUser($feedback_pre['connect'], $nick) !== MATCHING_NICK){
        $retval = L_ERR_NO_USER;
    }
    else{
        $cols = array('id', 'password AS pass');

        $result = mysqli_query($feedback_pre['connect'], 'SELECT ' . implode(',', $cols)
            . " FROM user WHERE nick = '" . $nick . "';");

        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if(strcmp($data['pass'], sha1($_POST['pass']))){
            unset($_POST['pass'], $data['pass']);

            $retval = L_ERR_PASS;
        }
        else{
            unset($_POST['pass'], $data['pass']);

            session_set_cookie_params(0, app_path());

            if(!session_start()){
                $retval = L_ERR_SESS_START;
            }
            else{
                $_SESSION['uid'] = $data['id'];

                if($remember){
                    setcookie(session_name(), session_id(), time() + 60*60*24*30, app_path());
                }

                $retval = ERR_NONE;
            }
        }
    }

    if($retval == L_ERR_DB_CONNECTION){
        writeLog('../logs/login.log', '(' . mysqli_errno($feedback_pre['connect'])
                 . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);
    }

    return $retval;
}

return TRUE;
