<?php
return array(
    'home' => array(
        'VL' => array(
            'title' => 'Home',
            'content' => 'content.php',
        ),
    ),
    'register' => array(
        'VL' => array(
            'title' => 'Register',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
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
