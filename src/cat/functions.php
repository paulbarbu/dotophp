<?php
/**
 * @file src/category/category.php
 * @brief Category's functions
 * @author Paul Barbu
 *
 * @ingroup catFiles
 */

/**
 * Check if the specified category name already exists
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 * @param int $id user's ID that owns the categories
 * @param string $name category's name to be checked
 *
 * @return TRUE if the category name is found in the DB, else FALSE
 */
function isDuplicate($link, $id, $name){/*{{{*/
    return (bool) count(getDbdata($link, 'category', array('name', 'description',
                            'repeat_interval', 'color', 'category_id'),
                            array('user_id' => $id, 'condition' => 'AND', 'name' => $name)));
}/*}}}*/

/**
 * Helper function to styleize the categories contents
 *
 * @param array $element the array to be formatted
 *
 * @return string the formatted output
 */
function format_cat($element){/*{{{*/
    require 'constants.php';

    $hexcolor = colorCodeFromInt($element['color']);

    $out = '<div style="background-color:#' . $hexcolor . ';color:#' .
        getContrastColor($hexcolor) . '">' . $element['name'];

    if($element['repeat_interval']){
        $out .= '<span class="toRight">' . $REPEATS[$element['repeat_interval']] . '</span>';
    }

    $out .= '</div>' . PHP_EOL;

    if(!empty($element['description'])){
        $out .= '&nbsp; ' . $element['description'];
    }

    return $out;
}/*}}}*/
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
