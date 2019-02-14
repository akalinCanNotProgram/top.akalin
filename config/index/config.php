<?php
return [
    // 视图输出字符串内容替换
    'view_replace_str'       => [
    	'__STATIC__' => '/static/index',
    	 '__CSS__'   => '/static/index/css',
    	  '__JS__'   => '/static/index/js',

    ],
    // 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写
        'auto_rule'    => 2,
        'url_route_on' => true,
    // 是否强制使用路由
   		 'url_route_must'=> false,
];
