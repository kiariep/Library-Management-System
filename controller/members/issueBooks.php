
		 
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
	</head>
	<body>
		<div class="issueReturn">
			<div class="title">Issue-Book</div>
			<form action="userPage.php" class="issueReturnForm">
			
				<input type="text" name="issueBookId" required autofocus placeholder="Book-Id"><br>

				<input type="text" name="issuerId" required autofocus placeholder="Issuer-Id" value="<?php echo $_SESSION['uid']; ?>" readonly><br>
				
				<input type="submit" name="issueBtn" value=">>Issue">
				
			</form>
		</div>
	</body>
</html>