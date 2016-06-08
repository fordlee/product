<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_MODULE' => 'Index', //默认模块
	'APP_GROUP_LIST' =>'emob',
	'APP_GROUP_PATH' => '..',
	'APP_GROUP_MODE' => 1,
	'DEFAULT_GROUP' => 'emob',	

	'DEFAULT_CHARSET' => 'utf-8', // 默认输出编码
	'APP_STATUS' => 'debug', //应用调试模式状态
	'TMPL_PARSE_STRING' => array (// 站点公共目录
				'__PUBLIC__' => __ROOT__ . '/Public' 
	),
	
	'DB_PREFIX' => '',
	//'DB_DSN' => 'mysql://root:xyz@localhost:3306/appemob',//数据库配置
	'DB_DSN' => 'mysql://root:@localhost:3306/appemob',//数据库配置
	'DB_CHARSET'=>'utf8',
		
	'URL_HTML_SUFFIX'=>'',
	'URL_ROUTER_ON'   => false, //开启路由
	'URL_ROUTE_RULES' => array( //定义路由规则
	)
);
?>