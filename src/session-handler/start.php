<?php
/**
 * @file src/session-handler/start.php
 * @brief Start a session
 * @author Paul Barbu
 *
 * @ingroup sessFiles
 */

/**
 * @defgroup sessFiles Session handler module
 */

if(!isset($_SESSION)){
    session_set_cookie_params(0, app_path());
    session_start();
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
