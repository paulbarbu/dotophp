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

    list($name, $description, $color, $repeat) = filterInput($_POST['name'],
        $_POST['description'], $_POST['color'], $_POST['repeat']);

    if(empty($name)){
        $err[] = C_ERR_NO_NAME;
    }

    if(!isValidDesc($description)){
        $err[] = C_ERR_DESC;
    }

    if(!isValidColor($color)){
        $err[] = C_ERR_COLOR;
    }

    if(!empty($err)){
        return $err;
    }

    //continue here
}
