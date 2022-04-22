<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class PageController extends Controller
	{
		public function show1()
		{
			echo '1';
		}
		
		public function show2()
		{
			echo '2';
		}
		
		public function act($params)
		{
			var_dump($params); // ['var1' => 'eee', 'var2' => 'bbb']
		}
		
		public function act_s()
		{
			return $this->render('page/act', [
				'header' => 'список юзеров',
				'users'  => ['user1', 'user2', 'user3'],
			]);
		}
		
	}
?>