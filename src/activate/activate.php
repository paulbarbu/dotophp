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
    list($code, $_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']) =
        filterInput($_POST['code'], $_POST['pass'], $_POST['passconfirm'],
                    $_POST['security_q'], $_POST['security_a']);

    if(!$feedback_pre['connect']){
        return R_ERR_DB_CONNECTION;
    }

    if(isValidPass($_POST['pass']) && $_POST['pass'] == $_POST['passconfirm']){
        if(isValidSecurityData($_POST['security_q']) && isValidSecurityData($_POST['security_a'])){
            $id = getUserIDByACode($feedback_pre['connect'], $code);

            if($id != NULL){
                if(!mysqli_query($feedback_pre['connect'], 'BEGIN;')){
                    unset($_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']);
                    return A_ERR_DB;
                }

                if(!mysqli_query($feedback_pre['connect'], 'DELETE FROM pending WHERE user_id = ' . $id . ';')){
                    unset($_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']);
                    return A_ERR_DB;
                }

                if(!mysqli_query($feedback_pre['connect'],"UPDATE user SET password = SHA1('" .
                    $_POST['pass'] . "'), security_q = '" . $_POST['security_q'] . "', security_a = '" .
                    $_POST['security_a'] . "', activated = NOW() WHERE id = " . $id . ";"
                )){
                    unset($_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']);
                    return A_ERR_DB;
                }

                if(!mysqli_query($feedback_pre['connect'], 'COMMIT;')){
                    unset($_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']);
                    return R_ERR_DB;
                }

                unset($_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']);
                return ERR_NONE;
            }
            else{
                unset($_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']);
                return A_ERR_CODE;
            }
        }
        else{
            unset($_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']);
            return A_ERR_SECURITY_DATA;
        }
    }
    else{
        unset($_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']);
        return A_ERR_PASS;
    }
}

return TRUE;
