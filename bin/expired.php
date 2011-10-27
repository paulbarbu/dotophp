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

//TODO:
//get pending accounts
//check creation date for pending accounts
//delete the ones older than 7 days

$pending = mysqli_query($feedback_pre['connect'], 'SELECT * FROM pending;');

var_dump(mysqli_fetch_all($pending, MYSQLI_ASSOC));

require '../src/mysql/disconnect.php';
