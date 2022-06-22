<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt mt-5 pt-1" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>
				<!-- validate-form -->
				<form class="login100-form " action="register_action.php" method="POST">
					<span class="login100-form-title">
						Register
					</span>

					<!-- checking if there are errors -->
					<?php
						session_start();
						// if(!empty($_SESSION["errors"])){
						// 	foreach($_SESSION["errors"] as $error_name => $error_msg){
						// 		echo $error_msg, "<br>";
						// 	}
						// }
					?>
					<!-- Name -->
					<!-- adding alert-validate class, error_msg in data-validate attribute if there is error -->
					<div class="wrap-input100 validate-input 
					<?php  if(!empty($_SESSION['errors']) && !empty($_SESSION['errors']['name'])) echo 'alert-validate';?>"
					
					data-validate = "
					<?php if(!empty($_SESSION['errors']) && !empty($_SESSION['errors']['name'])) echo $_SESSION['errors']['name'];?>">

						<input class="input100" type="text" name="name" placeholder="Name" value="<?php if(!empty($_SESSION['old_values']['name'])){
							echo $_SESSION['old_values']['name'];
						}?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<!-- email -->
					<!-- adding alert-validate class, error_msg in data-validate attribute if there is error -->
					<div class="wrap-input100 validate-input 
					<?php  if(!empty($_SESSION['errors']) && !empty($_SESSION['errors']['email'])) echo 'alert-validate';?>"
					
					data-validate = "
					<?php if(!empty($_SESSION['errors']) && !empty($_SESSION['errors']['email'])) echo $_SESSION['errors']['email'];?>">


						<input class="input100" type="text" name="email" placeholder="Email" value="<?php if(!empty($_SESSION['old_values']['email'])){
							echo $_SESSION['old_values']['email'];
						}?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<!-- mobile -->
					<div class="wrap-input100 validate-input 
					<?php  if(!empty($_SESSION['errors']) && !empty($_SESSION['errors']['mobile'])) echo 'alert-validate';?>"
					
					data-validate = "
					<?php if(!empty($_SESSION['errors']) && !empty($_SESSION['errors']['mobile'])) echo $_SESSION['errors']['mobile'];?>">

						<input class="input100" type="text" name="mobile" placeholder="Mobile" value="<?php if(!empty($_SESSION['old_values']['mobile'])){
							echo $_SESSION['old_values']['mobile'];
						}?>">

						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>
					<!-- password -->
					<div class="wrap-input100 validate-input 
					<?php  if(!empty($_SESSION['errors']) && !empty($_SESSION['errors']['pass'])) echo 'alert-validate';?>"
					
					data-validate = "
					<?php if(!empty($_SESSION['errors']) && !empty($_SESSION['errors']['pass'])) echo $_SESSION['errors']['pass'];?>">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<!-- password-confirmation -->
					<div class="wrap-input100 validate-input 
					<?php  if(!empty($_SESSION['errors']) && !empty($_SESSION['errors']['pass_confirmation'])) echo 'alert-validate';?>"
					
					data-validate = "
					<?php if(!empty($_SESSION['errors']) && !empty($_SESSION['errors']['pass_confirmation'])) echo $_SESSION['errors']['pass_confirmation'];?>">
						<input class="input100" type="password" name="pass_confirmation" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<!-- gender -->
					<div class="wrap-input100">
						<!-- male -->
						<input type="radio" name="gender" value="0" checked>
						<span>Male</span>
						<!-- female -->
						<input type="radio" name="gender" value="1"><span>Female</span>
					</div>
					
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Register
						</button>
					</div>

					<div class="text-center p-t-50">
						<a class="txt2" href="index.php">
							Already Register
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<?php 
//we want the error msg remove when the user refresh the page
if(!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
if(!empty($_SESSION["old_values"])) unset($_SESSION["old_values"]);

?>	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>