<?php
/**
 * @file src/login/constants.php
 * @brief Constants for the login module
 * @author Paul Barbu
 *
 * @ingroup loginFiles
 */

/**
 * Lifetime of the cookie
 */
define('LIFETIME', 60*60*24*30);

/**
 * Coudn't establish a connection to the database
 */
const L_ERR_DB_CONNECTION = 1;
/**
 * Invalid username
 */
const L_ERR_NO_USER = 2;
/**
 * Wrong password
 */
const L_ERR_PASS = 3;
/**
 * Coudn't start the session
 */
const L_ERR_SESS_START = 4;
/**
 * Inactive accounts cannot login
 */
const L_ERR_INACTIVE = 5;
const L_ERR_DB = 6;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
