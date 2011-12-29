<?php
/**
 * @file src/auth/autologin.php
 * @brief Autologin functionality
 * @author Paul Barbu
 *
 * @ingroup authFiles
 */

/**
 * @defgroup authFiles Authentication module
 */

$loggedin = FALSE;

if(isset($_COOKIE[session_name()])){
    if($result['connect']){
        $sessions = mysqli_query($result['connect'],
            "SELECT * FROM session WHERE id='" . $_COOKIE[session_name()] . "';");

        if(1 == mysqli_num_rows($sessions)){
            session_set_cookie_params(0, app_path());
            session_start();

            $loggedin = TRUE;

            if('auth' == $module){
                $_GET['action'] = 'logout';
            }

            if(isset($_SESSION['one-time']) && $_SESSION['one-time'] == TRUE){
                $updated = session_set_expiry_offset($result['connect'], session_id(), ONETIME_SESS, $_SESSION['uid']);

                if(!$updated){
                    $config = require MODULES_ROOT . 'config.php';

                    writeLog($config['logger']['autologin'], 'Connection error: ('
                        . mysqli_errno($result['connect']) . ') ' . mysqli_error($result['connect']) . PHP_EOL);
                }
            }
        }
    }
}

if(!$loggedin && (isset($modules[$module]['VL']['login_need']) && $modules[$module]['VL']['login_need'] ||
    ('auth' == $module && isset($_GET['action']) && 'logout' == $_GET['action']))){
    $_GET['action'] = 'login';

    return array('reload' => TRUE, 'module' => 'auth');
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
