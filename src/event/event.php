<?php
/**
 * @file src/event/event.php
 * @brief Manage events main file
 * @author Paul Barbu
 *
 * @ingroup eventFiles
 */

//TODO start and due

if(isset($_POST['add'])){
    return array('reload' => TRUE, 'module' => 'event', 'rcats' => array(
        'category' => array(
            'value' => $_POST['cat'],
            'field' => 'category_id',
        ),
        'name' => array(
            'value' => $_POST['name'],
            'cb' => array(
                'filter' => array(
                    'name' => '_filterVariable',
                    'assign' => TRUE,
                    'params' => array($_POST['name']),
                ),
                'isValid' => array(
                    'name' => 'isValidCatEvName',
                    'params' => array($_POST['name']),
                ),
                'isDuplicate' => array(
                    'name' => 'isDuplicate',
                    'params' => array($feedback_pre['connect'], $_SESSION['uid'], $_POST['name']),
                    'return_on_err' => TRUE,
                    'err' => E_ERR_DUPLICATE,
                ),
            ),
            'err' => E_ERR_NAME,
            'return_on_err' => TRUE,
            'field' => 'name',
        ),
        'description' => array(
            'value' => $_POST['description'],
            'cb' => array(
                'filter' => array(
                    'name' => '_filterVariable',
                    'assign' => TRUE,
                    'params' => array($_POST['description']),
                ),
                'isValid' => array(
                    'name' => 'isValidCatEvDesc',
                    'params' => array($_POST['description']),
                ),
            ),
            'err' => E_ERR_DESC,
            'return_on_err' => FALSE,
            'field' => 'description',
        ),
        'color' => array(
            'value' => $_POST['color'],
            'cb' => array(
                'filter' => array(
                    'name' => '_filterVariable',
                    'assign' => TRUE,
                    'params' => array($_POST['color']),
                ),
                'isValid' => array(
                    'name' => 'isValidCatEvColor',
                    'params' => array($_POST['color']),
                ),
                'transform' => array(
                    'assign' => TRUE,
                    'name' => 'colorCodeToInt',
                    'params' => array($_POST['color']),
                ),
            ),
            'err' => E_ERR_COLOR,
            'return_on_err' => FALSE,
            'field' => 'color',
        ),
        'repeat' => array(
            'value' => $_POST['repeat'],
            'field' => 'repeat_interval',
        ),
        'priority' => array(
            'value' => $_POST['priority'],
            'field' => 'priority',
        ),
        'private' => array(
            'value' => $_POST['private'],
            'field' => 'private',
        ),
        'exception' => array(
            'value' => $_POST['exception'],
            'field' => 'exception',
        ),
        'table' => 'event',
    ));
}

return TRUE;
