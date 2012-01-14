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

    return array('code' => ERR_DB_CONN);
}

$cat = getDbData($feedback_pre['connect'], 'category', array('name', 'category_id'), array('user_id' => $_SESSION['uid']));

if(!$cat){
    writeLog('event', '(' . mysqli_errno($feedback_pre['connect'])
             . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);

    return array('code' => ERR_DB);
}

if(!empty($cat)){
    $cat_names = array();
    $cat_ids = array();

    foreach($cat as $i){
        $cat_names[] = $i['name'];
        $cat_ids[] = $i['category_id'];
    }
}
else{
    return array('reload' => TRUE, 'module' => 'cat');
}


$retval = array(
    'code' => TRUE,
    'quickadd' => isset($_POST['quickadd']) ? $_POST['quickadd'] : NULL,
    'name' => isset($_POST['name']) ? $_POST['name'] : NULL,
    'description' => isset($_POST['description']) ? $_POST['description'] : NULL,
    'color' => isset($_POST['color']) ? $_POST['color'] : NULL,
    'repeat' => isset($_POST['repeat']) ? $_POST['repeat'] : NULL,
    'startdate' => isset($_POST['startdate']) ? $_POST['startdate'] : NULL,
    'cat' => isset($_POST['cat']) ? $_POST['cat'] : NULL,
    'repeat' => isset($_POST['enddate']) ? $_POST['enddate'] : NULL,
    'private' => isset($_POST['private']) ? $_POST['private'] : NULL,
    'priority' => isset($_POST['priority']) ? $_POST['priority'] : NULL,
    'exception' => isset($_POST['exception']) ? $_POST['exception'] : NULL,
    'event_id' => isset($_POST['event_id']) ? $_POST['event_id'] : NULL,
    'cat_names' => $cat_names,
    'cat_ids' => $cat_ids,
    'action' => ACTION_ADD,
    'rcats' => array(
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
    ),
);

if(isset($_SESSION['modify_list']) && !empty($_SESSION['modify_list'])){
    $retval['action'] = ACTION_MODIFY;

    if(MODIFIED === $feedback_pre['rcats']){
        array_shift($_SESSION['modify_list']);

        if(empty($_SESSION['modify_list'])){
            $retval['action'] = ACTION_ADD;
            unset($retval['event_id']);
        }
        else{
            $continue = TRUE;
        }
    }
}

if(isset($_POST['add'])){
    assignRcatsValsEv($retval, $feedback_pre['connect'], $_POST['cat'], $_POST['name'],
        $_POST['description'], $_POST['color'], $_POST['repeat'], $_POST['priority'],
        $_POST['startdate'], $_POST['enddate'], TRUE, 'event',
        isset($_POST['private']) ? $_POST['private'] : NULL,
        isset($_POST['exception']) ? $_POST['exception'] : NULL);

    $retval['rcats']['name']['cb']['isDuplicateEv'] = array(
        'name' => 'isDuplicateEv',
        'inverse' => TRUE,
        'params' => array($feedback_pre['connect'], 'category' => '_getRcatsVal',
                         'name' => '_getRcatsVal'),
        'return_on_err' => TRUE,
        'err' => E_ERR_DUPLICATE,
    );

    unset($_POST['add']);
}
else if(isset($_POST['del']) && isset($_POST['s'])){
    $result = mysqli_query($feedback_pre['connect'], 'DELETE FROM event WHERE event_id IN (' .
        implode(',', $_POST['s']) . ');');

    if(!$result){
        writeLog('event', '(' . mysqli_errno($feedback_pre['connect'])
                 . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);

        $retval['code'] = ERR_DB;
    }
    else{
        $retval['code'] = array(DELETED, count($_POST['s']));
    }
}
else if(isset($_POST['done'])){
    if(isset($_POST['s'])){
        $result = mysqli_query($feedback_pre['connect'], 'UPDATE event SET done=1 WHERE event_id IN (' .
            implode(',', $_POST['s']) . ');');

        if(!$result){
            writeLog('event', '(' . mysqli_errno($feedback_pre['connect'])
                     . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);

            $retval['code'] = ERR_DB;
        }
        else{
            $retval['code'] = array(DONE, count($_POST['s']));
        }
    }
}
else if(isset($_POST['view-done'])){
    $result = mysqli_query($feedback_pre['connect'], 'SELECT event.name, event_id,
        event.description FROM event JOIN category USING(category_id) WHERE done=1
        AND user_id=' . $_SESSION['uid']);

    $retval['done_ev'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
else if(isset($_POST['modify-sel']) || isset($continue)){

    if(isset($_POST['s']) && !empty($_POST['s'])){
        $result = mysqli_query($feedback_pre['connect'], 'SELECT * FROM event WHERE event_id IN (' .
                                implode(',', $_POST['s']) . ');');

        $_SESSION['modify_list'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if(isset($continue) || !empty($_POST['s'])){
        $retval['event_id'] = $_SESSION['modify_list'][0]['event_id'];
        $retval['cat'] = $_SESSION['modify_list'][0]['category_id'];
        $retval['name'] = $_SESSION['modify_list'][0]['name'];
        $retval['description'] = $_SESSION['modify_list'][0]['description'];
        $retval['priority'] = $_SESSION['modify_list'][0]['priority'];
        $retval['startdate'] = _defaultDateTime(dateTimeChangeFormat($_SESSION['modify_list'][0]['start'], USER_TS));
        $retval['enddate'] = _defaultDateTime(dateTimeChangeFormat($_SESSION['modify_list'][0]['end'], USER_TS));
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

        if((int)$_SESSION['modify_list'][0]['exception']){
            $retval['exception'] = $_SESSION['modify_list'][0]['exception'];
        }

        if((int)$_SESSION['modify_list'][0]['private']){
            $retval['private'] = $_SESSION['modify_list'][0]['private'];
        }
    }
}
else if(isset($_POST['stop'])){
    unset($_SESSION['modify_list']);
}
else if(isset($_POST['modify'])){
    assignRcatsValsEv($retval, $feedback_pre['connect'], $_POST['cat'], $_POST['name'],
        $_POST['description'], $_POST['color'], $_POST['repeat'], $_POST['priority'],
        $_POST['startdate'], $_POST['enddate'], TRUE, 'event',
        isset($_POST['private']) ? $_POST['private'] : NULL,
        isset($_POST['exception']) ? $_POST['exception'] : NULL);

    $retval['rcats']['update'] = TRUE;
    $retval['rcats']['update_condition'] = array('event_id' => $_POST['event_id']);
    $retval['rcats']['retval'] = MODIFIED;

    $retval['rcats']['event_id'] = array(
        'value' => $_POST['event_id'],
        'field' => 'event_id',
    );

    unset($_POST['modify']);
}

$result_events = mysqli_query($feedback_pre['connect'], 'SELECT c.name AS cname,
    c.color AS ccolor, event_id, e.category_id, e.name AS ename, e.description,
    e.repeat_interval, e.color, priority, private, exception, alarm.date as alarm,
    start, end FROM event AS e JOIN category AS c USING (category_id) LEFT JOIN
    alarm USING(event_id) WHERE done=0 AND user_id =' . $_SESSION['uid'] .
    ' GROUP BY event_id');

$retval['events'] = mysqli_fetch_all($result_events, MYSQLI_ASSOC);

return $retval;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
