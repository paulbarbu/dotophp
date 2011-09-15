<?php
/**
 * @file src/activate/functions.php
 * @brief Functions for activate module
 * @author Paul Barbu
 *
 * @ingroup activateFiles
 */

/**
 * @defgroup activateFiles Activate files
 */

/**
 * Compare the user's activation code with the activation code in the DB
 *
 * @param mysqli a link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $acode user supplied activation code
 *
 * @return BOOL TRUE if the strings match, else, FALSE
 */
function isValidACode($link, $acode){
    //GAP
}
