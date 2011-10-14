<?php
/**
 * @file src/mysql_connection/disconnect.php
 * @brief Close a connection
 * @author Paul Barbu
 *
 * @ingroup mysqlConn
 */

if(isset($feedback_pre['connect'])){
    mysqli_close($feedback_pre['connect']);
}
