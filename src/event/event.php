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
                    'params' => array('_getRcatsVal' => 'name'),
                ),
                'isValid' => array(
                    'name' => 'isValidCatEvName',
                    'params' => array('_getRcatsVal' => 'name'),
                ),
                'isDuplicate' => array(
                    'name' => 'isDuplicate',
                    'inverse' => TRUE,
                    'params' => array($feedback_pre['connect'], $_SESSION['uid'], '_getRcatsVal' => 'name'),
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
                    'params' => array('_getRcatsVal' => 'description'),
                ),
                'isValid' => array(
                    'name' => 'isValidCatEvDesc',
                    'params' => array('_getRcatsVal' => 'description'),
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
                    'params' => array('_getRcatsVal' => 'color'),
                ),
                'isValid' => array(
                    'name' => 'isValidCatEvColor',
                    'params' => array('_getRcatsVal' => 'color'),
                ),
                'transform' => array(
                    'assign' => TRUE,
                    'name' => 'colorCodeToInt',
                    'params' => array('_getRcatsVal' => 'color'),
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
                    'params' => array('_getRcatsVal' => 'startdate'),
                ),
                'default' => array(
                    'name' => '_defaultDateTime',
                    'params' => array('_getRcatsVal' => 'startdate'),
                    'assign' => TRUE,
                ),
                'isValid' => array(
                    'name' => 'isValidDateTime',
                    'params' => array('_getRcatsVal' => 'startdate'),
                ),
                'ts' => array(
                    'name' => 'dateTimeChangeFormat',
                    'assign' => TRUE,
                    'params' => array('_getRcatsVal' => 'startdate', MYSQL_TS),
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
                    'params' => array('_getRcatsVal' => 'enddate'),
                ),
                'default' => array(
                    'name' => '_defaultDateTime',
                    'params' => array('_getRcatsVal' => 'enddate'),
                    'assign' => TRUE,
                ),
                'isValid' => array(
                    'name' => 'isValidDateTime',
                    'params' => array('_getRcatsVal' => 'enddate'),
                ),
                'ts' => array(
                    'name' => 'dateTimeChangeFormat',
                    'assign' => TRUE,
                    'params' => array('_getRcatsVal' => 'enddate', MYSQL_TS),
                ),
                'isValidSuccession' => array(
                    'name' => 'isValidDateSuccession',
                    'params' => array('_getRcatsVal' => 'startdate', '_getRcatsVal' => 'enddate'),
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
