<?php
/**
 * @file src/login/constants.php
 * @brief Constants for the login module
 * @author Paul Barbu
 *
 * @ingroup loginFiles
 */

define('LIFETIME', 60*60*24*30);
define('ONETIME_SESS', 1440);

const L_ERR_DB_CONNECTION = 1;
const L_ERR_NO_USER = 2;
const L_ERR_PASS = 3;
const L_ERR_SESS_START = 4;
const L_ERR_INACTIVE = 5;
const L_ERR_DB = 6;
