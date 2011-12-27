<?php
/**
 * @file src/config.php
 * @brief Configuration file
 * @author Paul Barbu
 *
 * @ingroup globalFiles
 */

defined('LOG_DIR') or define('LOG_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..' .
                        DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR);

return array(
    'logger' => array(
        'sess_cleanup' => LOG_DIR . 'sess_cleanup.log',
        'expired' => LOG_DIR . 'expired.log',
        'activate' => LOG_DIR . 'activate.log',
        'autologin' => LOG_DIR . 'autologin.log',
        'login' => LOG_DIR . 'login.log',
        'logout' => LOG_DIR . 'logout.log',
        'notreceived' => LOG_DIR . 'notreceived.log',
        'recover' => LOG_DIR . 'recover.log',
        'register' => LOG_DIR . 'register.log',
        'category' => LOG_DIR . 'category.log',
    ),
);
