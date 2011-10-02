<?php
/**
 * @file src/register/functions.php
 * @brief Regstration functions
 * @author Paul Barbu
 *
 * @ingroup registerFiles
 */

/**
 * @defgroup registerFiles Register module
 */

/**
 * Add a new user into the database
 *
 * @param mysqli a link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $first_name user's first name
 * @param string $last_name user's last name
 * @param string $description user's description
 * @param string $nickname
 * @param string $email
 * @param BOOL $private private or public account
 * @param string $tz timezone set by user
 * @param string $country
 * @param string $city
 * @param string $phone user's phone number
 * @param int $birthday unix timestamp
 * @param string $sex 'M' or 'F'
 *
 * @return an array consisting of a BOOL value and a NULL or the error string,
 * array(BOOL, string)
 */
function addUser($link, $first_name, $last_name, $nickname, $email, $private, $tz,
    $country, $city, $sex, $description = NULL, $phone = NULL, $birthday = NULL
    ){
    //TODO: created date, document error strings
    $query = 'INSERT INTO user (first_name, last_name, nick, email,
        tz, country, city, private, sex, description, phone, birthday) VALUES(';

    $values = array();

    if(isValidName($first_name) && isValidName($last_name)){
        $values[] = "'" . $first_name . "'";
        $values[] = "'" . $last_name . "'";
    }
    else{
        return array(FALSE, 'ERR_NAME');
    }

    if(isValidNick($nickname)){
        $values[] = "'" . $nickname . "'";
    }
    else{
        return array(FALSE, 'ERR_NICK');
    }

    if(isValidMail($email)){
        $values[] = "'" . $email . "'";
    }
    else{
        return array(FALSE, 'ERR_EMAIL');
    }

    $values[] = "'" . $tz . "'";
    $values[] = "'" . $country . "'";

    if(isValidCity($city)){
        $values[] = "'" . $city . "'";
    }
    else{
        return array(FALSE, 'ERR_CITY');
    }

    $values[] = $private;
    $values[] = "'" . $sex . "'";

    if($description){
        if(isValidDesc($description)){
            $values[] = "'" . $description . "'";
        }
        else{
            return array(FALSE, 'ERR_DESC');
        }
    }
    else{
        $values[] = 'NULL';
    }

    if($phone){
        if(isValidPhone($phone)){
            $values[] = "'" . $phone . "'";
        }
        else{
            return array(FALSE, 'ERR_PHONE');
        }
    }
    else{
        $values[] = 'NULL';
    }

    if($birthday){
        if(isValidBDate($birthday)){
            $values[] = "'" . $birthday . "'";
        }
        else{
            return array(FALSE, 'ERR_BDAY');
        }
    }
    else{
        $values[] = 'NULL';
    }

    $result = mysqli_query($link, $query . implode(',', $values) . ');');

    if(!$result){
        return array(FALSE, mysqli_error($link));
    }

    return array(TRUE, NULL);

}
