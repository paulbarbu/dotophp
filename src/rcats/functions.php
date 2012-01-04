<?php
/**
 * @file src/rcats/rcats.php
 * @brief Reusabe categorization system
 * @author Paul Barbu
 *
 * @ingroup rcatsFiles
 */

/**
 * @defgroup rcatsFiles Reusable Categorization System files
 */

/**
 * Get a value frm the array used by rcats
 *
 * Useful when the callbacks assign new values
 *
 * @param string $var the name of the variable whos value shold be returned
 * @param array $source the array where the variable should be found, the array
 * must be "geometrized" as a rcats compatible one
 *
 * @return the value of the variable or NULL if that variable is not found
 */
function _getRcatsVal($var, $source){/*{{{*/
    foreach($source as $metamodule => $m){
        if(is_array($m)){
            if(isset($m['rcats']) && !empty($m['rcats'])){
                foreach($m['rcats'] as $var_name => $v){
                    if($var_name == $var){
                        return $v['value'];
                    }
                }
            }
        }
    }

    return NULL;
}/*}}}*/
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
