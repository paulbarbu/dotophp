<?php
/**
 * @file src/activate/activate.php
 * @brief Main file for activate module
 * @author Paul Barbu
 *
 * @ingroup activateFiles
 */

//TODO: check every 7 days for inactive accounts

//pre and post process modules (mysql connection)
//filter the input if the button is pressed, else return TRUE;
//don't forget to filter what comes from &code=
//if sec_q and sec_a and the password are valid check the activation code
//if Acode is ok, remove the user from 'pending' and add it's details(pass-sha1
//encripted, sec_q, sec_a, activated date) to 'user'

if(isset($_POST['activate'])){
}

return TRUE;
