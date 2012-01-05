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
                    'params' => array('name' => '_getRcatsVal'),
                ),
                'isValid' => array(
                    'name' => 'isValidCatEvName',
                    'params' => array('name' => '_getRcatsVal'),
                ),
                'isDuplicate' => array(
                    'name' => 'isDuplicate',
                    'inverse' => TRUE,
                    'params' => array($feedback_pre['connect'], $_POST['cat'], 'name' => '_getRcatsVal'),
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
                    'params' => array('description' => '_getRcatsVal'),
                ),
                'isValid' => array(
                    'name' => 'isValidCatEvDesc',
                    'params' => array('description' => '_getRcatsVal'),
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
                    'params' => array('startdate' => '_getRcatsVal'),
                ),
                'default' => array(
                    'name' => '_defaultDateTime',
                    'params' => array('startdate' => '_getRcatsVal'),
                    'assign' => TRUE,
                ),
                'isValid' => array(
                    'name' => 'isValidDateTime',
                    'params' => array('startdate' => '_getRcatsVal'),
                ),
                'ts' => array(
                    'name' => 'dateTimeChangeFormat',
                    'assign' => TRUE,
                    'params' => array('startdate' => '_getRcatsVal', MYSQL_TS),
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
                    'params' => array('enddate' => '_getRcatsVal'),
                ),
                'default' => array(
                    'name' => '_defaultDateTime',
                    'params' => array('enddate' => '_getRcatsVal'),
                    'assign' => TRUE,
                ),
                'isValid' => array(
                    'name' => 'isValidDateTime',
                    'params' => array('enddate' => '_getRcatsVal'),
                ),
                'ts' => array(
                    'name' => 'dateTimeChangeFormat',
                    'assign' => TRUE,
                    'params' => array('enddate' => '_getRcatsVal', MYSQL_TS),
                ),
                'isValidSuccession' => array(
                    'name' => 'isValidDateSuccession',
                    'params' => array('startdate' => '_getRcatsVal', 'enddate' => '_getRcatsVal'),
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

    if(isset($_POST['exception']) && $_POST['exception']){
        $retval['rcats']['exception'] = array(
            'value' => $_POST['exception'],
            'field' => 'exception',
        );
    }
    else{
        $cat_data = getDbData($feedback_pre['connect'], 'category',
            array('repeat_interval', 'color'), array('category_id' => $_POST['cat']));

        if(COLOR_CODE == $retval['rcats']['color']['value']){
            $retval['rcats']['color']['value'] = colorCodeFromInt($cat_data[0]['color'], TRUE);
        }

        $retval['rcats']['repeat']['value'] = $cat_data[0]['repeat_interval'];
    }

    return $retval;
}

return TRUE;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
