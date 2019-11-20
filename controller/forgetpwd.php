

<?php
	
	$r = $_REQUEST['r'];

?>

<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link rel="stylesheet" type="text/css" href="../css/title.css">
	</head>
	<body>
		<div class="title">Forget Recovery</div>
		<div class="forgetContainer">
			<form class="forgetForm">
				<div class="formInput">
					<input type="hidden" name="request" value=<?php echo $r;?>>
				</div>
				<div class="formInput">
					<input type="email" name="regEmail" required autofocus placeholder="Registered Email">
				</div>
				<div class="formInput">
					<input type="password" name="newP" required autofocus placeholder="New Password">
				</div>
				<div class="formInput">
					<input type="password" name="confirmP" required autofocus placeholder="Confirm Password" >
				</div>
					<input type="submit" name="pwdSaveBtn" value="Save" class="btnLogin">
					<br >
					<a class="backToHome" href="home.php?activity=dashboard">Back To Home</a>
			</form>
	    </div>
	</body>
</html>