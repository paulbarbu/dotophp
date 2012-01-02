<?php
/**
 * @file src/auth/constants.php
 * @brief Constants for the authentication module
 * @author Paul Barbu
 *
 * @ingroup authFiles
 */

/**
 * Error deleting the session
 */
const LO_ERR_DEL = 1;
/**
 * Error destroying the session
 */
const LO_ERR_DESTROY = 2;
/**
 * Error starting the session
 */
const LO_ERR_INIT = 3;

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
/**
 * A database related error occured
 */
const L_ERR_DB = 6;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
