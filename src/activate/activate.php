<?php
/**
 * @file src/activate/activate.php
 * @brief Main file for activate module
 * @author Paul Barbu
 *
 * @ingroup activateFiles
 */

//TODO: check every 7 days for inactive accounts

if(isset($_POST['activate'])){

    $result = NULL;

    list($code, $_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']) =
        filterInput(isset($_POST['code']) ? $_POST['code'] : $_GET['code'], $_POST['pass'], $_POST['passconfirm'],
                    $_POST['security_q'], $_POST['security_a']);

    if(!$feedback_pre['connect']){
        $result = A_ERR_DB_CONNECTION;
    }
    elseif(isValidPass($_POST['pass']) && $_POST['pass'] == $_POST['passconfirm']){
        if(isValidSecurityData($_POST['security_q']) && isValidSecurityData($_POST['security_a'])){
            $id = getUserIDByACode($feedback_pre['connect'], $code);

            if($id != NULL){
                if(!mysqli_query($feedback_pre['connect'], 'BEGIN;')){
                    $result = A_ERR_DB;
                }
                elseif(!mysqli_query($feedback_pre['connect'], 'DELETE FROM pending WHERE user_id = ' . $id . ';')){
                    $result = A_ERR_DB;
                }
                elseif(!mysqli_query($feedback_pre['connect'],"UPDATE user SET password = SHA1('" .
                    $_POST['pass'] . "'), security_q = '" . $_POST['security_q'] . "', security_a = '" .
                    $_POST['security_a'] . "', activated = NOW() WHERE id = " . $id . ";"
                )){
                    $result = A_ERR_DB;
                }
                elseif(!mysqli_query($feedback_pre['connect'], 'COMMIT;')){
                    $result = A_ERR_DB;
                }
                else{
                    $result = ERR_NONE;
                }
            }
            else{
                $result = A_ERR_CODE;
            }
        }
        else{
            $result = A_ERR_SECURITY_DATA;
        }
    }
    else{
        $result = A_ERR_PASS;
    }

    unset($_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']);
    return $result;
}

return TRUE;
