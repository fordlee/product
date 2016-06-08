<?php
    $arr = include './config.php';
    $currArr = array(
        'URL_ROUTE_RULES' =>  array(

        ),
        'MAIL_ADDRESS'=>'do-not-reply@adonads.com', // 邮箱地址
        'MAIL_SMTP'=>'smtp.exmail.qq.com', // 邮箱SMTP服务器
        'MAIL_LOGINNAME'=>'do-not-reply@adonads.com', // 邮箱登录帐号
        'MAIL_PASSWORD'=>'weekmovie2013', // 邮箱密码
        'MAIL_CHARSET'=>'UTF-8',//编码
        'MAIL_AUTH'=>true,//邮箱认证
        'MAIL_HTML'=>true,//true HTML格式 false TXT格式
    );

    return array_merge($arr, $currArr);
?>