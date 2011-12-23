<?php
/**
 * @file src/mysql/connect.php
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

/**
 * MySQL host to connect to
 */
defined('MYSQL_HOST') or define('MYSQL_HOST', '');
/**
 * Login name for MySQL
 */
defined('MYSQL_USER') or define('MYSQL_USER', '');
/**
 * Name of the database to use
 */
defined('MYSQL_DATABASE') or define('MYSQL_DATABASE', '');

/**
 * Password for the MySQL user
 */
$mysql_pass = '';

/**
 * Link that will be returned in order to create queries on other modules
 */
$mysql_link = mysqli_connect(MYSQL_HOST, MYSQL_USER, $mysql_pass, MYSQL_DATABASE);

unset($mysql_pass);

if($mysql_link !== FALSE){
    $num_cleaned = clean_expired_sess($mysql_link);

    if($num_cleaned === FALSE){
        writeLog($config['logger']['sess_cleanup'], '(' . mysqli_errno($mysql_link)
                 . ') ' . mysqli_error($mysql_link) . PHP_EOL);
    }
}

return $mysql_link;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
