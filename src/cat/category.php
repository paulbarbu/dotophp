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
    return array('reload' => TRUE, 'module' => 'cat', 'rcats' => array(
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
    ));
}

return TRUE;
