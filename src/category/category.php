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
    }
    else{
        $color = str_replace('#', '', DEFAULT_COLOR);
    }

    $data['color'] = base_convert(str_replace('#', '', $color), 16,10);

    if(!empty($err)){
        return $err;
    }

    if(!$feedback_pre['connect']){
        $retval = C_ERR_DB_CONN;
    }
    else{
        $duplicates = count(get_categories($feedback_pre['connect'], $_SESSION['uid'], $name));

        if($duplicates){
            $retval = C_ERR_DUPLICATE;
        }
        else{
            $data['user_id'] = $_SESSION['uid'];
            $data['name'] = $name;
            $data['repeat_interval'] = $repeat;

            if(insertIntoDB($feedback_pre['connect'], 'category', $data)){
                $retval = ERR_NONE;
            }
            else{
                $retval = C_ERR_DB;
            }
        }
    }

    if(C_ERR_DB == $retval || C_ERR_DB_CONN == $retval){
        writeLog($config['logger']['category'], '(' . mysqli_errno($feedback_pre['connect'])
                 . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);
    }

    return $retval;
}

return TRUE;
