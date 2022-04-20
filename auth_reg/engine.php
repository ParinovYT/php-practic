<?php

error_reporting(E_ERROR | E_PARSE);

$db = mysqli_connect("127.0.0.1","root","","users");
if(!$db){
	exit('Ошибка подключения к базе данных.');
}
mysqli_set_charset($db,'utf8');


class Users
{

	function GenerateString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function setToken($login, $svtoken) {
		global $db;
		$login = htmlspecialchars(mysqli_escape_string($db, $login));
		$sql = "UPDATE accs SET token = '$svtoken' WHERE login = '$login'";
		mysqli_query($db, $sql);
		return true;
	}
	
	function getToken($login){
		global $db;
		$login = htmlspecialchars(mysqli_escape_string($db, $login));
		$sql = "SELECT * FROM accs WHERE login = '{$login}'";
		$query = mysqli_query($db, $sql);
		$sv = mysqli_fetch_assoc($query);
		return $sv['token'];
	}	
	
	function CheckUserByRegistartion($login){
		global $db;
		
		$login = htmlspecialchars(mysqli_escape_string($db, $login));
		
		$sql = "SELECT * FROM accs WHERE login = '{$login}'";
		$query = mysqli_query($db, $sql);
		$count = mysqli_num_rows($query);
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}	
		
	function CheckUser($login , $password){
		global $db;
		
		$login = htmlspecialchars(mysqli_escape_string($db, $login));
		$password = htmlspecialchars(mysqli_escape_string($db, md5($password)));
		
		#md5 
		$pas = md5($password);
		
		$sql = "SELECT * FROM accs WHERE login = '{$login}' and `password` = '{$pas}'";
		$query = mysqli_query($db, $sql);
		$count = mysqli_num_rows($query);
		if ($count > 0) {
			$_SESSION['login'] = $login;
			return true;
		} else {
			return false;
		}
	}
	
	function RegUser($login , $password){
		global $db;
		
		$login = htmlspecialchars(mysqli_escape_string($db, $login));
		$password = htmlspecialchars(mysqli_escape_string($db, md5($password)));
		#md5 
		$pas = md5($password);
		
		$sql = "INSERT INTO accs (`login`, `password`) VALUES ('$login', '$pas')";	
		$kCheckUser = Users::CheckUserByRegistartion($login);
		
		if($kCheckUser == false) {
			mysqli_query($db, $sql);
			return true;
		}
		else {
			return false;
		}
	}
	
	function getUserIP() 
	{
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	function getPrivilege($login){
		global $db;
		$login = htmlspecialchars(mysqli_escape_string($db, $login));
		$sql = "SELECT * FROM accs WHERE login = '{$login}'";
		$query = mysqli_query($db, $sql);
		$sv = mysqli_fetch_assoc($query);
		
		if($sv['privilege'] == "user")
		{
			return "Пользователь";
		}
		else if($sv['privilege'] == "banned")
		{
			return "Забанен";
		}
		if($sv['privilege'] == "admin")
		{
			return "Администратор";
		}
		else
		{
			return "Пользователь";
		}
		
	}	
}
?>
