<?php
	
	include("../dbConfig.php");

	$uid = $_SESSION['uid'];

	$query = "SELECT returnBookId,returnId,returnDate FROM borrow Where returnId = '$uid'";
	$returnD = mysqli_query($con, $query);
	$returnD1 = mysqli_query($con, $query);
	$res = mysqli_fetch_assoc($returnD);
?>

<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
	</head>
	<body>
		<div class="title">Returned-Book</div>
		<table>
			<tr>
				<th>Book-ID</th>
				<th>Return-Date</th>
				<th>Delete</th>
			</tr>
			
				<?php
					while($res1 = mysqli_fetch_assoc($returnD1)){
					?>
					<tr>

						<td>
							<a href="userPage.php?activity=bookDetails&selectedBookId=<?php echo $res1['returnBookId'] ; ?>"><?php echo $res1['returnBookId'] ; ?>	
							</a>
						</td>
						<td><?php echo $res1['returnDate']; ?></td>
						<td>
							<a href="userPage.php?activity=deleteReturnedBooksHistory&deleteReturnId=<?php echo $res1['returnId']; ?> & deleteReturnDate=<?php echo $res1['returnDate']; ?>">Delete</a>
						</td>
					</tr>
					<?php
				}
				?>
		</table>
	</body>
</html>