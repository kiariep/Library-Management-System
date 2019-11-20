<?php 

?>

<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link rel="stylesheet" type="text/css" href="../css/title.css">
	</head>
	<body>
		<div class="title">Faculty Login</div>
		<div class="loginContainer">
			<form class="loginForm">
				<div class="formInput">
					<input type="text" name="username" required autofocus placeholder="Username" >
				</div>
				<div class="formInput">
					<input type="password" name="pwd" required autofocus placeholder="password" >
				</div>
					<input type="submit" name="facultyLoginBtn" value="Log In" class="btnLogin">
					<br >
					<a class="forgetPwd" href="home.php?activity=forgetpwd&r=user">Forget Password?</a>
			</form>

			
	    </div>
	</body>
</html>
