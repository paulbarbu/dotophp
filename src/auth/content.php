<?php
/**
 * @file src/auth/content.php
 * @brief HTML for the autentication module
 * @author Paul Barbu
 *
 * @ingroup authFiles
 */

if(isset($_GET['action']) && 'logout' == $_GET['action']){
    require 'content_logout.php';
}
else{
    require 'content_login.php';
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
