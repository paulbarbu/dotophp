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
 * This function accepts a variable number of arguments
 *
 * @return array $filteredInput the sanitized input on the same position in the
 * array as it's place in the args list
 */
function filterInput(){/*{{{*/
    $filteredInput = array();
    $args = func_get_args();

    foreach($args as $text){
        $filteredInput[] = strip_tags($text);
    }

    return $filteredInput;
}/*}}}*/

/**
 * Generate the activation code
 *
 * Needed by the user on registration or account recovery
 *
 * @param string $nick user's nickname
 *
 * @return string activation code
 */
function genActivationCode($nick){/*{{{*/

    return implode('', array_slice(str_split(sha1($nick . time())), 0, 10));
}/*}}}*/

/**
 * Tells whether the given array contain the specified keys
 *
 * You can pass a variable number of strings as arguments
 *
 * @param array $arr the array to be checked(can be a superglobal too)
 *
 * @return an array consisting of a BOOL value and a NULL or the error string,
 * array(BOOL, string)
 */
function containsKeys($arr){/*{{{*/

    $keys = array_slice(func_get_args(), 1);

    foreach($keys as $key){
        if(!array_key_exists($key, $arr)){
            return array(FALSE, $key . " does not exists in " . $arr);
        }
    }

    return array(TRUE, NULL);
}/*}}}*/

/**
 * Checks if the name is valid according to the name field
 *
 * @param string $name the name to be verified
 *
 * @return BOOL TRUE if the name is valid, else FALSE
 */
function isValidName($name){/*{{{*/
    return (strlen($name) <= 20 && preg_match("/^[\p{Ll}\p{Lu}][\p{Ll}\p{Lu}\p{Nd}_-]*$/u", $name));
}/*}}}*/

/**
 * Checks if a given nickname is valid(according to the domain fileds)
 *
 * @param string $nick the nickname to be checked
 *
 * @return BOOL TRUE if the nickname is valid, else FALSE
 */
function isValidNick($nick){/*{{{*/
    return (strlen($nick) <= 20 && preg_match("/^[a-z][a-z0-9_-]*$/", $nick));
}/*}}}*/

/**
 * Checks whether the given email is valid or not
 *
 * @param string $email string to be checked
 *
 * @return BOOL TRUE if the email is valid, else FALSE
 */
function isValidMail($email){/*{{{*/
    //thanks to: http://www.regular-expressions.info/email.html
    return (bool)preg_match("/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/", $email);
}/*}}}*/

/**
 * Checks the validity of a string representing a city
 *
 * @param string $city the string to be checked
 *
 * @return BOOL TRUE if the city is valid, else FALSE
 */
function isValidCity($city){/*{{{*/
    return (strlen($city) <= 30 && preg_match("/^[\p{Lu}\p{Ll}\s]+$/u", $city));
}/*}}}*/

/**
 * Checks if a phone number entered as a string is valid
 *
 * @param string $phone the string to be checked
 *
 * @return BOOL TRUE if the phone number is valid, else, FALSE
 */
function isValidPhone($phone){/*{{{*/
    return (strlen($phone) <= 20 && preg_match("/^[0-9()-\s\/]+$/", $phone));
}/*}}}*/

/**
 * Checks if a birthdate was entered in the required format
 *
 * @param string $bdate the string to be checked
 *
 * @return BOOL TRUE if the format is valid, else, FALSE
 */
function isValidBDate($bdate){/*{{{*/
    return (10 == strlen($bdate) && preg_match('/\d{2}-\d{2}-\d{4}/', $bdate));
}/*}}}*/

/**
 * Checks if a description is valid
 *
 * @param string $desc the string to be checked
 *
 * @return BOOL TRUE if the description is valid, else, FALSE
 */
function isValidDesc($desc){/*{{{*/
    return (strlen($desc) <= 100 && preg_match("/^[\p{Ll}\p{Lu}\p{Nd}\p{Po}\p{Ps}\p{Pe}\p{Sm}\p{Pd}\s\$\^]+$/u", $desc));
}/*}}}*/

/**
 * Check if the captcha code entered matches the generated one
 *
 * @param string $captcha the genereated captcha code
 * @param string $captcha_input the code user entered
 *
 * @return BOOL TRUE if the two string match, else, FALSE
 */
function isValidCaptcha($captcha, $captcha_input){/*{{{*/
    return strtolower($captcha_input) == $captcha;
}/*}}}*/

/**
 * Check the security data (question and answer)
 *
 * @param string $data the question or the answer to be checked
 *
 * @return BOOL TRUE if the data is valid, else FALSE
 */
function isValidSecurityData($data){/*{{{*/
    $len = strlen($data);

    return ($len >= 8 && $len <= 255 && preg_match('/^[\s\p{Ll}\p{Lu}\p{Po}\p{Nd}]+$/u', $data));
}/*}}}*/

