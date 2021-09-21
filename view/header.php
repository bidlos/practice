<?php
session_start();
require_once __DIR__ . '/../function/function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body style="background-image: url('https://images.unsplash.com/photo-1557626204-59dd03fd2d31?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80'); background-repeat: no-repeat;background-size: cover;">
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Second navbar example">
			<div class="container-xl">
				<a class="navbar-brand" href="index.php"><img src="https://g4u.by/php/img/logoToDo.png" alt=""></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsExample02">
					<ul class="navbar-nav me-auto">
							<?php
if (isset($_SESSION['login'])) {
    ?>
									<li class="nav-item">
											<a class="nav-link active" aria-current="page" href="<?=$_SESSION['login'];?>"><?=$_SESSION['login'];?></a>
									</li>
									<li class="nav-item">
											<a class="nav-link active" aria-current="page" href="?logout">Выйти</a>
									</li>
									<?php
} else {
    ?>
									<li class="nav-item">
										<a class="nav-link submit" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Log In</a>
									</li>
									<?php
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
}
?>
					</ul>
				</div>
			</div>
		</nav><br>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="login.php" method="POST">
							<div class="mb-3">
								<input class="form-control" type="text" name="login" placeholder="Login" aria-label="Login">
							</div>
							<div class="mb-3">
								<input class="form-control" type="password" name="pass" placeholder="Password" aria-label="Password">
							</div>
							<div class="mb-3">
								<button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Войти</button>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
					</div>
				</div>
			</div>
		</div>
	</header>