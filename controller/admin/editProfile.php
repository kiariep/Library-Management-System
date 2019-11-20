
<?php
	include("../dbConfig.php");

	$uid = $_SESSION['uid'];
    
    $query = mysqli_query($con, "SELECT firstName,lastName,username,pwd,email From admin Where id = '$uid'");
    $result = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
		<link rel="stylesheet" type="text/css" href="../../css/editProfile.css">
	</head>
	<body>

		<div class="title">Edit Profile</div>
	    <div class="updatearea">
			<form action="adminPage.php" method="POST" enctype="multipart/form-data" class="updateForm">
		        <input type="text" name="uadminId" value=<?php echo $uid; ?> readonly><br>

		        <input type="text" name="firstName" required autofocus placeholder="First Name" pattern="[A-Za-z]{3,}" value=<?php echo $result['firstName']; ?>><br>

		        <input type="text" name="lastName" required autofocus placeholder="Last Name" value=<?php echo $result['lastName']; ?>><br>

				<input type="text" name="username" required autofocus placeholder="Username" value=<?php echo $result['username'] ;?>><br>

				<input type="password" name="pwd" required autofocus placeholder="Password" value=<?php echo $result['pwd']; ?>><br>

		        <input type="email" name="email" required autofocus placeholder="Email" value=<?php echo $result['email']; ?>><br>

		        <div class="inputs">
		        	<label>Upload Photo : </label><input type="file" name="imgEdit" value="Upload Photo">
		        </div><br>

		        <input type="submit" name="adminUpdateBtn" value="Update"><br>
	        </form>
	    </div>

	</body>
</html>