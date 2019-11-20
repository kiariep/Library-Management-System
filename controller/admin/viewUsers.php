<?php

	include("../dbConfig.php");

	$query = "SELECT id,firstName,lastName,mobile FROM members";
	$returnD = mysqli_query($con, $query);
	$returnD1 = mysqli_query($con, $query);
	$result = mysqli_fetch_assoc($returnD);
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/viewProfile.css">
	</head>
	<body>
		<div class="title">Member List</div>
		<table>
			<tr>
				<th>Id</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Mobile</th>
				<th>Delete</th>
				
			</tr>

			<?php
				while($result1 = mysqli_fetch_assoc($returnD1)){
				?>
				<tr>
					<td>
						<a href="adminPage.php?activity=viewUserProfile&selectedMemberId=<?php echo $result1['id']; ?>"> <?php echo $result1['id']; ?> </a>
					</td>
					<td><?php echo ucfirst($result1['firstName']); ?></td>
					<td><?php echo ucfirst($result1['lastName']); ?></td>
					<td><?php echo $result1['mobile']; ?></td>
					<td>
						<a href="adminPage.php?activity=deleteMember&deleteMemberId=<?php echo $result1['id']; ?>">Delete</a>
					</td>
				</tr>
				<?php
				}
			
			?>
		</table>
	</body>
</html>
