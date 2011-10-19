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
 * Compare the user's activation code with the activation codes in the DB
 *
 * This function could be considered as a validation function too, if NULL is
 * returned then the code is invalid
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $acode user supplied activation code
 *
 * @return the user's ID(integer) to whom the code matches, else, NULL
 */
function getUserIDByACode($link, $acode){
    $query = "SELECT user_id AS id FROM pending WHERE code = '";

    $result = mysqli_query($link, $query . $acode . "';");

    list($id) = mysqli_fetch_array($result, MYSQLI_NUM);

    return $id != NULL ? (int)$id : NULL;
}


//TODO: activation date
