<?php
/**
 * @file ../bin/sess_cleanup.php
 * @brief Delete the expired sessions
 * @author Paul Barbu
 *
 * @ingroup otherFiles
 */

/**
 * Absolute path to the app
 *
 * must have trailing slash
 */
const ROOT = '';

require ROOT . 'src/global_constants.php';
require ROOT . 'src/global_functions.php';

$mysql_link = require ROOT . 'src/mysql/connect.php';

if($mysql_link !== FALSE){
    $count = 0;
    $err = 0;

    $result = mysqli_query($mysql_link, "SELECT id FROM session;");

    $sessids = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $files = find_files_by_name(session_save_path(), 'sess_*');

    foreach($files as $sess){
        $id = substr($sess, strrpos($sess, '_')+1);

        $found = 0;
        foreach($sessids as $s){
            if($id == $s['id']){
                $found = 1;
                break;
            }
        }

        if(!$found){
            unlink($sess) ? $count++ : $err++;
        }
    }

    writeLog('sess_cleanup', 'Deleted ' . $count . ' session files, '
            . $err . ' errors occured!' . PHP_EOL);
}
else{
    writeLog('sess_cleanup', 'Connection error: ('
        . mysqli_connect_errno() . ') ' . mysqli_connect_error() . PHP_EOL);
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
