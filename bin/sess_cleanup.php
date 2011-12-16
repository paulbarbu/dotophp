<?php
/**
 * @file ../bin/sess_cleanup.php
 * @brief Delete the expired sessions
 * @author Paul Barbu
 *
 * @ingroup otherFiles
 */

require '../src/global_functions.php';
require '';
$mysql_link = require '../src/mysql/connect.php';

if($mysql_link !== FALSE){

//sterg sesiunile de pe disc ce nu au corespondent in DB
//iau toate sesiuniele din DB intr-un array $foo
//pt fiecare fisier de sesiune verific sa existe acel id in $foo, daca exista e
//ok, daca nu atunci sterg fisierul si trec mai departe

    $result = mysqli_query($mysql_link, "SELECT id FROM session;");

    $sessids = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $files = find_files_by_mime(session_save_path(), '', TRUE);

    foreach($sessids as $num => $sess){
        var_dump($sess['id']);
        //TODO continue here
    }
}
else{
    writeLog('../logs/sess_cleanup.log', 'Connection error: ('
        . mysqli_connect_errno() . ') ' . mysqli_connect_error() . PHP_EOL);
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
