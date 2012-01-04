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

/**
 * Default color to be used for events and categories
 * Maybe you want to match this with the background
 */
const DEFAULT_COLOR = '#FFFFFF';

/**
 * Email tooltip
 */
const TOOLTIP_EMAIL = 'Only alphanumeric and _ - @ . characters allowed!';
/**
 * Answer help
 */
const TOOLTIP_H_ANSWER = 'The answer you provided upon registration!';
/**
 * Name toolip
 */
const TOOLTIP_NAME = 'No longer than 20 chars, characters allowed: - _ and lower/upper case unicode letters, decimal numbers!';
/**
 * Nick toolip
 */
const TOOLTIP_NICK_CAT_EV = 'No longer than 20 chars, alphanumeric characters allowed and - _';
/**
 * City tooltip
 */
const TOOLTIP_CITY = 'No longer than 30 chars, unicode letters allowed!';
/**
 * Phone tooltip
 */
const TOOLTIP_PHONE = 'No longer than 20 chars, letters, parentheses, spaces and dashes allowed!';
/**
 * Description tooltip
 */
const TOOLTIP_DESC = 'Unicode letters, numbers and punctuation allowed, one hundred chars maximum!';

/**
 * DB connection error
 */
const ERR_DB_CONN = -1;

/**
 * DB error
 */
const ERR_DB = -2;

/**
 * Datetime default template
 */
const DATETIME_TOUSER = 'DD-MM-YYYY HH:MM';

/**
 * Tooltip for datetime fields
 */
const TOOLTIP_DATETIME = 'Date and time, must follow the format, day-month-year hours:minutes';

/**
 * Color tooltip
 */
const TOOLTIP_COLOR = 'Hexadecimal, 6 characters, color code';

/**
 * MySQl timestamp format
 */
const MYSQL_TS = 'Y-m-d H:i:s';

/**
 * Default datetime value
 */
const DEFAULT_DATETIME = '00-00-0000 00:00';
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
