<?php
	use \Core\Route;
	
	return [
		new Route('/hello/', 'hello', 'index'),
		new Route('/my-page1/', 'page', 'show1'),
		new Route('/my-page2/', 'page', 'show2'),
		new Route('/my-act-page1/', 'test', 'act1'),
		new Route('/my-act-page2/', 'test', 'act2'),
		new Route('/my-act-page3/', 'test', 'act3'),
		new Route('/test/:var1/:var2/', 'page', 'act'),
		new Route('/num/:var1/:var2/:var3/', 'num', 'sum'),
		new Route('/user/:id/', 'user', 'show'),
		new Route('/user/:id/:key/', 'user', 'info'),
		new Route('/user/all', 'user', 'all'),
		new Route('/users/first/:n/', 'user', 'first'),
		new Route('/page/act/', 'page', 'act_s'),
	];
	
