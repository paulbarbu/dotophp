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
 * Assumes a call to a validation function has been made already and the two
 * dates are valid
 *
 * @param string $start start date
 * @param string $end due date
 *
 * @return TRUE if the due date occurs later in time, else FALSE
 */
function isValidDateSuccession($start, $end){/*{{{*/
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);

    if(!$start_ts || !$end_ts){
        return TRUE;
    }

    $delta = $end_ts - $start_ts;

    if($delta > 0){
        return TRUE;
    }

    return FALSE;
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
function isDuplicateEv($link, $cat_id, $name){/*{{{*/
    return (bool)count(getDbData($link, 'event', array('name'),
        array('category_id' => $cat_id, 'condition' => 'AND', 'name' => $name)));
}/*}}}*/

/**
 * Format a container that will "hold" events
 * Helper function used as callback for arrayToDiv()
 *
 * $param array $ev the events in a category
 *
 * @return a formatted string
 */
function formatEvent($ev){/*{{{*/
    require 'constants.php';

    $evColor = colorCodeFromInt($ev['color']);

    $content = '<div title="';

    $ep = array();

    if($ev['exception']){
        $ep[] = 'Exception';
    }

    if($ev['private']){
        $ep[] = 'Private';
    }

    $content .= implode(', ', $ep) . '" ';

    $content .= 'style="margin-left:10px;margin-top:5px;background-color:#' .
        $evColor . ';color:#' . getContrastColor($evColor) .
        '">&nbsp;<input type="checkbox" name="s[]" value="' . $ev['event_id'] .
        '" id="id-' . $ev['event_id'] . '" /><label for="id-' . $ev['event_id'] .
        '">&nbsp;' . $ev['ename'];

    if(isset($ev['alarm'])){
        $content .= '&nbsp;&#8986;';
    }

    $startDate = dateTimeChangeFormat($ev['start'], USER_TS);
    if(DEFAULT_DATETIME != $startDate){
        $content .= '<span style="margin-left:20px;">&#9659; ' . $startDate . '</span>';
    }

    if($ev['repeat_interval']){
        $content .= '<span class="toRight">' . $REPEATS[$ev['repeat_interval']] .
            '&nbsp;</span>';
    }

    $endDate = dateTimeChangeFormat($ev['end'], USER_TS);
    if(DEFAULT_DATETIME != $endDate){
        $content .= '<span style="margin-right:20px;text-align:right;float:right;">' .
            $endDate . ' &#9669;</span>';
    }

    if(!empty($ev['description'])){
        $content .= '<br /><span style="margin-left:40px;">' . $ev['description'] . '</span>';
    }

    $content .= '</label></div>';

    return $content;

}/*}}}*/

/**
 * Formats a completed event
 * Helper function used as callback for arrayToDiv()
 *
 * $param array $ev the event
 *
 * @return a formatted string
 */
function formatDoneEvent($ev){/*{{{*/
    $content = '<div style="margin-top:5px;">&nbsp;' . $ev['name'];

    if(!empty($ev['description'])){
        $content .= '<div style="margin-left:20px;">' . $ev['description'] . '</div>';
    }

    $content .= '</div>';

    return $content;

}/*}}}*/

/**
 * Sets some fields in an array in order to use it in rcats
 *
 * @param array $retval the referenced array to write in
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 * @param int $cat the category id
 * @param string $name event's name
 * @param string $description event's description
 * @param string $color event's color
 * @param int $repeat event's repeat interval
 * @param int $priority event's priority
 * @param string $startdate datetime when the event starts
 * @param string $enddate datetime when the event ends
 * @param bool $reload flag variable, should be TRUE when sending data to rcats
 * @param string $module the module to reload if $reload is set to TRUE
 * @param mixed $private if this evaluates to bool FALSE by implicit conversion
 * then the event will be public
 * @param mixed $exception if this evaluates to bool FALSE by implicit conversion
 * then the event inherits the caregory's repeat interval or color if they are
 * left default by the user
 *
 * @return the return is made through the $retval parameter which should be an
 * array
 */
function assignRcatsValsEv(&$retval, $link, $cat, $name, $description, $color, $repeat,/*{{{*/
        $priority, $startdate, $enddate, $reload, $module, $private = NULL,
        $exception = NULL){

    $retval['reload'] = $reload;
    $retval['module'] = $module;

    $retval['rcats']['category']['value'] = $cat;
    $retval['rcats']['name']['value'] = $name;
    $retval['rcats']['description']['value'] = $description;
    $retval['rcats']['color']['value'] = $color;
    $retval['rcats']['repeat']['value'] = $repeat;
    $retval['rcats']['priority']['value'] = $priority;
    $retval['rcats']['startdate']['value'] = $startdate;
    $retval['rcats']['enddate']['value'] = $enddate;

    if(isset($private) && $private){
        $retval['rcats']['private'] = array(
            'value' => $private,
            'field' => 'private',
        );
    }

    if(isset($exception) && $exception){
        $retval['rcats']['exception'] = array(
            'value' => $exception,
            'field' => 'exception',
        );
    }
    else{
        $cat_data = getDbData($link, 'category',
            array('repeat_interval', 'color'), array('category_id' => $_POST['cat']));

        if(COLOR_CODE == $retval['rcats']['color']['value']){
            $retval['rcats']['color']['value'] = colorCodeFromInt($cat_data[0]['color'], TRUE);
        }

        if('-1' == $repeat){
            $retval['rcats']['repeat']['value'] = $cat_data[0]['repeat_interval'];
        }
    }
}/*}}}*/
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
