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
 * @param string $activationCode user supplied activation code
 *
 * @return the user's ID(integer) to whom the code matches, else, NULL
 */
function getPendingUser($link, $activationCode){
    $query = "SELECT user_id AS id FROM pending WHERE code = '";

    $result = mysqli_query($link, $query . $activationCode . "';");

    list($id) = mysqli_fetch_array($result, MYSQLI_NUM);

    return $id != NULL ? (int)$id : NULL;
}

/**
 * Checks whether the given password matches the requirements
 *
 * @param string $pass the user's password
 *
 * @return BOOL TRUE if the password is ok, else FALSE
 */
function isValidPass($pass){
    $len = strlen($pass);

    return ($len >= 6 && $len <= 30 &&
        preg_match("/^[`_\^\p{Ll}\p{Lu}\p{Nd}\p{Sc}\p{Sm}\p{Pd}\p{Pe}\p{Po}\p{Ps}\p{Zs}]+$/u", $pass));
}

/**
 * Check the security data (question and answer)
 *
 * @param string $data the question or the answer to be checked
 *
 * @return BOOL TRUE if the data is valid, else FALSE
 */
function isValidSecurityData($data){
    $len = strlen($data);

    return ($len >= 8 && $len <= 255 && preg_match('/^[\s\p{Ll}\p{Lu}\p{Po}\p{Nd}]+$/u', $data));
}
