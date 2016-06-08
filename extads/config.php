<?php
return array(
    //'配置项'=>'配置值'
    'URL_PATHINFO_DEPR' => '/', //修改URL分隔符

    //URL不区分大小写
    'URL_CASE_INSENSITIVE' => true,

    //限制伪静态后缀
    'URL_HTML_SUFFIX' => 'html|php',

    //数据库相关
    'DB_PREFIX' => '',
    'DB_DSN' => 'mysql://root:@localhost:3306/extads',
    //'DB_DSN' => 'mysql://thehotgames:weekmovie2013@mysql.adonads.com:3306/adonads',//数据库配置
    'DB_CHARSET'=>'utf8',

    'DEFAULT_LANG' => 'en-us',
    //'ERROR_PAGE'=>'/Public/error.html',

    //打开页面跟踪
    //'SHOW_PAGE_TRACE' => true,

    'TMPL_PARSE_STRING' => array(
        '__CSS__' => __ROOT__.'/Public/css',
        '__JS__' => __ROOT__.'/Public/js'
    ),

    //开启路由
    'URL_ROUTER_ON' => true,
    'DEFAULT_TIMEZONE'=>'Europe/Paris',

    //'URL_MODEL' => 2,

    //'TMPL_CACHE_ON' => false,
    //'HTML_CACHE_ON' => false,
);
?>