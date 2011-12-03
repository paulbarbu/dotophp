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

if(isset($_COOKIE['PHPSESSID'])){
    session_set_cookie_params(0, app_path());
    //session_id($_COOKIE['PHPSESSID']);
    session_start();
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
