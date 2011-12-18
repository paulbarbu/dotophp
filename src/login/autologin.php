<?php
/**
 * @file src/login/autologin.php
 * @brief Autologin functionality
 * @author Paul Barbu
 *
 * @ingroup loginFiles
 */

/**
 * @defgroup loginFiles Login module
 */

if(isset($_COOKIE[session_name()])){
    if($result['connect']){
        $sessions = mysqli_query($result['connect'],
            "SELECT * FROM session WHERE id='" . $_COOKIE[session_name()] . "';");

        if(1 == mysqli_num_rows($sessions)){
            session_set_cookie_params(0, app_path());
            session_start();

            if(isset($_SESSION['one-time']) && $_SESSION['one-time'] == TRUE){
                $updated = session_set_expiry_offset($result['connect'], session_id(), ONETIME_SESS, $_SESSION['uid']);

                if(!$updated){
                writeLog('../logs/autologin.log', 'Connection error: ('
                    . mysqli_errno($result['connect']) . ') ' . mysqli_error($result['connect']) . PHP_EOL);
                }
            }
        }
    }
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
