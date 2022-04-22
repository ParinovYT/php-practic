<?php
namespace Project\Controllers;
use Core\Controller;

class UserController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->users = [
            1 => ['name'=>'user1', 'age'=>'23', 'salary' => 1000],
            2 => ['name'=>'user2', 'age'=>'24', 'salary' => 2000],
            3 => ['name'=>'user3', 'age'=>'25', 'salary' => 3000],
            4 => ['name'=>'user4', 'age'=>'26', 'salary' => 4000],
            5 => ['name'=>'user5', 'age'=>'27', 'salary' => 5000],
        ];
    }
	
    public function show($params) {
            print_r( $this->users[ $params['id']]); 
    }
	
    public function info($params){
        echo $this->users[$params['id']]['name'];
    }

    public function all(){
        $i=1;
        while ($i<5){
            print_r ($this->users[$i]);
            echo '<p></p>';
            $i++;
        }
    }

    public function first($params){
		$i=1;
		$p = (int)$params['n'];
        while ($i<$p+1){
            print_r ($this->users[$i]);
            echo '<p></p>';
            $i++;
        }
    }
}
?> 