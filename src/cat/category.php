<?php
/**
 * @file src/cat/category.php
 * @brief Category's main file
 * @author Paul Barbu
 *
 * @ingroup catFiles
 */

/**
 * @defgroup catFiles Category module
 */

$retval = array(
    'name' => isset($_POST['name']) ? $_POST['name'] : NULL,
    'description' => isset($_POST['description']) ? $_POST['description'] : NULL,
    'color' => isset($_POST['color']) ? $_POST['color'] : NULL,
    'repeat' => isset($_POST['repeat']) ? $_POST['repeat'] : NULL,
    'category_id' => isset($_POST['category_id']) ? $_POST['category_id'] : NULL,
    'action' => ACTION_ADD,
    'rcats' => array(
        'name' => array(
            'value' => NULL,
            'cb' => array(
                'filter' => array(
                    'name' => '_filterVariable',
                    'assign' => TRUE,
                    'params' => array('name' => '_getRcatsVal'),
                ),
                'isValid' => array(
                    'name' => 'isValidCatEvName',
                    'params' => array('name' => '_getRcatsVal'),
                ),
            ),
            'err' => C_ERR_NAME,
            'return_on_err' => TRUE,
            'field' => 'name',
        ),
        'description' => array(
            'value' => NULL,
            'cb' => array(
                'filter' => array(
                    'name' => '_filterVariable',
                    'assign' => TRUE,
                    'params' => array('description' => '_getRcatsVal'),
                ),
                'isValid' => array(
                    'name' => 'isValidCatEvDesc',
                    'params' => array('description' => '_getRcatsVal'),
                ),
            ),
            'err' => C_ERR_DESC,
            'return_on_err' => FALSE,
            'field' => 'description',
        ),
        'color' => array(
            'value' => NULL,
            'cb' => array(
                'filter' => array(
                    'name' => '_filterVariable',
                    'assign' => TRUE,
                    'params' => array('color' => '_getRcatsVal'),
                ),
                'isValid' => array(
                    'name' => 'isValidCatEvColor',
                    'params' => array('color' => '_getRcatsVal'),
                ),
                'transform' => array(
                    'assign' => TRUE,
                    'name' => 'colorCodeToInt',
                    'params' => array('color' => '_getRcatsVal'),
                ),
            ),
            'err' => C_ERR_COLOR,
            'return_on_err' => FALSE,
            'field' => 'color',
        ),
        'repeat' => array(
            'value' => NULL,
            'field' => 'repeat_interval',
        ),
        'uid' => array(
            'value' => $_SESSION['uid'],
            'field' => 'user_id',
        ),
        'table' => 'category',
    ),

);

if(isset($_SESSION['modify_list']) && !empty($_SESSION['modify_list'])){
    $retval['action'] = ACTION_MODIFY;

    if(MODIFIED === $feedback_pre['rcats']){
        array_shift($_SESSION['modify_list']);

        if(empty($_SESSION['modify_list'])){
            $retval['action'] = ACTION_ADD;
            unset($retval['category_id']);
        }
        else{
            $continue = TRUE;
        }
    }
}

if(isset($_POST['add'])){
    assignRcatsVals($retval, $_POST['name'], $_POST['description'], $_POST['color'],
        $_POST['repeat'], TRUE, 'cat');


    $retval['rcats']['name']['cb']['isDuplicate'] = array(
        'name' => 'isDuplicate',
        'inverse' => TRUE,
        'params' => array($feedback_pre['connect'], $_SESSION['uid'], 'name' => '_getRcatsVal'),
        'return_on_err' => TRUE,
        'err' => C_ERR_DUPLICATE,
    );

    unset($_POST['add']);
}
else if(isset($_POST['del']) && isset($_POST['s'])){
    $result = mysqli_query($feedback_pre['connect'], 'DELETE FROM category WHERE category_id IN (' .
        implode(',', $_POST['s']) . ');');

    if(!$result){
        $retval['code'] = ERR_DB;
    }
    else{
        $retval['code'] = array(DELETED, count($_POST['s']));
    }
}
else if(isset($_POST['modify-sel']) || isset($continue)){

    if(isset($_POST['s']) && !empty($_POST['s'])){
        $result = mysqli_query($feedback_pre['connect'], 'SELECT * FROM category WHERE category_id IN (' .
                                implode(',', $_POST['s']) . ');');

        $_SESSION['modify_list'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if(isset($continue) || !empty($_POST['s'])){
        $retval['category_id'] = $_SESSION['modify_list'][0]['category_id'];
        $retval['name'] = $_SESSION['modify_list'][0]['name'];
        $retval['description'] = $_SESSION['modify_list'][0]['description'];
        $retval['action'] = ACTION_MODIFY;

        $color = colorCodeFromInt($_SESSION['modify_list'][0]['color'], TRUE);
        if(DEFAULT_COLOR == $color){
            $retval['color'] = COLOR_CODE;
        }
        else{
            $retval['color'] = $color;
        }

        if((int)$_SESSION['modify_list'][0]['repeat_interval']){
            $retval['repeat'] = $_SESSION['modify_list'][0]['repeat_interval'];
        }
    }
}
else if(isset($_POST['stop'])){
    unset($_SESSION['modify_list']);
}
else if(isset($_POST['modify'])){
    assignRcatsVals($retval, $_POST['name'], $_POST['description'], $_POST['color'],
        $_POST['repeat'], TRUE, 'cat');

    $retval['rcats']['replace'] = TRUE;
    $retval['rcats']['retval'] = MODIFIED;

    $retval['rcats']['category_id'] = array(
        'value' => $_POST['category_id'],
        'field' => 'category_id',
    );

    unset($_POST['modify']);
}

$retval['categories'] = getDbdata($feedback_pre['connect'], 'category', array('name',
                 'description', 'repeat_interval', 'color', 'category_id'),
                 array('user_id' => $_SESSION['uid']));

return $retval;
