<?php 
require_once "engine.php";

$AUTH = new Users;
$login = $_POST['login'];
$password = $_POST['password'];

if(isset($login) && isset($password)){
	if($login != null && $password != null){
		$CheckUser = $AUTH->RegUser($login, $password);
		if($CheckUser != false){
            $status_code = 'Зарегестрирован: '.$login.' | Переход через 2 секунды';    
			header("refresh: 2; url=/index.php");
			
        } 
		else
		{
				$status_code = 'Регистрация не была завершена, возможно введенный логин уже существует.';
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
    <title>Регистрация</title>
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
							<li class="nav-item">
								<a class="nav-link" href="/index.php">Вход</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" href="/register.php">Регистрация</a>
							</li>
						</ul>
					</div>
					<div class="card-block">
						<form class="form-horizontal" role="form" method="post" action="">
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
								<button type="submit" class="btn btn-secondary">Зарегистрироваться</button>
							</div>					
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
