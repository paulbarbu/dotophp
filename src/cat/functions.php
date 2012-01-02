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
 * Check if the specified category name already exists
 *
 * @param mysqli $link a link identifier returned by mysqli_connect() or mysqli_init(),
 * needed by get_categories()
 * @param int $id user's ID that owns the categories, needed by get_categories()
 * @param string $name the string to be checked, needed by get_categories()
 *
 * @return TRUE if the category name is found in the DB, else FALSE
 */
function isDuplicate($link, $id, $name){/*{{{*/
    return !(bool) count(get_categories($link, $id, $name));
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

/**
 * Callback for RCatS
 *
 * Checks the validity of a category name
 *
 * @param string $name the string to be checked
 *
 * @return TRUE if the string is valid, else FALSE
 */
function isValidCatName($name){/*{{{*/
    if(empty($name) || !isValidNick($name)){
        return FALSE;
    }

    return TRUE;
}/*}}}*/

/**
 * Callback for RCatS
 *
 * Checks the validity of a category description
 *
 * @param string $description the string to be checked
 *
 * @return TRUE if the string is valid, else FALSE
 */
function isValidCatDesc($description){/*{{{*/
    if(!empty($description)){
        if(!isValidDesc($description)){
            return FALSE;
        }
    }

    return TRUE;
}/*}}}*/

/**
 * Callback for RCatS
 *
 * Checks the validity of a category color
 *
 * @param string $color color code to be checked
 *
 * @return TRUE if the code is valid, else FALSE
 */
function isValidCatColor($color){/*{{{*/
    if(!empty($color) && COLOR_CODE != $color){
        if(!isValidColor($color)){
            return FALSE;
        }
    }

    return TRUE;
}/*}}}*/

/**
 * Converts a hex color code to integer
 *
 * If the color code is the default color code shwn to the user that means he
 * didn't change the color so we must fill in the defaults
 *
 * @param string $color the color code to be converted
 *
 * @return int the color code in integer representation
 */
function colorCodeToInt($color){/*{{{*/
    if(COLOR_CODE == $color){
        $color = str_replace('#', '', DEFAULT_COLOR);
    }

    return base_convert(str_replace('#', '', $color), 16, 10);
}/*}}}*/
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
