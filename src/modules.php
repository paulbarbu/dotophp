<?php
return array(
    /* Home page */
    'home' => array(
        'VL' => array(
            'title' => 'Home',
            'content' => 'content.php',
        ),
    ),

    /* sign up */
    'register' => array(
        'VL' => array(
            'title' => 'Register',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'register' => 'register.php',
            'functions' => 'functions.php',
        ),
    ),

    /* activate or recover */
    'activate' => array(
        'VL' => array(
            'title' => 'Activate',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'activate' => 'activate.php',
            'functions' => 'functions.php',
        ),
    ),

    /* inexistent page */
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

    /* captcha image */
    'captcha' => array(
        'VL' => array(
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'captcha' => 'captcha.php',
        ),
    ),
);
