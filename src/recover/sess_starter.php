<?php

//TODO: think of a more global file

if(!isset($_SESSION)){
    session_set_cookie_params(0, app_path());
    session_start();
}
