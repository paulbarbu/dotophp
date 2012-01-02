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
        'pre-process' => array(
            'autologin' => 'auth',
        ),
        'VL' => array(
            'title' => 'Home',
            'content' => 'content.php',
        ),
    ),

    /* Sign up */
    'register' => array(
        'pre-process' => array(
            'sess' => 'session-handler',
            'gen_code' => 'captcha',
            'db' => 'mysql',
        ),
        'VL' => array(
            'title' => 'Register',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'constants' => 'constants.php',
            'functions' => 'functions.php',
            'register' => 'register.php',
        ),
        'post-process' => array(
            'db' => 'mysql',
        ),
    ),

    'notreceived' => array(
        'pre-process' => array(
            'db' => 'mysql',
        ),
        'VL' => array(
            'title' => 'Activation email not received',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'constants' => 'constants.php',
            'notreceived' => 'notreceived.php',
        ),
        'post-process' => array(
            'db' => 'mysql',
        ),
    ),

    /* Activate or recover */
    'activate' => array(
        'pre-process' => array(
            'db' => 'mysql',
        ),
        'VL' => array(
            'title' => 'Activate your account',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'constants' => 'constants.php',
            'functions' => 'functions.php',
            'activate' => 'activate.php',
        ),
        'post-process' => array(
            'db' => 'mysql',
        ),
    ),

    /* Recover a lost account */
    'recover' => array(
        'pre-process' => array(
            'sess' => 'session-handler',
            'db' => 'mysql',
        ),
        'VL' => array(
            'title' => 'Recover account',
            'content' => 'content.php',
        ),
        'BL' => array(
            'constants' => 'constants.php',
            'recover' => 'recover.php',
        ),
        'post-process' => array(
            'db' => 'mysql',
        ),
    ),

    /* Authentify */
    'auth' => array(
        'pre-process' => array(
            'db' => 'mysql',
            'autologin' => 'autologin.php',
        ),
        'VL' => array(
            'title' => 'Auth',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'constants' => 'constants.php',
            'auth' => 'auth.php',
        ),
        'post-process' => array(
            'db' => 'mysql',
        ),
    ),

    /* Inexistent page */
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

    /* Captcha image */
    'captcha' => array(
        'pre-process' => array(
            'code_gen' => 'generate_code.php',
        ),
        'VL' => array(
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'captcha' => 'captcha.php',
        ),
    ),

    /* MySQL connection */
    'mysql' => array(
        'pre-process' => array(
            'connect' => 'connect.php',
        ),
        'VL' => array(
            'show_in_menu' => FALSE,
        ),
        'post-process' => array(
            'disconnect' => 'disconnect.php',
        ),
    ),

    /* Session handler */
    'session-handler' => array (
        'pre-process' => array(
            'start' => 'start.php',
        ),
        'VL' => array(
            'show_in_menu' => FALSE,
        ),
        'post-process' => array(
            'destroy' => 'destroy.php',
        ),
    ),

    /* Upcoming events */
    'upcoming' => array(
        'pre-process' => array(
            'autologin' => 'auth',
            'db' => 'mysql',
        ),
        'VL' => array(
            'title' => 'Upcoming',
            'login_need' => TRUE,
            'content' => 'content.php',
        ),
        'BL' => array(
            'constants' => 'constants.php',
            'functions' => 'functions.php',
            'upcoming' => 'upcoming.php',
        ),
    ),

    /* Manage categories */
    'cat' => array(
        'pre-process' => array(
            'autologin' => 'auth',
            'db' => 'mysql',
            'rcats' => 'rcats',
        ),
        'VL' => array(
            'title' => 'Manage categories',
            'login_need' => TRUE,
            'content' => 'content.php',
        ),
        'BL' => array(
            'constants' => 'constants.php',
            'functions' => 'functions.php',
            'category' => 'category.php',
        ),
    ),

    /* Manage events */
    'event' => array(
        'pre-process' => array(
            'autologin' => 'auth',
            'db' => 'mysql',
        ),
        'VL' => array(
            'title' => 'Manage events',
            'login_need' => TRUE,
            'content' => 'content.php',
        ),
        'BL' => array(
            'constants' => 'constants.php',
            'functions' => 'functions.php',
            'event' => 'event.php',
        ),
    ),

    /* Manage user profile */
    'profile' => array(
        'pre-process' => array(
            'autologin' => 'login',
            'db' => 'mysql',
        ),
        'VL' => array(
            'title' => 'Profile',
            'login_need' => TRUE,
            'content' => 'content.php',
        ),
        'BL' => array(
            'constants' => 'constants.php',
            'functions' => 'functions.php',
            'profile' => 'profile.php',
        ),
    ),

    /* Reusable categorization system */
    'rcats' => array(
        'pre-process' => array(
            'db' => 'mysql',
            'rcats' => 'rcats.php',
        ),
        'VL' => array(
            'show_in_menu' => FALSE,
        ),
    ),
);
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
