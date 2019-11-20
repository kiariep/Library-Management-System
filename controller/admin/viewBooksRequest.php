
<?php
	
	include("../dbConfig.php");

	//$returnD = mysqli_query("SELECT * FROM requestForBooks");
	$returnD1 = mysqli_query($con, "SELECT requestId,bookName,authorName,description,requestDate FROM requestforbooks");
	//$result = mysqli_fetch_assoc($returnD);

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
	</head>
	<body>
		<div class="title">Request For Books</div>
		<div class="requestTable">
			<table>
				<tr>
					<th>Request-Id</th>
					<th>Book-Name</th>
					<th>Author-Name</th>
					<th>Description</th>
					<th>Date</th>
					<th>Delete</th>
				</tr>

				<?php
					while ($result = mysqli_fetch_assoc($returnD1)) {
						?>
						<tr>
							<td>
								<a href="adminPage.php?activity=viewUserProfile&selectedMemberId=<?php echo $result['requestId']; ?>"><?php echo $result['requestId']; ?></a>
							</td>
							<td><?php echo $result['bookName']; ?></td>
							<td><?php echo $result['authorName']; ?></td>
							<td><?php echo $result['description']; ?></td>
							<td><?php echo $result['requestDate']; ?></td>
							<td>
								<a href="adminPage.php?activity=dBookRequest&rd=<?php echo $result['requestDate']; ?>">Delete</a>
							</td>
							
						</tr>
						<?php
					}
				?>

			</table>
		</div>
	</body>
</html>