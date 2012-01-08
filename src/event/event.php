<?php
/**
 * @file src/event/event.php
 * @brief Manage events main file
 * @author Paul Barbu
 *
 * @ingroup eventFiles
 */

if(!$feedback_pre['connect']){
    writeLog('event', '(' . mysqli_connect_errno() . ') ' .
        mysqli_connect_error() . PHP_EOL);
    return ERR_DB_CONN;
}

$retval = array('reload' => TRUE, 'module' => 'event', 'rcats' => array(
    'category' => array(
        'value' => NULL,
        'field' => 'category_id',
    ),
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
        'err' => E_ERR_NAME,
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
        'err' => E_ERR_DESC,
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
        'err' => E_ERR_COLOR,
        'return_on_err' => FALSE,
        'field' => 'color',
    ),
    'repeat' => array(
        'value' => NULL,
        'field' => 'repeat_interval',
    ),
    'priority' => array(
        'value' => NULL,
        'field' => 'priority',
    ),
    'startdate' => array(
        'value' => NULL,
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
        'value' => NULL,
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
                'return_on_err' => TRUE,
            ),
        ),
        'err' => E_ERR_DATETIME,
        'return_on_err' => FALSE,
        'field' => 'end',
    ),
    'table' => 'event',
));

if(isset($_POST['add']) || isset($_POST['modify'])){

    $retval['rcats']['category']['value'] = $_POST['cat'];
    $retval['rcats']['name']['value'] = $_POST['name'];
    $retval['rcats']['description']['value'] = $_POST['description'];
    $retval['rcats']['color']['value'] = $_POST['color'];
    $retval['rcats']['repeat']['value'] = $_POST['repeat'];
    $retval['rcats']['priority']['value'] = $_POST['priority'];
    $retval['rcats']['startdate']['value'] = $_POST['startdate'];
    $retval['rcats']['enddate']['value'] = $_POST['enddate'];

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
    else{
        if(COLOR_CODE == $retval['rcats']['color']['value']){
            $cat_data = getDbData($feedback_pre['connect'], 'category',
                array('color'), array('category_id' => $_POST['cat']));

            $retval['rcats']['color']['value'] = colorCodeFromInt($cat_data[0]['color'], TRUE);
        }

        if('-1' == $_POST['repeat']){
            $cat_data = getDbData($feedback_pre['connect'], 'category',
                array('repeat_interval'), array('category_id' => $_POST['cat']));

            $retval['rcats']['repeat']['value'] = $cat_data[0]['repeat_interval'];
        }
    }

    if(isset($_POST['modify'])){
        $retval['rcats']['event_id'] = array(
            'value' => $_POST['event_id'],
            'field' => 'event_id',
        );

        $retval['rcats']['replace'] = TRUE;
        $retval['rcats']['retval'] = MODIFIED;
    }
    else{
        $retval['rcats']['name']['isDuplicate'] = array(
            'name' => 'isDuplicate',
            'inverse' => TRUE,
            'params' => array($feedback_pre['connect'], 'category' => '_getRcatsVal',
                             'name' => '_getRcatsVal'),
            'return_on_err' => TRUE,
            'err' => E_ERR_DUPLICATE,
        );
    }

    return $retval;
}

if(isset($_POST['del'])){
    if(isset($_POST['s'])){
        $result = mysqli_query($feedback_pre['connect'], 'DELETE FROM event WHERE event_id IN (' .
            implode(',', $_POST['s']) . ');');

        if(!$result){
            return ERR_DB;
        }

        return array(DELETED, count($_POST['s']));
    }
}

if(isset($_POST['done'])){
    if(isset($_POST['s'])){
        $result = mysqli_query($feedback_pre['connect'], 'UPDATE event SET done=1 WHERE event_id IN (' .
            implode(',', $_POST['s']) . ');');

        if(!$result){
            return ERR_DB;
        }

        return array(DONE, count($_POST['s']));
    }
}

if(isset($_POST['stop'])){
    unset($_SESSION['modify']);
}

if(isset($_POST['modify-sel']) && isset($_POST['s'])){
    $_SESSION['modify'] = $_POST['s'];
}

return TRUE;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
