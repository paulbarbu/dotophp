<?php
/**
 * @file src/agenda/functions.php
 * @brief Category and events home
 * @author Paul Barbu
 *
 * @ingroup agendaFiles
 */

/**
 * @defgroup agendaFiles Events and Categories
 */

/**
 * Adds a new event
 *
 * @param int $cat_id [1, 2^32) the category where the event will be created
 * @param string $name event's name, min. length: 1 char, max length: 20 characters
 * @param string $desc event description, default NULL, max length: 100 chars
 * @param int $repeat_interval the interval the event should repeat itself,
 * allowed values: {0, 1, 2, 3, 4} (Never, Daily, Weekly, Monthly, Yearly), default: 0
 * @param int $color [1, 2^16) color code, base 10 representation
 * @param int $priority {0, 1, 2, 3} (Low, Medium, High, Urgent), default: 0
 * @param bool $private default: FALSE
 * @param bool $exception default: FALSE
 * @param int $start timestamp representing the date and time the event should
 * start
 * @param int $end timestamp representing the date and time the event should
 * end
 *
 * @return an array consisting of a BOOL value and a NULL or the error string,
 * array(BOOL, string)
 */
function addEvent($cat_id, $name, $desc = NULL, $repeat_interval = 0, $color = NULL,
    $priority = 0, $private = FALSE, $exception = FALSE, $start = 0, $end = 0
    ){
}

/**
 * Changes an event properties
 *
 * Changes an event's properties that are passed to the function as being NOT
 * NULL
 *
 * @param int $event_id [1, s^32) the event's ID the user itneds to update
 * @param int $cat_id [1, 2^32) the category where the event will be created
 * @param string $name event's name, min. length: 1 char, max length: 20 characters
 * @param string $desc event description, default NULL, max length: 100 chars
 * @param int $repeat_interval the interval the event should repeat itself,
 * allowed values: {0, 1, 2, 3, 4} (Never, Daily, Weekly, Monthly, Yearly), default: 0
 * @param int $color [1, 2^16) color code, base 10 representation
 * @param int $priority {0, 1, 2, 3} (Low, Medium, High, Urgent), default: 0
 * @param bool $private default: FALSE
 * @param bool $exception default: FALSE
 * @param int $start timestamp representing the date and time the event should
 * start
 * @param int $end timestamp representing the date and time the event should
 * end
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
 * @param int $event_id [1, 2^32) the event's ID the user intends to delete
 */
function delEvent($event_id){
}

/**
 * Add a new category
 *
 * @param int $user_id [1, 2^16) the user who creates the category
 * @param string $name category's name, min. length: 1 char, max. length: 20
 * chars
 * @param string $description category's description, max. length: 100 chars,
 * default: NULL
 * @param int $repeat_interval the interval the event should repeat itself,
 * allowed values: {0, 1, 2, 3, 4} (Never, Daily, Weekly, Monthly, Yearly), default: 0
 * @param int $color [1, 2^16) color code, base 10 representation
 *
 * @return an array consisting of a BOOL value and a NULL or the error string,
 * array(BOOL, string)
 */
function addCat($user_id, $name, $description = NULL, $repeat_interval = 0,
    $color = NULL
    ){
}

/**
 * Update a category
 *
 * @param int $category_id [1, 2^32) the category's ID that should be modified
 * @param string $name category's name, min. length: 1 char, max. length: 20
 * chars
 * @param string $description category's description, max. length: 100 chars,
 * default: NULL
 * @param int $repeat_interval the interval the event should repeat itself,
 * allowed values: {0, 1, 2, 3, 4} (Never, Daily, Weekly, Monthly, Yearly), default: 0
 * @param int $color [1, 2^16) color code, base 10 representation
 */
function updateCat($category_id, $name = NULL, $description = NULL,
    $repeat_interval = NULL, $color = NULL
    ){
}

/**
 * Delete a category
 *
 * @param int $category_id category's id to be deleted
 *
 * @return an array consisting of a BOOL value and a NULL or the error string,
 * array(BOOL, string)
 */
function delCat($category_id){
}
