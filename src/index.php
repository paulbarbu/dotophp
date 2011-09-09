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

define('MODULES_ROOT', '/media/PauLLiK/localhost/github/dotophp/src/');
define('LAYOUT_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'layout.php');

$modules = require '/media/PauLLiK/localhost/github/dotophp/src/modules.php';

include '/media/PauLLiK/localhost/github/dotophp/src/global_functions.php';

include '/media/PauLLiK/localhost/github/yaCMS/src/index.php';

