<?php
/**
 * @file src/category/category.php
 * @brief Category's functions
 * @author Paul Barbu
 *
 * @ingroup catFiles
 */

/**
 * Retrieve user's categories
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init()
 * @param int $user_id user's ID that owns the categories
 * @param string $name optional, if this parameter is provided only the
 * categories matching the name will be selected
 * @param const $resulttype optional parameter,(default: MYSQLI_ASSOC) a constant
 * indicating what type of array should be produced by mysqli_fecth_all() the possible
 * values for this parameter are the constants MYSQLI_ASSOC, MYSQLI_NUM, or MYSQLI_BOTH.
 *
 * @return FALSE on error, else an array as returned by
 * mysqli_fetch_all($foo, MYSQLI_ASSOC)
 */
function get_categories($link, $user_id, $name = NULL, $resulttype = MYSQLI_ASSOC){/*{{{*/
    $query = 'SELECT name, description, repeat_interval, color, category_id FROM category WHERE user_id='
        . $user_id;

    if(isset($name)){
        $query .= " AND name='" . $name . "';";
    }

    $result = mysqli_query($link, $query);

    if(!$result){
        return FALSE;
    }

    return mysqli_fetch_all($result, $resulttype);
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

    $hexcolor = str_pad(dechex($element['color']), 6, '0', STR_PAD_LEFT);

    $out = '<div style="background-color:#' . $hexcolor . ';color:#' .
        getContrastColor($hexcolor) . '">' . $element['name'];

    $out .= '<span class="toRight">' . $REPEATS[$element['repeat_interval']] . '</span>';

    $out .= '</div>' . PHP_EOL;

    if(!empty($element['description'])){
        $out .= '&nbsp; ' . $element['description'];
    }

    return $out;
}/*}}}*/
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
