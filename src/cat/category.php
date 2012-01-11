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
);

if(isset($_POST['add'])){
    $retval['reload'] = TRUE;
    $retval['module'] = 'cat';
    $retval['rcats'] = array(
        'name' => array(
            'value' => $_POST['name'],
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
                'isDuplicate' => array(
                    'name' => 'isDuplicate',
                    'inverse' => TRUE,
                    'params' => array($feedback_pre['connect'], $_SESSION['uid'], 'name' => '_getRcatsVal'),
                    'return_on_err' => TRUE,
                    'err' => C_ERR_DUPLICATE,
                ),
            ),
            'err' => C_ERR_NAME,
            'return_on_err' => TRUE,
            'field' => 'name',
        ),
        'description' => array(
            'value' => $_POST['description'],
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
            'value' => $_POST['color'],
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
            'value' => $_POST['repeat'],
            'field' => 'repeat_interval',
        ),
        'uid' => array(
            'value' => $_SESSION['uid'],
            'field' => 'user_id',
        ),
        'table' => 'category',
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

$retval['categories'] = getDbdata($feedback_pre['connect'], 'category', array('name',
                 'description', 'repeat_interval', 'color', 'category_id'),
                 array('user_id' => $_SESSION['uid']));

return $retval;
