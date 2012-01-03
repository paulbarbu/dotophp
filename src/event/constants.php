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
