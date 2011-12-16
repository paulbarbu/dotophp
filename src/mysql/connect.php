<?php
/**
 * @file src/mysql_connection/connect.php
 * @brief Connect to the database
 * @author Paul Barbu
 *
 * @ingroup mysqlConn
 *
 * This file returns a link with the connection details for further use with
 * mysqli_query()
 *
 * The link returned will be usable in other modules as $feedback_pre['key']
 *
 * where 'key' is the key of the mysql module in the preprocess part
 */

/**
 * @defgroup mysqlConn Handle a MySQL connection
 */

const MYSQL_HOST = '';
const MYSQL_USER = '';
const MYSQL_DATABASE = '';


$mysql_pass = '';

$mysql_link = mysqli_connect(MYSQL_HOST, MYSQL_USER, $mysql_pass, MYSQL_DATABASE);

unset($mysql_pass);

if($mysql_link !== FALSE){
    $num_cleaned = clean_expired_sess($mysql_link);

    if($num_cleaned === FALSE){
        writeLog('../logs/sess_cleanup.log', '(' . mysqli_errno($mysql_link)
                 . ') ' . mysqli_error($mysql_link) . PHP_EOL);
    }
}

return $mysql_link;
