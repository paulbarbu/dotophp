<?php
/**
 * @file src/recover/recover.php
 * @brief Main recover module file
 * @author Paul Barbu
 *
 * @ingroup recoverFiles
 */

if(isset($_POST['proceed'])){
    list($email) = filterInput($_POST['email']);

    //if i find this email, if the account is activated, proceed to displaying
    //the security question

    if(isUser($feedback_pre['connect'], NULL, $email) !== MATCHING_MAIL){
        return RECOVER_ERR_NOUSER;
    }

    $result = mysqli_query($feedback_pre['connect'],
        "SELECT id, activated, security_q, security_a FROM user WHERE email = '"
        . $email . "';");

    $data = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($data['activated'] == "0000-00-00 00:00:00"){
        return RECOVER_ERR_INACTIVE;
    }

    $_SESSION['security_q'] = $data['security_q'];
    $_SESSION['security_a'] = $data['security_a'];
    $_SESSION['id'] = $data['id'];

    return RECOVER_PROCESSED;
}
elseif(isset($_POST['recover'])){
    list($answer) = filterInput($_POST['security_a']);

    if(!(isValidSecurityData($answer) &&
         strcmp($answer, $_SESSION['security_a']) == 0)){
        return array('recover' => RECOVER_ERR_ANSWER);
    }

    //continue here
    ////think about transactions

}
//else if the security answer has been submitted, check it and recover the
//account

return TRUE;
