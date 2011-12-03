<?php
/**
 * @file src/recover/constants.php
 * @brief Constants for the recover module
 * @author Paul Barbu
 *
 * @ingroup recoverFiles
 */

/**
 * Inexistent user
 */
const RECOVER_ERR_NOUSER = 1;
/**
 * Cannot recover inactive accounts
 */
const RECOVER_ERR_INACTIVE = 2;

/**
 * The request passed the 1st phase
 */
const RECOVER_PROCESSED = 3;

/**
 * Wrong security answer
 */
const RECOVER_ERR_ANSWER = 4;
/**
 * Database error
 */
const RECOVER_ERR_DB = 5;
/**
 * Could not connect the the database
 */
const RECOVER_ERR_DB_C = 6;
/**
 * Failed to send email
 */
const RECOVER_ERR_NOT_SENT = 7;

/**
 * Account recovered
 */
const RECOVERED = 8;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
