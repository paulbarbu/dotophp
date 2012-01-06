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
 * @verbatim
array(
    'variable11' => array(
        'value' => 42, //the value of the variable
        'cb' => array( //the callbacks must accept the value of the
        //variable as parameter and must return TRUE or FALSE

            'cb11' => array(
                'name' => 'callback_name',

                'assign' => TRUE, //if this entry is TRUE then the
                //retval is not checked anymore insted is assigned back to
                //the variable's value

                'params' => array(42, 'foobar'), //arguments needed by the callback
                //order matters! also see: php.net/call-user-func-array
            ),
            'cb12' => array(
                'assign' => 'FALSE',
                'name' => 'name_of_function',
                'inverse' => TRUE, //if this directive is TRUE then the condition
                //when checking the callback's retval is negated

                'err' => ERR_if_the_callback_returns_FALSE, //this error
                //applies only for this callback

                'return_on_err' => TRUE, // if TRUE the error code is returned
                //right away, if FALSE the error code will be gathered in an array
                //which will be returned at the end of the execution

                'params' => array(42, 'variable11' => '_getRcatsVal', 'foo'),
                //if the array parameter contains an element with the value
                //'_getRcatsVal' then this will call the actual function and get
                //the value of the variable designated by the name in the key('variable11'
                //in this case), this is mainly used for passing the actual
                //value of a variable to the callback if that value changed
                //since the array took form
                //in other words any element of the form:
                //'variable11' => '_getRcatsVal' will be replaced by the
                //variable's value and sent as is to the callback
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
    'table' => 'category', //the variables wil be inserted in this table
);
 * @endverbatim
 */

require_once 'functions.php';

foreach($feedback as $metamodule => $m){
    if(is_array($m)){
        $err = array();

        if(isset($m['rcats'])){
            foreach($m['rcats'] as $metavar => $v){ //iterate through all variables
                if(is_array($v)){

                    if(isset($v['cb']) && is_array($v['cb'])){
                        foreach($v['cb'] as $cb){
                            if(isset($cb['params']) && !empty($cb['params'])){
                                foreach($cb['params'] as $k => $p){
                                    if(is_string($p) && 0 == strcmp($p, '_getRcatsVal')){
                                        $cb['params'][$k] = $p($k, $feedback);
                                    }
                                }

                                $retval = call_user_func_array($cb['name'],
                                            array_values($cb['params']));
                            }
                            else{
                                $retval = call_user_func($cb['name']);
                            }

                            if(isset($cb['inverse']) && $cb['inverse']){
                                $retval = !$retval;
                            }


                            if(!$retval){
                                if(isset($cb['return_on_err']) && $cb['return_on_err']){
                                    return $cb['err'];
                                }
                            }

                            if(isset($cb['assign']) && $cb['assign']){
                                $feedback[$metamodule]['rcats'][$metavar]['value'] = $retval;
                                $v['value'] = $retval;
                            }
                            else if(!$retval){
                                if(isset($v['return_on_err']) && $v['return_on_err']){
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

            if(empty($err)){
                foreach($feedback[$metamodule]['rcats'] as $mm => $value){
                    if(is_array($value)){

                        $data[$value['field']] = $value['value'];
                    }
                }

                if(!$result['connect']){
                    writeLog($config['logger']['category'], '(' . mysqli_connect_errno()
                             . ') ' . mysqli_connect_error() . PHP_EOL);

                    return ERR_DB_CONN;
                }

                if(!insertIntoDB($result['connect'], $feedback[$metamodule]['rcats']['table'], $data)){

                    writeLog($config['logger']['category'], '(' . mysqli_errno($feedback_pre['connect'])
                             . ') ' . mysqli_error($feedback_pre['connect']) . PHP_EOL);

                    return ERR_DB;
                }

                return ERR_NONE;
            }
            else{
                return $err;
            }
        }
    }
}

return TRUE;