/**
 * Query the DB to check if the email and/or nickname are supplied correctly
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $nickname user's nickname
 * @param string $email user's email
 *
 * @return MATCHING_NICK if the user's nick is found in the DB, MATCHING_MAIL if the email
 * is found, else(the nick and the email are not found) NO_MATCH
 */
function isUser($link, $nickname = NULL, $email = NULL){/*{{{*/
    $query = 'SELECT nick, email FROM user WHERE ';
    $query_conditions = array();

    if(isValidNick($nickname)){
        $query_conditions[] = "nick = '" . $nickname . "'";
    }


    if(isValidMail($email)){
        $query_conditions[] = "email = '" . $email . "'";
    }

    if(empty($query_conditions)){
        return FALSE;
    }

    $result = mysqli_query($link, $query . implode(" OR ", $query_conditions));

    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(empty($user)){
        return NO_MATCH;
    }

    foreach($user as $candidate){
        if($candidate['nick'] == $nickname){
            return MATCHING_NICK;
        }
        elseif($candidate['email'] == $email){
            return MATCHING_MAIL;
        }
    }
}/*}}}*/

/**
 * Add the newly created user to the pending table
 *
 * This function and the one that adds the user must be used in a MySQL
 * transaction to avoid user ID's mismatching.
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $code generated activation code
 *
 * @return BOOL TRUE on success, else FALSE
 */
function addPendingUser($link, $code){/*{{{*/
    $query = "INSERT INTO pending (user_id, code) VALUES(LAST_INSERT_ID(), '";

    $result = mysqli_query($link, $query . $code . "');");

    if(!$result){
        return FALSE;
    }

    return TRUE;
}/*}}}*/

/**
 * Get the state of an user
 *
 * @return TRUE if the user is logged in, else FALSE
 */
function isLoggedIn(){/*{{{*/
    if(isset($_SESSION['uid'])){
        return TRUE;
    }

    return FALSE;
}/*}}}*/

/**
 * Function to name the printf specifiers
 *
 * Credits: http://stackoverflow.com/questions/7435233/name-php-specifiers-in-printf-strings/7435397#7435397
 * Usage:
 @code
 $foo = array('age' => 5, 'name' => 'john');
 echo vsprintf_named("%(name)s is %(age)02d", $foo);
 @endcode
 *
 * @param string $format the format of the resulting string
 * @param array $args the array containing the specifiers as keys and the values
 * the specifiers will be replaced with
 *
 * @return the string to be sent as output(e.g. echo)
 */
function vsprintf_named($format, $args) {/*{{{*/
    $names = preg_match_all('/%\((.*?)\)/', $format, $matches, PREG_SET_ORDER);

    $values = array();
    foreach($matches as $match) {
        $values[] = $args[$match[1]];
    }

    $format = preg_replace('/%\((.*?)\)/', '%', $format);

    return vsprintf($format, $values);
}/*}}}*/

/**
 * Display array contents as HTML @code<option></option>@endcode
 *
 * Helper function
 *
 * @param array $text the text to be written
 * @param mixed $values the values to assign the options
 * @param string $selectedValue (default: NULL) which element(matching the value) to be selected in the
 * options list, if NULL none will be selected
 * @param string $template template for the HTML @code<option>@endcode tag
 * @param string $selected_template template for the HTML selected @code<option>@endcode tag
 *
 * @return BOOL TRUE on success, else, FALSE
 */
