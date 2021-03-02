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
			<h1>Register</h1>
			<?php if (isset($_SESSION['errorMessage'])) { ?>
				<em><?php echo $_SESSION['errorMessage'];?></em>
			<?php } unset($_SESSION['errorMessage']) ?>
			<form action="<?php echo BASE_URL?>controller/auth.php" method="post">
				<input type="hidden" name="form_url" value="<?php echo BASE_URL?>app/register.php">
				<label for="firstname">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="firstname" placeholder="Firstname" id="firstname" required>

                <label for="lastname">
                    <i class="fas fa-user"></i>
				</label>
				<input type="text" name="lastname" placeholder="lastname" id="lastname" required>

                <label for="phoneNumber">
                    <i class="fas fa-phone"></i>
				</label>
				<input type="text" name="phoneNumber" placeholder="Phone Number" id="phoneNumber" required>

                <label for="email">
                    <i class="fas fa-envelope"></i>
				</label>
				<input type="text" name="email" placeholder="Email" id="email">

                <label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>

				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Register" name="register">
			</form>
		</div>
	</body>
</html>