<?php 
require_once "engine.php";

session_start();

$AUTH = new Users;
$login = $_POST['login'];
$password = $_POST['password'];
$is_admin_ = false;

if(isset($_POST['logout']))
{  
	session_start();
    unset($_SESSION['auth']);
    session_destroy();
}

if(isset($_POST['request_admin']))
{  
	$token = $AUTH->getToken($_SESSION['login']);
	if($token != "0")
	{
		if (isset($_COOKIE[$token]))
		{
			$is_admin_ = true;
		}
		else
		{
			$is_admin_ = false;
			$AUTH->setToken($_SESSION['login'], "0");
		}
	}
	else
	{	$svtoken = $AUTH->GenerateString();
		setcookie($svtoken, $svtoken, time()+3600);  /* expire in 1 hour */
		$AUTH->setToken($_SESSION['login'], $svtoken);
	}
}

if(isset($login) && isset($password)){
	if($login != null && $password != null){
		$CheckUser = $AUTH->CheckUser($login, $password);
		if($CheckUser != false){
			$_SESSION['auth'] = true;
       #     $status_code = 'Авторизован: '.$login.' | Переход через 2 секунды';    
		#	header("refresh: 2; url=/profile.php");
			
        } 
		else
		{
				$status_code = 'Неправильный логин/пароль';
		}
    }
	else
	{
			$status_code = 'Заполните все поля!';
    }
}



?>

<html lang="ru">
<head>
	<link rel="icon" href="https://xn--h1aun.xyz/style/favicon.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="https://xn--h1aun.xyz/style/preview.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css">
</head>
<body>
	<div class="container">
		<center><?php if (isset($status_code)){print_r($status_code);} ?></center>
		<div class="row justify-content-md-center">
			<div class="col-md-8 col-lg-6 col-xl-5">
				<div class="card card-red">
					<div class="card-header">
						<ul class="nav nav-tabs card-header-tabs">
							<?php if (empty($_SESSION['auth'])): ?>
								<li class="nav-item">
									<a class="nav-link active" href="/index.php">Вход</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/register.php">Регистрация</a>
								</li>
							<?php else: ?>
								<li class="nav-item">
									<a class="nav-link active" href="">Профиль</a>
								</li>		
							<?php endif; ?>
						</ul>
					</div>
					<div class="card-block">
						<form class="form-horizontal" role="form" method="post" action="">
							<?php if (empty($_SESSION['auth'])): ?>
							<div class="form-group row">
								<label for="username" class="col-sm-4 col-form-label">Логин</label>
									<div class="col-sm-8">
										<input type="text" name="login" id="username" class="form-control " value="" required="" autofocus="">
									</div>
							</div>	
							<div class="form-group  row">
								<label for="password" class="col-sm-4 col-form-label">Пароль</label>
									<div class="col-sm-8">
										<input type="password" name="password" id="password" class="form-control " required="">
									</div>
							</div>
							
								<div class="text-center">
									<button type="submit" class="btn btn-secondary">Войти</button>
								</div>		
							
							<?php else: ?>
							
							<?php 
								if ($is_admin_ == true)
								{
									echo "<div class=\"alert alert-danger\" role=\"alert\">Теперь вам доступна панель администратора!</div>";
								}
							?>
							
							<?php if ($AUTH->getPrivilege($_SESSION['login']) == "Забанен"): ?>
									<div class="alert alert-danger" role="alert">Доступ к запрашиваемому вами ресурсу был ограничен так как вы были заблокированы. Обратитесь к посреднику за информацией.	</div>;
							<?php else: ?>
								<p><center>Вы уже авторизованы</center></p>
								<p><center><?php print_r('Ваш логин: '.$_SESSION['login']); ?></center></p>
								<p><center><?php print_r('Ваша роль: '. $AUTH->getPrivilege($_SESSION['login'])); ?></center></p>
							<?php endif; ?>
								<div class="text-center">
									<button type="submit" name="logout" class="btn btn-secondary">Выход</button>
	
								<?php 
									if ($AUTH->getPrivilege($_SESSION['login']) == "Администратор"){
										echo '<button type="submit" name="request_admin" class="btn btn-secondary">Админ панель</button>';;
									}										
								?>
								</div>	
								
							<?php endif; ?>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
		<script src="https://xn--h1aun.xyz/style/preview.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>
</body>
</html>