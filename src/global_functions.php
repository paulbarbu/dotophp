<?php
/**
 * @file src/global_functions.php
 * @brief Globally used functions
 * @author Paul Barbu
 *
 * @ingroup globalFiles
 */

/**
 * @defgroup globalFiles Global files
 */

/**
 * Filters the user's input(sanitizes it) to avoid building an attack vector
 *
 * This functions accepts a variable number of arguments
 *
 * @return array $filteredInput the sanitized input on the same position in the
 * array as it's place in the args list
 */
function filterInput(){
    //GAP
}

/**
 * Sends an email to a user
 *
 * TODO
 */
function sendMail(){
    //GAP
}

/**
 * Checks the $_POST superglobal array if contains the specified keys
 *
 * You can pass a variable number of strings as arguments
 *
 * @return an array consisting of a BOOL value and a NULL or the error string,
 * array(BOOL, string)
 */
function checkPostKeys(){
    //GAP
}

/**
 * Checks the name according to the name field
 *
 * @param string $name the name to be verified
 *
 * @return BOOL TRUE if the name is valid, else FALSE
 */
function checkName($name){
    //GAP
}

/**
 * Checks whether the given email is valid or not
 *
 * @param string $email string to be checked
 *
 * @return BOOL TRUE if the email is valid, else FALSE
 */
function checkMail($email){
    //GAP
}

/**
 * Checks the validity of a string representing a city
 *
 * @param string $city the string to be checked
 *
 * @return BOOL TRUE if the city is valid, else FALSE
 */
function checkCity($city){
    //GAP
}

/**
 * Checks if a phone number entered as a string is valid
 *
 * @param string $phone the string to be checked
 *
 * @return BOOL TRUE if the phone number is valid, else, FALSE
 */
function checkPhone($phone){
    //GAP
}

/**
 * Checks if a birthdate was enetered in the required format
 *
 * @param string $bdate the string to be checked
 *
 * @return BOOL TRUE if the format is valid, else, FALSE
 */
function checkBDate($bdate){
    //GAP
}

/**
 * Checks if a description is valid
 *
 * @param string $desc the string to be checked
 *
 * @return BOOL TRUE if the description is valid, else, FALSE
 */
function checkDesc($desc){
    //GAP
}
