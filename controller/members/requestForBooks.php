
<?php
	
	$uid = $_SESSION['uid'];

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
	</head>
	<body>
	<div class="title">Request For Books</div>
		<div class="requestContainer">
			<form class="requestForm">
				<div class="formInput">
					<input type="text" name="requestId" value=<?php echo $uid; ?> readonly>
				</div>
				<div class="formInput">
					<input type="text" name="rbookName" required autofocus placeholder="Book-Name" >
				</div>
				<div class="formInput">
					<input type="text" name="rauthorName" required autofocus placeholder="Author-Name">
				</div>
				<div class="formInput">
					<textarea cols="35" rows="3" name="rdescription" placeholder="Description"></textarea>
				</div>
					<input type="submit" name="bookRequestBtn" value="Request" class="btnLogin">
					<br >
			</form>

			
	    </div>
	</body>
</html>