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
            'functions' => 'functions.php',
            'register' => 'register.php',
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
            'functions' => 'functions.php',
            'activate' => 'activate.php',
        ),
    ),

    /* recover a lost account */
    'recover' => array(
        'VL' => array(
            'title' => 'Recover account',
            'content' => 'content.php',
        ),
        'BL' => array(
            'functions' => 'functions.php',
            'recover' => 'recover.php',
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
