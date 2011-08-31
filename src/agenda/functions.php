<?php
/**
 * @file src/agenda/functions.php
 * @brief Category and events home
 * @author Paul Barbu
 *
 * @defgroup agendaFiles Events and Categories
 * @ingroup agendaFiles
 */

/**
 * Adds a new event
 *
 * @param unsigned int $cat_id the category where the event will be created
 * @param string $name event's name, max length: 20 characters
 * @param string $desc event description, default NULL, max length: 100 chars
 * @param int $repeat_interval the interval the event should repeat itself,
 * allowed values: TODO values, default: 0
 * @param unsigned int $color color code, base 10 representation
 * @param unsigned int $priority higher numbers mean higher priority, default: 0
 * @param int $private allowed values: 1(private) or 0(public), default: 0
 * @param int $exception allowed values: 1(exception) or 0(normal), default: 0
 * @param int $start timestamp representing the date and time the event should
 * start
 * @param int $end timestamp representing the date and time the event should
 * end
 *
 * @return an array consisting of a BOOL value and a NULL or the error string,
 * array(BOOL, string)
 */
function addEvent($cat_id, $name, $desc = NULL, $repeat_interval = 0, $color = NULL,
    $priority = 0, $private = 0, $exception = 0, $start = 0, $end = 0
    ){
}

/**
 * Changes an event properties
 *
 * Changes an event's properties that are passed to the function as being NOT
 * NULL
 *
 * @param unsigned int $event_id the event's ID the user itneds to update
 *
 * @return an array consisting of a BOOL value and a NULL or the error string,
 * array(BOOL, string)
 */
function updateEvent($event_id, $cat_id = NULL, $name = NULL, $desc = NULL,
    $repeat_interval = NULL, $color = NULL, $priority = NULL, $private = NULL,
    $exception = NULL, $start = NULL, $end = NULL
    ){

}

/**
 * Deletes an event
 *
 * @param unsigned int $event_id the event's ID the user intends to delete
 */
function delEvent(){
}

function addCat(){
}

function updateCat(){
}

function delCat(){
}
