<?php
	use \Core\Route;
	
	return [
		new Route('/hello/', 'hello', 'index'), // роут для приветственной страницы, можно удалить
		new Route('/my-page1/', 'page', 'show1'),
		new Route('/my-page2/', 'page', 'show2'),
		new Route('/my-act-page1/', 'test', 'act1'),
		new Route('/my-act-page2/', 'test', 'act2'),
		new Route('/my-act-page3/', 'test', 'act3'),
		
		new Route('/test/:var1/:var2/', 'page', 'act'),
	];
	
