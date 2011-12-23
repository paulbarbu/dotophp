<?php
/**
 * @file src/auth/content_logout.php
 * @brief HTML for the logout part of the autentication module
 * @author Paul Barbu
 *
 * @ingroup authFiles
 */

if($feedback['auth'] == ERR_NONE){
   echo '<h3>You\'ve been logged out!<h3>';
}
else{
    echo '<h3>';

    switch($feedback['auth']){
        case LO_ERR_DEL: printf('Could not delete the session! (#%d)', LO_ERR_DEL);
            break;
        case LO_ERR_DESTROY: printf('Could not destroy the session! (#%d)', LO_ERR_DESTROY);
            break;
        case LO_ERR_INIT: printf('Could not initialize the session! (#%d)', LO_ERR_INIT);
            break;
    }

    echo '</h3>';
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
