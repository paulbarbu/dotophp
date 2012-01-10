<?php
/**
 * @file src/event/constants.php
 * @brief Manage events content
 * @author Paul Barbu
 *
 * @ingroup eventFiles
 */

/**
 * Repeat list
 */
$REPEATS = array(
    '-1' => 'No repeat',
    '0' => 'Never',
    '1' => 'Daily',
    '2' => 'Weekly',
    '3' => 'Monthly',
    '4' => 'Yearly',
);

/**
 * Priority list
 */
$PRIORITIES = array(
    '0' => 'Low',
    '1' => 'Medium',
    '2' => 'High',
    '3' => 'Urgent',
);

defined('E_ERR_NAME') or define('E_ERR_NAME', 1);
defined('E_ERR_DESC') or define('E_ERR_DESC', 2);
defined('E_ERR_COLOR') or define('E_ERR_COLOR', 3);
defined('E_ERR_DUPLICATE') or define('E_ERR_DUPLICATE', 4);
defined('E_ERR_DATETIME') or define('E_ERR_DATETIME', 5);
defined('E_ERR_INVALID_ENDDATE') or define('E_ERR_INVALID_ENDDATE', 6);
defined('DELETED') or define('DELETED', 7);
defined('DONE') or define('DONE', 8);
defined('MODIFIED') or define('MODIFIED', 9);
defined('ACTION_MODIFY') or define('ACTION_MODIFY', 'modify');
defined('ACTION_ADD') or define('ACTION_ADD', 'add');
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
