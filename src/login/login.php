<?php
/**
 * @file src/login/login.php
 * @brief Main file for the login part of the login module
 * @author Paul Barbu
 *
 * @ingroup loginFiles
 */

if(isset($_POST['login'])){
    list($nick, $_POST['pass']) = filterInput($_POST['nick'], $_POST['pass']);
    $remember = isset($_POST['remember']) ? TRUE : FALSE;

    /**
     * Session expiry offset from current time
     */
    $expiry_offset = NULL;

    if(!$feedback_pre['connect']){
        $retval = L_ERR_DB_CONNECTION;
    }
    else if(isUser($feedback_pre['connect'], $nick) !== MATCHING_NICK){
        $retval = L_ERR_NO_USER;
    }
    else{
        $cols = array('id', 'password AS pass', 'activated');

        $result = mysqli_query($feedback_pre['connect'], 'SELECT ' . implode(',', $cols)
            . " FROM user WHERE nick = '" . $nick . "';");

        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if(strcmp($data['activated'], '0000-00-00 00:00:00') != 0){
            if(strcmp($data['pass'], sha1($_POST['pass'])) != 0){
                unset($_POST['pass'], $data['pass']);

                $retval = L_ERR_PASS;
            }
            else{
                unset($_POST['pass'], $data['pass']);

                if($remember){
                    session_set_cookie_params(LIFETIME, app_path());
                }
                else{
                    session_set_cookie_params(0, app_path());
                }

                if(isset($_SESSION)){
                    $start = TRUE;
                }
                else{
                    $start = session_start();
                }

                if(!$start){
                    $retval = L_ERR_SESS_START;
                }
                else{
                    $_SESSION['uid'] = $data['id'];

                    if($remember){
                        $expiry_offset = LIFETIME;
                    }
                    else{
                        $expiry_offset = ONETIME_SESS;
                        $_SESSION['one-time'] = TRUE;
                    }

                    $result = session_set_expiry_offset($feedback_pre['connect'],
                                session_id(), $expiry_offset, $data['id']);

                    if(FALSE === $result){
                        $retval = L_ERR_DB ;
                    }
                    else{

                        if($remember){
                            setcookie(session_name(), session_id(), time() + LIFETIME, app_path());
                        }

                        $retval = ERR_NONE;
                    }
                }
            }
        }
        else{
            $retval = L_ERR_INACTIVE;
        }
    }

    if($retval == L_ERR_DB_CONNECTION || $retval == L_ERR_DB){
        writeLog('../logs/login.log', '(' . mysqli_errno($feedback_pre['connect'])
                 . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);
    }

    return $retval;
}

return TRUE;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
