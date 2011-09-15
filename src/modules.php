<?php
/**
 * @file src/modules.php
 * @brief Modules declarations
 * @author Paul Barbu
 *
 * @ingroup globalFiles
 *
 * All modules used by dotophp are set here
 */
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

    'auth' => array(
        'preprocess' => array(
            'autologin' => 'autologin.php',
        ),
        'VL' => array(
            'title' => 'Authentication',
            'content' => getStrByState('content_logout.php', 'content_login.php'),
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            //'functions' => 'functions.php',
            'auth' => getStrByState('logout.php', 'login.php'),
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
