<?php
/**
 * @file src/global_constants.php
 * @brief Globally used constants
 * @author Paul Barbu
 *
 * @ingroup globalFiles
 */

/**
 * The module finished with no errors
 */
const ERR_NONE = 0;
/**
 * No match, returned by isUser()
 */
const NO_MATCH = 0;
/**
 * The user's nick match with one already in the DB
 */
const MATCHING_NICK = 1;
/**
 * The user's mail match with one already in the DB
 */
const MATCHING_MAIL = 2;
/**
 * Globally used date format
 */
const DATE_FORMAT = 'd.m.Y H:i:s';
/**
 * Date format shown in form toi the user
 * Change this according to the above DATE_FORMAT
 */
const DATE_TOUSER = 'DD-MM-YYYY';
/**
 * Time an one-time session is valid
 */
const ONETIME_SESS = 1440;

/**
 * Color code template
 */
const COLOR_CODE = '#RRGGBB';

/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
