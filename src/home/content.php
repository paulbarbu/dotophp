<?php

if(!isLoggedIn()){
    echo '<a href="index.php?show=register">Register</a> or
        <a href="index.php?show=auth">Log in</a><br />
        Activation email not received? <a href="index.php?show=notreceived" >Click here</a> to have it resent!';
}
else{
    echo '<a href="index.php?show=auth&action=logout">Log out</a>';
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
