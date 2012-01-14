<?php
/**
 * @file src/alarm/functions.php
 * @brief functions for the alarm page
 * @author Paul Barbu
 *
 * @ingroup alarmFiles
 */

/**
 * Format an alarm
 * Callback used in arrayToDiv
 *
 * @param array $alarm the alarm data as an array returned by
 * mysqli_fetch_assoc()
 *
 * @return a formatted string
 */
function formatAlarm($alarm){/*{{{*/
    return '&nbsp;<input type="checkbox" name="s[]" value="' . $alarm['alarm_id'] .
        '" id="id-' . $alarm['alarm_id'] . '" /><label for="id-' . $alarm['alarm_id'] .
        '">&nbsp;' . dateTimeChangeFormat($alarm['date'], USER_TS) . '</label>';
}/*}}}*/

/**
 * Sets some fields in an array in order to use it in rcats
 *
 * @param array $retval the referenced array to write in
 * @param int $event_id the event id
 * @param string $date datetime when the user should be notified
 * @param bool $reload flag variable, should be TRUE when sending data to rcats
 * @param string $module the module to reload if $reload is set to TRUE
 *
 * @return the return is made through the $retval parameter which should be an
 * array
 */
function assignRcatsValsAlarm(&$retval, $event_id, $date, $reload, $module){/*{{{*/
    $retval['rcats']['event_id']['value'] = $event_id;
    $retval['rcats']['date']['value'] = $date;

    $retval['reload'] = $reload;
    $retval['module'] = $module;
}/*}}}*/

/**
 * Validates an alarm date accoring to the event to which the alarm is assigned
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 * @param string $alarmdate datetime the alarm will be set to
 * @param int $event_id the event to which the alarm will be assigned
 *
 * @return TRUE is the alarm date is occuring before event's due date (if the
 * due date is set), else FALSE
 */
function isValidAlarmDate($link, $alarmdate, $event_id){/*{{{*/
    if('0000-00-00 00:00' === $alarmdate){
        return FALSE;
    }

    $event_due = getDbData($link, 'event', array('end'), array('event_id' => $event_id));

    if('0000-00-00 00:00:00' != $event_due[0]['end']){
        $event_ts = strtotime($event_due[0]['end']);
        $alarm_ts =  strtotime($alarmdate);

        if($alarm_ts <= $event_ts){
            return TRUE;
        }

        return FALSE;
    }

    return TRUE;
}/*}}}*/

/**
 * Checks whether the user submitted a date
 *
 * @param string $input the input to be checked
 *
 * @return TRUE is the user submitted a datetime, else FALSE
 */
function isDateTimeInput($input){/*{{{*/
    if($input != DATETIME_TOUSER){
        return TRUE;
    }

    return FALSE;
}/*}}}*/
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
