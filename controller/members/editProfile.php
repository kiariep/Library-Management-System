
<?php
	include("../dbConfig.php");

	$uid = $_SESSION['uid'];
    
    $query = mysqli_query($con, "SELECT firstName,lastName,position,mobile,email From members Where id = '$uid'");
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

		<div class="title">Update Member</div>
	    <div class="updatearea">
			<form action="userPage.php" method="POST" enctype="multipart/form-data" class="updateForm">
		        <input type="text" name="umemberId" value=<?php echo $uid; ?> readonly><br>
		        <input type="text" name="firstName" required autofocus pattern="[A-Za-z]{3,}" value=<?php echo $result['firstName']; ?>><br>
		        <input type="text" name="lastName" required autofocus value=<?php echo $result['lastName']; ?>><br>

					<div class="updateFormList" required autofocus>
		            	<select name="position">
		                	<option value="">Select</option>
		                    <option value="Student" <?php if($result['position'] == "Student"){ ?> selected <?php } ?>>Student</option>
		                    <option value="Faculty" <?php if($result['position'] == "Faculty"){ ?> selected <?php } ?> >Faculty</option>
		                </select>
		            </div> <br>

		        <input type="text" name="mobile" required autofocus pattern="[0-9]{10}" value=<?php echo $result['mobile']; ?>><br>
		        <input type="email" name="email" required autofocus value=<?php echo $result['email']; ?>><br>

		        <div class="inputs">
		        	<label>Upload Photo : </label><input type="file" name="imgEdit" value="Upload Photo">
		        </div><br>

		        <input type="submit" name="updateMemberBtn" value="Update"><br>
	        </form>
	    </div>

	</body>
</html>