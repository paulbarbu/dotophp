<?php
/**
 * @file src/activate/activate.php
 * @brief Main file for activate module
 * @author Paul Barbu
 *
 * @ingroup activateFiles
 */
$result = array(
    'activation_code' => isset($_GET['code']) ? _filterVariable($_GET['code']) : NULL,
    'code' => TRUE,
);

if(isset($_POST['activate'])){

    list($activationCode, $pass, $passconfirm, $security_q, $security_a) =
        filterInput(isset($_POST['code']) ? $_POST['code'] : $_GET['code'],
            $_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a']);

    if(!$feedback_pre['connect']){
        $result['code'] = A_ERR_DB_CONNECTION;
    }
    elseif(isValidPass($pass) && $pass == $passconfirm){
        if(isValidSecurityData($security_q) &&
           isValidSecurityData($security_a)){
            $id = getPendingUser($feedback_pre['connect'], $activationCode);

            if($id !== NULL){
                if(!mysqli_query($feedback_pre['connect'], 'BEGIN;')){
                    $result['code'] = A_ERR_DB;
                }
                elseif(!mysqli_query($feedback_pre['connect'],
                       'DELETE FROM pending WHERE user_id = ' . $id . ';')){
                    $result['code'] = A_ERR_DB;
                }
                elseif(!mysqli_query($feedback_pre['connect'],"UPDATE user SET password = SHA1('" .
                    $pass . "'), security_q = '" . $security_q . "', security_a = '" .
                    $security_a . "', activated = NOW() WHERE id = " . $id . ";"
                )){
                    $result['code'] = A_ERR_DB;
                }
                elseif(!mysqli_query($feedback_pre['connect'], 'COMMIT;')){
                    $result['code'] = A_ERR_DB;
                }
                else{
                    $result['code'] = ERR_NONE;
                }
            }
            else{
                $result['code'] = A_ERR_CODE;
            }
        }
        else{
            $result['code'] = A_ERR_SECURITY_DATA;
        }
    }
    else{
        $result['code'] = A_ERR_PASS;
    }

    unset($_POST['pass'], $_POST['passconfirm'], $_POST['security_q'], $_POST['security_a'],
            $pass, $passconfirm, $security_q, $security_a);

    if(A_ERR_DB == $result['code']){
        writeLog('activate', '(' . mysqli_errno($feedback_pre['connect'])
                 . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);
        mysqli_query($feedback_pre['connect'], 'ROLLBACK;');
    }
    else if(A_ERR_DB_CONNECTION == $result['code']){
        writeLog('activate', '(' . mysqli_connect_errno() . ') ' .
            mysqli_connect_error() . PHP_EOL);
    }
}

return $result;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
