<?php
/**
 * @file src/alarm/alarm.php
 * @brief Main file of the alarm page
 * @author Paul Barbu
 *
 * @ingroup alarmFiles
 */

if(!$feedback_pre['connect']){
    writeLog('alarm', '(' . mysqli_connect_errno() . ') ' .
        mysqli_connect_error() . PHP_EOL);

    return array('code' => ERR_DB_CONN);
}

$result_events = mysqli_query($feedback_pre['connect'],
    'SELECT event.name, event_id FROM category JOIN event USING(category_id) WHERE event.done=0 AND category.user_id=' . $_SESSION['uid']);

if(!$result_events){
    writeLog('alarm', '(' . mysqli_errno($feedback_pre['connect'])
             . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);

    return array('code' => ERR_DB);
}

$events = mysqli_fetch_all($result_events, MYSQLI_ASSOC);

if(!empty($events)){
    $ev_names = array();
    $ev_ids = array();

    foreach($events as $i){
        $ev_names[] = $i['name'];
        $ev_ids[] = $i['event_id'];
    }
}
else{
    return array('reload' => TRUE, 'module' => 'event');
}

$retval = array(
    'action' => ACTION_ADD,
    'event_id' => isset($_POST['event_id']) ? $_POST['event_id'] : NULL,
    'alarm_id' => isset($_POST['alarm_id']) ? $_POST['alarm_id'] : NULL,
    'date' => isset($_POST['date']) ? $_POST['date'] : NULL,
    'code' => TRUE,
    'ev_names' => $ev_names,
    'ev_ids' => $ev_ids,
    'rcats' => array(
        'event_id' => array(
            'value' => NULL,
            'field' => 'event_id',
        ),
        'date' => array(
            'value' => NULL,
            'cb' => array(
                'filter' => array(
                    'name' => '_filterVariable',
                    'assign' => TRUE,
                    'params' => array('date' => '_getRcatsVal'),
                ),
                'isUserInput' => array(
                    'name' => 'isDateTimeInput',
                    'params' => array('date' => '_getRcatsVal'),
                ),
                'isValid' => array(
                    'name' => 'isValidDateTime',
                    'params' => array('date' => '_getRcatsVal'),
                ),
                'ts' => array(
                    'name' => 'dateTimeChangeFormat',
                    'assign' => TRUE,
                    'params' => array('date' => '_getRcatsVal', MYSQL_TS),
                ),
                'isValidAlarm' => array(
                    'name' => 'isValidAlarmDate',
                    'params' => array($feedback_pre['connect'], 'date' => '_getRcatsVal',
                                 'event_id' => '_getRcatsVal'),
                    'err' => A_ERR_ALARM_DATE,
                    'return_on_err' => TRUE,
                ),
            ),
            'err' => A_ERR_DATETIME,
            'return_on_err' => TRUE,
            'field' => 'date',
        ),
        'table' => 'alarm',
    ),
);

if(isset($_SESSION['modify_alarm_list']) && !empty($_SESSION['modify_alarm_list'])){
    $retval['action'] = ACTION_MODIFY;

    if(MODIFIED === $feedback_pre['rcats']){
        array_shift($_SESSION['modify_alarm_list']);

        if(empty($_SESSION['modify_alarm_list'])){
            $retval['action'] = ACTION_ADD;
            unset($retval['alarm_id']);
        }
        else{
            $continue = TRUE;
        }
    }
}

if(isset($_POST['add'])){
    assignRcatsValsAlarm($retval, $_POST['event_id'], $_POST['date'], TRUE, 'alarm');
    unset($_POST['add']);
}
else if(isset($_POST['del']) && isset($_POST['s'])){
    $del_result = mysqli_query($feedback_pre['connect'], 'DELETE FROM alarm WHERE alarm_id IN (' .
        implode(',', $_POST['s']) . ')');

    if(!$del_result){
        writeLog('alarm', '(' . mysqli_errno($feedback_pre['connect'])
                 . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);

        return array('code' => ERR_DB);
    }
    else{
        $retval['code'] = array(DELETED, count($_POST['s']));
    }
}
else if(isset($_POST['modify-sel']) || isset($continue)){

    if(isset($_POST['s']) && !empty($_POST['s'])){
        $result = mysqli_query($feedback_pre['connect'], 'SELECT * FROM alarm WHERE alarm_id IN (' .
                                implode(',', $_POST['s']) . ');');

        $_SESSION['modify_alarm_list'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if(isset($continue) || !empty($_POST['s'])){
        $retval['alarm_id'] = $_SESSION['modify_alarm_list'][0]['alarm_id'];
        $retval['event_id'] = $_SESSION['modify_alarm_list'][0]['event_id'];
        $retval['date'] = _defaultDateTime(dateTimeChangeFormat($_SESSION['modify_alarm_list'][0]['date'], USER_TS));
        $retval['action'] = ACTION_MODIFY;
    }
}
else if(isset($_POST['stop'])){
    unset($_SESSION['modify_alarm_list']);
}
else if(isset($_POST['modify'])){
    assignRcatsValsAlarm($retval, $_POST['event_id'], $_POST['date'], TRUE, 'alarm');

    $retval['rcats']['update'] = TRUE;
    $retval['rcats']['update_condition'] = array('alarm_id' => $_POST['alarm_id']);
    $retval['rcats']['retval'] = MODIFIED;

    $retval['rcats']['alarm_id'] = array(
        'value' => $_POST['alarm_id'],
        'field' => 'alarm_id',
    );

    unset($_POST['modify']);
}

$result_alarms = mysqli_query($feedback_pre['connect'], 'SELECT event.name, event.event_id, alarm.* FROM event JOIN alarm USING(event_id)');
$retval['alarms'] = mysqli_fetch_all($result_alarms, MYSQLI_ASSOC);

return $retval;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
