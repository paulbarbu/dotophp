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
 * Generate the activation code
 *
 * Needed by the user on registration or account recovery
 *
 * @param string $nick user's nickname
 *
 * @return string activation code
 */
function genACode($nick){
    //GAP
}

/**
 * Tells whether the $_POST or $_GET superglobal arrays contain the specified keys
 *
 * You can pass a variable number of strings as arguments
 *
 * @param array $superglobal the superglobal array $_POST or $_GET to be checked
 *
 * @return an array consisting of a BOOL value and a NULL or the error string,
 * array(BOOL, string)
 */
function containsKeys($superglobal){
    //GAP
}

/**
 * Checks if the name is valid according to the name field
 *
 * @param string $name the name to be verified
 *
 * @return BOOL TRUE if the name is valid, else FALSE
 */
function isValidName($name){
    //GAP
}

/**
 * Checks if a given nickname is valid(according to the domain fileds)
 *
 * @param string $nick the nickname to be checked
 *
 * @return BOOL TRUE if the nickname is valid, else FALSE
 */
function isValidNick($nick){
    //GAP
}

/**
 * Checks whether the given email is valid or not
 *
 * @param string $email string to be checked
 *
 * @return BOOL TRUE if the email is valid, else FALSE
 */
function isValidMail($email){
    //GAP
}

/**
 * Checks the validity of a string representing a city
 *
 * @param string $city the string to be checked
 *
 * @return BOOL TRUE if the city is valid, else FALSE
 */
function isValidCity($city){
    //GAP
}

/**
 * Checks if a phone number entered as a string is valid
 *
 * @param string $phone the string to be checked
 *
 * @return BOOL TRUE if the phone number is valid, else, FALSE
 */
function isValidPhone($phone){
    //GAP
}

/**
 * Checks if a birthdate was enetered in the required format
 *
 * @param string $bdate the string to be checked
 *
 * @return BOOL TRUE if the format is valid, else, FALSE
 */
function isValidBDate($bdate){
    //GAP
}

/**
 * Checks if a description is valid
 *
 * @param string $desc the string to be checked
 *
 * @return BOOL TRUE if the description is valid, else, FALSE
 */
function isValidDesc($desc){
    //GAP
}

/**
 * Check if the captcha code entered matches the generated one
 *
 * @param string $captcha the genereated captcha code
 * @param string $captcha_input the code user entered
 *
 * @return BOOL TRUE if the two string match, else, FALSE
 */
function isValidCaptcha($captcha, $captcha_input){
    //GAP
}

/**
 * Query the DB to check if the email and/or nickname are supplied correctly
 *
 * @param mysqli a link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $nickname user's nickname
 * @param string $email user's email
 *
 * @return BOOL TRUE if the user's credentials are found in the DB, else, FALSE
 */
function isUser($link, $nickname = NULL, $email = NULL){
    //GAP
}

/**
 * Choose a string depending on the state of an user
 *
 * 'OUT' means not-logged in user \n
 * 'IN' means logged in user \n
 * This function should be useed in the configuration file \n
 *
 * @param string $in_str this string will be returned if the user's state is IN
 * @param string $out_str this string will be returned if the user's state is OUT
 *
 * @return string $in_str or $out_str
 */
function getStrByState($in_str, $out_str){
    //GAP
    return $out_file; //random :) - ignore this line
}

/**
 * Helper function
 *
 * Display array contents as HTML <option></option>
 *
 * @param array $text the text to be written
 * @param mixed $values the values to assign the options
 *
 * @return BOOL TRUE on success, else, FALSE
 */
function arrayToOption($text, $values, $template = '<option value="%s">%s</option>'){
    if(is_array($values) && is_array($text)){

        $text_count = count($text);
        if($text_count == count($values)){
            for($i=0; $i<$text_count; $i++){
                printf($template . PHP_EOL, $values[$i], $text[$i]);
            }
        }
        else{
            return FALSE;
        }
    }
    else{
        return FALSE;
    }

    return TRUE;
}
