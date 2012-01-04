<?php
/**
 * @file src/event/functions.php
 * @brief Manage events functions file
 * @author Paul Barbu
 *
 * @ingroup eventFiles
 */

/**
 * Checks if a due date occurs later in time tahn a start date
 *
 * @param string $start start date
 * @param string $end due date
 *
 * @return TRUE if the due date occurs later in time, else FALSE
 */
function isValidDateSuccession($start, $end){/*{{{*/
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);

    $delta = $end_ts - $start_ts;

    if($delta > 0){
        return TRUE;
    }
    else{
        return FALSE;
    }
}/*}}}*/

/**
 * Check if the gived event name already exists with the same owner
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 * @param int $cat_id the category where the event will be added
 * @param string $name event's name to be checked
 *
 * @return TRUE is the event already exists, else FALSE
 */
function isDuplicate($link, $cat_id, $name){/*{{{*/
    return (bool)count(getDbData($link, 'event', array('name'),
        array('category_id' => $cat_id, 'condition' => 'AND', 'name' => $name)));
}/*}}}*/
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
