<?php
session_start();
ob_start();
define("APP_DEBUG",true);
header("Content-type: text/html; charset=utf-8");

//定义项目名称和路径
//define('APP_NAME', 'weekmovie');
define('APP_PATH', './App/core/');
//define('GROUP_NAME', 'weekmovie');

require 'ThinkPHP/ThinkPHP.php';
?>