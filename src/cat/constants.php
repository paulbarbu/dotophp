<?php
/**
 * @file src/category/category.php
 * @brief Category's constants
 * @author Paul Barbu
 *
 * @ingroup catFiles
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

defined('C_ERR_NAME') or define('C_ERR_NAME', 1);
defined('C_ERR_DESC') or define('C_ERR_DESC', 2);
defined('C_ERR_COLOR') or define('C_ERR_COLOR', 3);
defined('C_ERR_DUPLICATE') or define('C_ERR_DUPLICATE', 4);
defined('DELETED') or define('DELETED', 5);
