<?php
/**
 * @file ../bin/expired.php
 * @brief Delete the expired accounts
 * @author Paul Barbu
 *
 * @ingroup otherFiles
 *
 * An account is considered expired if it's created and not activated within a
 * week
 */

/**
 * @defgroup otherFiles Other files
 */

$feedback_pre['connect'] = require '../src/mysql/connect.php';

if($feedback_pre['connect']){
    mysqli_query($feedback_pre['connect'],
        "DELETE FROM user WHERE activated='0000-00-00 00:00:00' AND (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(created))/604799 >= 1;");

    require '../src/mysql/disconnect.php';
}
else{
    require '../src/global_functions.php';

    writeLog('../logs/expired.log', date('d.m.Y H:i:s') . ' - Connection error: ('
        . mysqli_connect_errno() . ') ' . mysqli_connect_error() . PHP_EOL);
}
