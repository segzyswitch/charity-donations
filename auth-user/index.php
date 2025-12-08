<?php
require '../functions/Controller.php';
$Controller = new Controller;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link rel="icon" href="../assets/favicon.png">
  <title>CharityHub: Admin Login</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <!-- Option 1: Include in HTML -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: seagreen;">

<div class="container vh-100">
	<div class="row h-100">
		<div class="col-sm-4 m-auto py-5">
			<h1 class="bi bi-lock text-center mb-4 text-light"></h1>
			<div class="card">
				<div class="card-body">
					<h3 class="card-title text-center mb-4">Admin Login</h3>
					<form id="loginForm" method="POST">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="auth_username" required class="form-control" />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="auth_pwd" required class="form-control" />
						</div>
						<div class="form-group form">
							<label><input type="checkbox" name="remind" /> Remind me</label>
						</div>
						<div class="feedback mb-3"></div>
						<input type="hidden" name="admin_login" value="1" />
						<button type="submit" class="btn btn-success btn-block submit-btn border-0 p-2" style="background-color:seagreen;">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="_js/script.js"></script>
</body>
</html>