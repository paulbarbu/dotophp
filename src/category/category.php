<?php
/**
 * @file src/category/category.php
 * @brief Category's main file
 * @author Paul Barbu
 *
 * @ingroup catFiles
 */

/**
 * @defgroup catFiles Category module
 */

if(isset($_POST['add'])){
    $err = array();
    $retval = NULL;
    $data = array();

    list($name, $description, $color, $repeat) = filterInput($_POST['name'],
        $_POST['description'], $_POST['color'], $_POST['repeat']);

    if(empty($name) || !isValidNick($name)){
        $err[] = C_ERR_NO_NAME;
    }

    if(!empty($description)){
        if(!isValidDesc($description)){
            $err[] = C_ERR_DESC;
        }
        else{
            $data['description'] = $description;
        }
    }

    if(!empty($color) && COLOR_CODE != $color){
        if(!isValidColor($color)){
            $err[] = C_ERR_COLOR;
        }
        else{
            $data['color'] = $color;
        }
    }

    if(!empty($err)){
        return $err;
    }

    $data['user_id'] = $_SESSION['uid'];
    $data['name'] = $name;
    $data['repeat_interval'] = $repeat;

    if(!$feedback_pre['connect']){
        $retval = C_ERR_DB_CONN;
    }
    else if(insertIntoDB($feedback_pre['connect'], 'category', array())){
        $retval = ERR_NONE;
    }
    else{
        $retval = C_ERR_DB;
    }

    if($retval == C_ERR_DB || $retval == C_ERR_DB_CONN){
        writeLog($config['logger']['category'], '(' . mysqli_errno($feedback_pre['connect'])
                 . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);
    }
}

return TRUE;
