<?php
/**
 * @file src/rcats/rcats.php
 * @brief Reusabe categorization system
 * @author Paul Barbu
 *
 * @ingroup rcatsFiles
 *
 * This meta module should be feed through $feedback with an array of the form:
 *
array(
    'variable11' => array(
        'value' => 42, //the value of the variable
        'cb' => array( //the callbacks must accept the value of the
        //variable as parameter and must return TRUE or FALSE

            'cb11' => array(
                'name' => 'isValidInput',

                'assign' => TRUE, //if this entry is TRUE then the
                //retval is not checked anymore insted is assigned back to
                //the variable's value

                'params' => array(42, 'foobar'), //as needed by the callback, also
                //see: php.net/call-user-func-array
            ),
            'cb12' => array(
                'assign' => 'FALSE',
                'name' => 'hasNoDuplicates',

                'err' => ERR_if_the_callback_returns_FALSE, //this error
                //applies only for this callback, which will ignore the
                //more global 'err'

                'return_on_err' => TRUE, // if TRUE the error codes is returned
                //right away, if FALSE the error code will be gathered in an array
                //which will be returned at the end of the execution
            ),
        ),

        'err' => ERR_returned_if_callbacks_are_FALSE, //the error code
        //assigned to this value, this is returned if any of the callbacks
        //returns FALSE

        'return_on_err' => TRUE, // if TRUE any error codes are returned
        //right away, if FALSE the error codes will be gathered in an array which
        //will be returned at the end of the execution

        'field' => 'name', //the field this value should be inserted
        //into if no errors occured
    ),
    'variable12' => array(
        //the same geometry
    ),
    'table' => 'category', //the variables wil be inserted in this tabl
);
 */

foreach($feedback as $metamodule => $m){
    if(is_array($m)){
        foreach($m as $metavar => $v){ //iterate through all variables
            if(is_array($v)){
                $err = array();

                if(isset($v['cb']) && is_array($v['cb'])){
                    foreach($v['cb'] as $cb){
                        if(isset($cb['params']) && !empty($cb['params'])){
                            $retval = call_user_func_array($cb['name'], $cb['params']);
                        }
                        else{
                            $retval = call_user_func($cb['name']);
                        }

                        if(!$retval){
                            if(isset($cb['return_on_err']) && $cb['return_on_err']){
                                var_dump('cb_err');
                                return $cb['err'];
                            }
                        }

                        if(isset($cb['assign']) && $cb['assign']){
                            $feedback[$metamodule][$metavar]['value'] = $retval;
                            $v['value'] = $retval;
                        }
                        else if(!$retval){
                            if(isset($v['return_on_err']) && $v['return_on_err']){
                                var_dump('err');
                                return $v['err'];
                            }
                            else{
                                $err[] = $v['err'];
                            }
                        }
                    }
                }
            }
        }

        var_dump('---', $err, '---');

        if(empty($err)){
            foreach($feedback[$metamodule] as $mm => $value){
                if(is_array($value)){
                    $data[$value['field']] = $value['value'];
                }
            }

            if(!insertIntoDB($feedback_pre['connect'], $feedback[$metamodule]['table'], $data)){
                var_dump('db');
                return FALSE;
                //TODO check the database errors including the connection ones
                //and return the corresponding error
                ////TODO return errors and get them on VL
            }

            var_dump('none');
            var_dump($module);
            return ERR_NONE;
            //return array('value' => ERR_NONE, 'reload' => TRUE, 'module' => $module);
        }
        else{
            var_dump('errarray');
            return $err;
        }
    }
}
