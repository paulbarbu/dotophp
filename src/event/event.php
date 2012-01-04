<?php
/**
 * @file src/event/event.php
 * @brief Manage events main file
 * @author Paul Barbu
 *
 * @ingroup eventFiles
 */

if(isset($_POST['add'])){

    $retval = array('reload' => TRUE, 'module' => 'event', 'rcats' => array(
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
                    'inverse' => TRUE,
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
        'startdate' => array(
            'value' => $_POST['startdate'],
            'cb' => array(
                'filter' => array(
                    'name' => '_filterVariable',
                    'assign' => TRUE,
                    'params' => array($_POST['startdate']),
                ),
                'isValid' => array(
                    'name' => 'isValidDateTime',
                    'params' => array($_POST['startdate']),
                ),
                'ts' => array(
                    'name' => 'dateTimeChangeFormat',
                    'assign' => TRUE,
                    'params' => array($_POST['startdate'], MYSQL_TS),
                ),
            ),
            'err' => E_ERR_DATETIME,
            'return_on_err' => TRUE,
            'field' => 'start',
        ),
        'enddate' => array(
            'value' => $_POST['enddate'],
            'cb' => array(
                'filter' => array(
                    'name' => '_filterVariable',
                    'assign' => TRUE,
                    'params' => array($_POST['enddate']),
                ),
                'isValid' => array(
                    'name' => 'isValidDateTime',
                    'params' => array($_POST['enddate']),
                ),
                'ts' => array(
                    'name' => 'dateTimeChangeFormat',
                    'assign' => TRUE,
                    'params' => array($_POST['enddate'], MYSQL_TS),
                ),
                'isValidSuccession' => array(
                    'name' => 'isValidDateSucession',
                    'params' => array($_POST['startdate'], $_POST['enddate']),
                    'err' => E_ERR_INVALID_ENDDATE,
                ),
            ),
            'err' => E_ERR_DATETIME,
            'return_on_err' => FALSE,
            'field' => 'end',
        ),
        'table' => 'event',
    ));

    if(isset($_POST['private'])){
        $retval['rcats']['private'] = array(
            'value' => $_POST['private'],
            'field' => 'private',
        );
    }

    if(isset($_POST['exception'])){
        $retval['rcats']['exception'] = array(
            'value' => $_POST['exception'],
            'field' => 'exception',
        );
    }

    return $retval;
}

return TRUE;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
