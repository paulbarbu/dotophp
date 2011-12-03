<?php
/**
 * @file src/logout/content_logout.php
 * @brief HTML for the logout part of the logoutentication module
 * @author Paul Barbu
 *
 * @ingroup logoutFiles
 */

if($feedback['logout'] == ERR_NONE){
   echo '<h3>You\'ve been logged out!<h3>';
}
else{
    echo '<h3>';

    switch($feedback['logout']){
        case LO_ERR_DEL: printf('Could not delete the session! (#%d)', LO_ERR_DEL);
            break;
        case LO_ERR_DESTROY: printf('Could not destroy the session! (#%d)', LO_ERR_DESTROY);
            break;
    }

    echo '</h3>';
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
