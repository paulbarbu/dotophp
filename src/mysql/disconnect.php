<?php
/**
 * @file src/mysql/disconnect.php
 * @brief Close a connection
 * @author Paul Barbu
 *
 * @ingroup mysqlConn
 */

if(isset($feedback_pre['connect'])){
    mysqli_close($feedback_pre['connect']);
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
