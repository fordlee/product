<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_MODULE' => 'Index', //默认模块
	'APP_GROUP_LIST' =>'emob',
	'APP_GROUP_PATH' => '..',
	'APP_GROUP_MODE' => 1,
	'DEFAULT_GROUP' => 'emob',

	'group_user_db' => array( //各应用安装用户表
		'weekmovie'=>'user_list',
		'tenpic' => 'tenpic_user_list',
		'tarot' => 'tarot_user_list',
		'nima' => 'nima_user_list',
		'shop' => 'shop_user_list'
	),
	
	'URL_MODEL' => '2',
	
	'TMPL_CACHE_ON' =>false, //是否开启模板编译缓存 
	//'SHOW_PAGE_TRACE' =>true, //显示页面Trace信息 
	//'SHOW_ERROR_MSG' =>true, //是否显示错误信息 
	
	'DB_PREFIX' => '',
	//'DB_DSN' => 'mysql://root:xyz@localhost:3306/appemob',//数据库配置
	//'DB_DSN' => 'mysql://thehotgames:weekmovie2013@mysql.thehotgames.com:3306/appemob',//数据库配置
	'DB_DSN' => 'mysql://root:@localhost:3306/appemob',//数据库配置
	'DATA_CACHE_TIME'=>1800,//查询数据缓存
	'DB_SQL_BUILD_CACHE' => true,//SQL解析缓存
	'DB_SQL_BUILD_LENGTH' => 30, // SQL缓存的队列长度

	'URL_HTML_SUFFIX'=>'',
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_ROUTE_RULES' => array( //定义路由规则
			'/user\/register/'=>'game/App/register',
			'/user\/login/'=>'game/App/login'
	),
);
?>