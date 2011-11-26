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

if(isset($_COOKIE['PHPSESSID'])){
    session_set_cookie_params(0, app_path());
    session_id($_COOKIE['PHPSESSID']);
    session_start();
}
