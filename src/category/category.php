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
            $data['color'] = str_replace('#', '', $color);
        }
    }

    if(!empty($err)){
        return $err;
    }

    if(!$feedback_pre['connect']){
        $retval = C_ERR_DB_CONN;
    }
    else{
        $result = mysqli_query($feedback_pre['connect'],
                'SELECT category_id FROM category WHERE user_id=' . $_SESSION['uid'] .
                " AND name='" . $name . "';");

        if(!$result){
            $retval = C_ERR_DB;
        }
        else{
            $duplicates = count(mysqli_fetch_all($result, MYSQLI_ASSOC));

            if(!$duplicates){
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
            else{
                $retval = C_ERR_DUPLICATE;
            }
        }
    }

    if(C_RRR_DB == $retval || C_ERR_DB_CONN == $retval){
        writeLog($config['logger']['category'], '(' . mysqli_errno($feedback_pre['connect'])
                 . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);
    }

    return $retval;
}

return TRUE;
