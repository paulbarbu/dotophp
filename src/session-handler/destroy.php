<?php
/**
 * @file src/session-handler/start.php
 * @brief Start a session
 * @author Paul Barbu
 *
 * @ingroup sessFiles
 */

unset($_SESSION);

if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}

session_destroy();
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
