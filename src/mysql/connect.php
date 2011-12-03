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
const MYSQL_HOST = '';
/**
 * Login name for MySQL
 */
const MYSQL_USER = '';
/**
 * Name of the database to use
 */
const MYSQL_DATABASE = '';

/**
 * Password for the MySQL user
 */
$mysql_pass = '';

/**
 * Link that will be returned in order to create queries on other modules
 */
$mysql_link = mysqli_connect(MYSQL_HOST, MYSQL_USER, $mysql_pass, MYSQL_DATABASE);

unset($mysql_pass);

return $mysql_link;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
