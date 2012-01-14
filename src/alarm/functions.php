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
        '">&nbsp;' . $alarm['date'] . '</label>';
}/*}}}*/
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
