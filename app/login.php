<?php
require_once '../includes/config.php'
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<?php if (isset($_SESSION['errorMessage'])) { ?>
				<em><?php echo $_SESSION['errorMessage'];?></em>
			<?php } unset($_SESSION['errorMessage']) ?>
			<form action="<?php echo BASE_URL?>controller/auth.php" method="post">
				<input type="hidden" name="form_url" value="<?php echo BASE_URL?>app/login.php">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login" name="login">
			</form>
		</div>
	</body>
</html>