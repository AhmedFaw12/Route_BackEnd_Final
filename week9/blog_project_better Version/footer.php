<?php 
if($active == "Post Edit"){
	$path = "../";
}else{
	$path = "";
}
?>
<!--===============================================================================================-->	
<script src="<?=$path?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=$path?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?=$path?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=$path?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=$path?>vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?=$path?>js/main.js"></script>
	<script src="<?=$path?>js/slideSection.js"></script>
</body>
</html>
