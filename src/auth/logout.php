<?php
/**
 * @file src/auth/logout.php
 * @brief Logout part of the auth module
 * @author Paul Barbu
 *
 * @ingroup authFiles
 */

if(isset($_SESSION)){
    if($feedback_pre['connect'] == FALSE){
        writeLog('logout', 'SESSID: ' . session_id() . ' - (' .
            mysqli_connect_errno() . ') ' . mysqli_connect_error()  . PHP_EOL);
    }
    else{
        mysqli_query($feedback_pre['connect'], "DELETE FROM session WHERE id='" . session_id() . "';");
    }

    $_SESSION = array();

    if(ini_get("session.use_cookies")){
        $params = session_get_cookie_params();

        if(!setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'],
                $params['secure'], $params['httponly'])){
            return LO_ERR_DEL;
        }
    }

    if(!session_destroy()){
        return LO_ERR_DESTROY;
    }

    return ERR_NONE;
}
else{
    return LO_ERR_INIT;
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
