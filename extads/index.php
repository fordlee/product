<?php
    session_start();
    ini_set('session.cookie_lifetime', 3600*24*30);
    define('ROOTPATH', __DIR__);
    define('APP_NAME', 'Home');
    define('APP_PATH', './Home/');
    define('APP_DEBUG', true);

    require './ThinkPHP/ThinkPHP.php';
?>