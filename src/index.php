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


if(!defined('YACMS_PATH')) {
    die('YACMS not installed');
}
defined('MODULES_ROOT') or define('MODULES_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
defined('LAYOUT_PATH') or define('LAYOUT_PATH', __DIR__ . 'layout.php');

require_once MODULES_ROOT . 'global_functions.php';
$modules = require MODULES_ROOT . 'modules.php';
require_once YACMS_PATH . 'index.php';
