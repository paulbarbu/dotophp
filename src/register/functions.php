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
 * Check the data received upon submitting the registration form
 *
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
 * @return a dictionary containing meta-data in association with the user's data
 * or an array containing FALSE and the error code, array(FALSE, int)
 */
function validateUserData($first_name, $last_name, $nickname, $email, $private, $tz,
    $country, $city, $sex, $description = NULL, $phone = NULL, $birthday = NULL
    ){

    $values = array();

    if(isValidName($first_name) && isValidName($last_name)){
        $values['first_name'] = $first_name;
        $values['last_name'] = $last_name;
    }
    else{
        return array(FALSE, R_ERR_NAME);
    }

    if(isValidNick($nickname)){
        $values['nick'] = $nickname;
    }
    else{
        return array(FALSE, R_ERR_NICK);
    }

    if(isValidMail($email)){
        $values['email'] = $email;
    }
    else{
        return array(FALSE, R_ERR_EMAIL);
    }

    if($tz != 'Please select your timezone!'){
        $values['tz'] = $tz;
    }
    else{
        return array(FALSE, R_ERR_TZ);
    }

    if($country != 'Please select your country!'){
        $values['country'] = $country;
    }
    else{
        return array(FALSE, R_ERR_COUNTRY);
    }

    if(isValidCity($city)){
        $values['city'] = $city;
    }
    else{
        return array(FALSE, R_ERR_CITY);
    }

    $values['private'] = $private;
    $values['sex'] = $sex;

    if($description){
        if(isValidDesc($description)){
            $values['description'] = $description;
        }
        else{
            return array(FALSE, R_ERR_DESC);
        }
    }
    else{
        $values['description'] = 'NULL';
    }

    if($phone){
        if(isValidPhone($phone)){
            $values['phone'] = $phone;
        }
        else{
            return array(FALSE, R_ERR_PHONE);
        }
    }
    else{
        $values['phone'] = 'NULL';
    }

    if($birthday && $birthday != 'DD-MM-YYYY'){
        if(isValidBDate($birthday)){
            $values['birthday'] = $birthday;
        }
        else{
            return array(FALSE, R_ERR_BDATE);
        }
    }
    else{
        $values['birthday'] = 'NULL';
    }

    return $values;
}
