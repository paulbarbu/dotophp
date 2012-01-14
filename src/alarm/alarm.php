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
    'date' => isset($_POST['date']) ? $_POST['date'] : NULL,
    'code' => TRUE,
    'ev_names' => $ev_names,
    'ev_ids' => $ev_ids,
    'rcats' => array(
    ),
);

if(isset($_POST['add'])){
    //TODO
    unset($_POST['add']);
}
else if(isset($_POST['del'])){
    //TODO
}
else if(isset($_POST['modify'])){
    //TODO
}

$result_alarms = mysqli_query($feedback_pre['connect'], 'SELECT event.name, event.event_id, alarm.* FROM event JOIN alarm USING(event_id)');
$retval['alarms'] = mysqli_fetch_all($result_alarms, MYSQLI_ASSOC);

return $retval;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
