<?php
	session_start();
	//setting the lang of page
	$lang = "en";
	if(!empty($_SESSION["lang"])){
		$lang = $_SESSION["lang"];
	}

	if($lang == "ar")  require_once("messages_ar.php");
	else require_once("messages_en.php");
?>
<!DOCTYPE html>
<html lang="<?=$lang?>" dir = "<?=$messages["dir"]?>">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"> -->
	<link rel="stylesheet" type="text/css" href="fonts/fontawesome-free-6.1.1-web/css/all.min.css">
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
				<div class="login100-pic js-tilt mt-5" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form " action="register_action.php" method="POST">
					<span class="login100-form-title">
					<?=$messages["Register"]?>
					</span>
					<!-- name -->
					<div class="wrap-input100 validate-input
					<?php if(!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["name"])) echo "alert-validate"?>" 
					
					data-validate = "<?php if(!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["name"])) echo $_SESSION['errors']["name"]?>">

						<input class="input100" type="text" name="name" placeholder="<?=$messages["Name"]?>" value="<?php if(!empty($_SESSION["old_values"]["name"])) echo $_SESSION["old_values"]["name"] ?>">

						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user pr-1" aria-hidden="true"></i>
						</span>
					</div>

					<!-- email -->
					<div class="wrap-input100 validate-input <?php if(!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["email"])) echo "alert-validate"?>" 
					
					data-validate = "<?php if(!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["email"])) echo $_SESSION['errors']["email"]?>">

						<input class="input100" type="text" name="email" placeholder="<?=$messages["Email"]?>" value="<?php if(!empty($_SESSION["old_values"]["email"])) echo $_SESSION["old_values"]["email"] ?>">

						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope pr-1" aria-hidden="true"></i>
						</span>
					</div>
					<!-- mobile -->
					<div class="wrap-input100 validate-input <?php if(!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["mobile"])) echo "alert-validate"?>" 
					
					data-validate = "<?php if(!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["mobile"])) echo $_SESSION['errors']["mobile"]?>">

						<input class="input100" type="text" name="mobile" placeholder="<?=$messages["Mobile"]?>" value="<?php if(!empty($_SESSION["old_values"]["mobile"])) echo $_SESSION["old_values"]["mobile"] ?>">

						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone pr-1"  aria-hidden="true"></i>
						</span>
					</div>
					<!-- password -->
					<div class="wrap-input100 validate-input <?php if(!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["password"])) echo "alert-validate"?>" 
					
					data-validate = "<?php if(!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["password"])) echo $_SESSION['errors']["password"]?>">
						<input class="input100" type="password" name="pass" placeholder="<?=$messages["Password"]?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock pr-1" aria-hidden="true"></i>
						</span>
					</div>
					<!--confirm password -->
					<div class="wrap-input100 validate-input <?php if(!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["confirm_password"])) echo "alert-validate"?>" 
					
					data-validate = "<?php if(!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["confirm_password"])) echo $_SESSION['errors']["confirm_password"]?>">

						<input class="input100" type="password" name="confirm_pass" placeholder="<?=$messages["Confirm Password"]?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock pr-1" aria-hidden="true"></i>
						</span>
					</div>
					<!--gender -->
					<div class="wrap-input100">
						<!-- male -->
						<input type="radio" name="gender" value="male" checked>
						<span><?=$messages["male"]?></span>
						<!-- female -->
						<input type="radio" name="gender" value="female">
						<span><?=$messages["female"]?></span>
					</div>
					

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							<?=$messages["Register"]?>
						</button>
					</div>

					<div class="text-center p-t-12">
						<a class="txt2" href="change_lang.php?lang=en">English</a>
						| <a class="txt2" href="change_lang.php?lang=ar">اللغة العربية</a>
					</div>

					<div class="text-center mt-5">
						<a class="txt2" href="index.php">
							<?=$messages["Already Registered"]?>
							<i class="fa fa-long-arrow-<?=$messages["right"]?> m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<?php 
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