function arrayToOption($text, $values, $selectedValue = NULL, $template='<option value="%(value)s">%(text)s</option>',/*{{{*/
                       $selected_template='<option value="%(value)s" selected="selected" >%(text)s</option>'){
    if(is_array($values) && is_array($text)){

        $text_count = count($text);
        if($text_count == count($values)){
            for($i=0; $i<$text_count; $i++){
                if($selectedValue == $values[$i]){
                    echo vsprintf_named($selected_template, array('text' => $text[$i],
                        'value' => $values[$i])) , PHP_EOL;
                }
                else{
                    echo vsprintf_named($template, array('text' => $text[$i],
                        'value' => $values[$i])) , PHP_EOL;
                }
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
}/*}}}*/

/**
 * Create(or open) a log file and write(or append) a message
 *
 * A log file must have the 'log' extension
 * In front of every message the date will be appended.
 *
 * @param string $path path to the file to be written (relative to MODULES_ROOT)
 * @param mixed $data the exact message to be written (no new lines are added
 * automatically)
 *
 * @return TRUE if the operation has succedded, else FALSE
 */
function writeLog($path, $data){/*{{{*/

    $path .= strpos($path, '.log') !== strlen($path)-4 ? '.log' : NULL;

    return error_log(date(DATE_FORMAT) . ' - ' . $data, 3, $path);
}/*}}}*/

/**
 * Creates a query and inserts data into a database
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $table the name of the table where the insert must be made
 * @param array $data associative array, the keys will be used for the column
 * names and the values will be used in VALUES()
 *
 * @return TRUE is the insert was made successfully, else FALSE
 */
function insertIntoDB($link, $table, $data){/*{{{*/
    $result = mysqli_query($link, 'INSERT INTO ' . $table . '(' . implode(',',
                array_keys($data)) . ') VALUES(\'' . implode("', '", $data) . '\');');

    if(!$result){
        return FALSE;
    }

    return TRUE;
}/*}}}*/

/**
 * Check if the user has created any events
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 * @param int $id user's id
 *
 * @return TRUE if the user has events, else FALSE
 */
function hasEvents($link, $id){/*{{{*/
    $result = mysqli_query($link, "SELECT event_id FROM category LEFT JOIN event USING(category_id) WHERE user_id='" .
                           $id . "';");

    $events = count(mysqli_fetch_array($result, MYSQLI_NUM));

    if($events > 0){
        return TRUE;
    }

    return FALSE;
}/*}}}*/

/**
 * Insert or update a session's expiry timestamp
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $sessid the session's id to be inserted or updated
 * @param int $offset number of seconds starting from now until the session
 * expires
 * @param int $userid user's ID that started the session
 *
 * @return TRUE if the insert succeeded else FALSE
 */
function session_set_expiry_offset($link, $sessid, $offset, $userid){/*{{{*/
    $result = mysqli_query($link, "REPLACE INTO session(id,user_id, expiry_ts) VALUES('"
        . $sessid . "'," . $userid . ", DATE_ADD(CURRENT_TIMESTAMP, INTERVAL "
        . $offset . ' SECOND))');

    return $result;
}/*}}}*/

/**
 * Clean up the expired sessions in the DB
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 *
 * @return number of cleaned sessions or FALSE on error
 */
function clean_expired_sess($link){/*{{{*/
    return mysqli_query($link, "DELETE FROM session WHERE expiry_ts < CURRENT_TIMESTAMP;");
}/*}}}*/

/**
 * Searches recursively a directory the files which match a name
 *
 * @param string $path path to a directory
 * @param string $name file's name to be matched, using glob matching
 * @param bool $recursive searches recursively when TRUE
 * @param int $flags flags used by php glob(), see: http://php.net/glob
 * default: GLOB_MARK
 *
 * @return array $files containing the path to the matching files
 */
function find_files_by_name($path, $name, $recursive = TRUE, $flags = GLOB_MARK){/*{{{*/
    $files = array();

    if(DIRECTORY_SEPARATOR != substr($path, -1)){
        $path .= DIRECTORY_SEPARATOR;
    }

    if(is_dir($path)){
        $d = opendir($path);

        $f = glob($path . $name, $flags);

        if($f !== FALSE){
            foreach($f as $file){
                if(DIRECTORY_SEPARATOR != $file[strlen($file)-1]){
                    $files[] = $file;
                }
            }
        }

        while($entry = readdir($d)){
            if('.' != $entry && '..' != $entry){

                if(is_dir($path . $entry) && $recursive){
                    $files =  array_unique(array_merge(find_files_by_name(
                        $path . $entry, $name, $recursive, $flags), $files));
                }
            }
        }

        closedir($d);
    }

    return $files;
}/*}}}*/

/**
 * Check whether a color is in #RRGGBB format
 *
 * @param $color the color code
 *
 * @return TRUE if the code is valid, else FALSE
 */
function isValidColor($color){/*{{{*/
    return (bool)preg_match('/^#[a-f0-9]{6}$/i', $color);
}/*}}}*/

/**
 * Helper function to echo divs from an array
 *
 * @param array $data the data to be displayed as divs
 * @param callback $format a callback to format the contents of the div,
 * optional, if not provided the elements will be displayed as text, the
 * callback must accept as argument the contents of an element in $data and to
 * return a string
 * @param string $class div's class, optional
 * @param string $id div's id, optional
 *
 * @return void
 */
function arrayToDiv($data, $format = NULL, $id = NULL, $class = NULL, $style = NULL){/*{{{*/
    $start_str = '<div';

    if(isset($id)){
        $start_str .= ' id="' . $id . '"';
    }

    if(isset($class)){
        $start_str .= ' class="' . $class . '"';
    }

    if(isset($style)){
        $start_str .= ' style="' . $style . '"';
    }

    $start_str .= '>' . PHP_EOL;

    $end_str = '</div>' . PHP_EOL;

    foreach($data as $meta => $element){
        echo $start_str;

        if(isset($format)){
            echo $format($element);
        }
        else{
            echo $element;
        }

        echo $end_str;
    }
}/*}}}*/
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
