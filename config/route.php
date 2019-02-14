<?php
use think\Route;
	Route::rule('index','index/index/');
	Route::rule('computer','index/computer/index');
	Route::rule('ipad','index/ipad/index');
	Route::rule('mobile','index/mobile/index');
	Route::rule('screen','index/screen/index');
	Route::rule('search','index/search/index');
	Route::rule('recommendation','index/recommendation/index');
	Route::rule('login','index/login/index');
	Route::rule('loginOut','index/login/loginOut');
	Route::rule('login/check','index/login/check');
	Route::rule('picture','index/picture/index');
	Route::rule('picture/like','index/picture/like');
	Route::rule('picture/unlike','index/picture/unlike');
	Route::rule('picture/commentAdd','index/picture/commentAdd');
	Route::rule('picture/labelsAdd','index/picture/labelsAdd');