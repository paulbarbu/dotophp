<?php
/**
 * @file src/auth/auth.php
 * @brief Main file for the authentication module
 * @author Paul Barbu
 *
 * @ingroup authFiles
 */

$result = NULL;

if(isset($_GET['action']) && 'logout' == $_GET['action']){
    $result = require 'logout.php';
}
else{
    $result = require 'login.php';
}

return $result;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
