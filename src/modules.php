<?php
return array(
    'home' => array(
        'pre-process' => array(
            'autologin' => 'login_user',
        ),
        'VL' => array(
            'title' => 'Home',
            'content' => 'content.php',
        ),
    ),
    '404' => array(
        'VL' => array(
            'title' => 'Inexistent page',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
            'custom' => TRUE,
        ),
        'BL' => array(
            'notfound' => '404.php',
        ),
    ),
);
