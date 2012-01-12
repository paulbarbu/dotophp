<?php
/**
 * @file src/index.php
 * @brief Index file
 * @author Paul Barbu
 *
 * @ingroup globalFiles
 *
 * Every custom thing must be overwritten here in order to be recognized by
 * yaCMS
 */

/**
 * Path to the yaCMS, the "backend" of this project
 */
define('YACMS_PATH', '');

if(!defined('YACMS_PATH') || NULL == YACMS_PATH){
    die('YACMS not installed');
}

defined('MODULES_ROOT') or define('MODULES_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
defined('LAYOUT_PATH') or define('LAYOUT_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'layout.php');

require_once MODULES_ROOT . 'global_functions.php';
require_once MODULES_ROOT . 'global_constants.php';

/**
 * The module list
 */
$modules = require MODULES_ROOT . 'modules.php';


/**
 * Configuration directives
 */
//$config = require MODULES_ROOT . 'config.php';

require_once YACMS_PATH . 'index.php';
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
