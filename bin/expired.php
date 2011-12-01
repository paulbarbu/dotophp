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

const ROOT = ''; //must have trailing slash

require ROOT . 'src/global_constants.php';
require ROOT . 'src/global_functions.php';
$feedback_pre['connect'] = require ROOT . 'src/mysql/connect.php';

if($feedback_pre['connect']){
    mysqli_query($feedback_pre['connect'],
        "DELETE FROM user WHERE activated='0000-00-00 00:00:00' AND (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(created))/604799 >= 1;");

    writeLog(ROOT . 'logs/expired.log', 'Expired accounts: ' . mysqli_affected_rows($feedback_pre['connect']) . PHP_EOL);

    require ROOT . 'src/mysql/disconnect.php';
}
else{
    writeLog(ROOT . 'logs/expired.log', 'Connection error: ('
        . mysqli_connect_errno() . ') ' . mysqli_connect_error() . PHP_EOL);
}
