<?php
	
	include("../dbConfig.php");

	$query = "SELECT bookId,issueId,issueDate FROM borrow WHERE issueId > 0";
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
		<div class="title">Issued-Book</div>
		<table>
			<tr>
				<th>Book-ID</th>
				<th>Issue-ID</th>
				<th>Issue-Date</th>
			</tr>
			
				<?php
					while($res1 = mysqli_fetch_assoc($returnD1)){
					?>
					<tr>
					<?php
					foreach ($res1 as $k => $v) {
						?>
							<td>
								<?php 
									if($k == 'bookId'){
										?>
										<a href="adminPage.php?activity=bookDetails&selectedBookId=<?php echo $v; ?>"><?php echo $v; ?></a>
										<?php
									}
									else if($k == 'issueId'){
										?>
										<a href="adminPage.php?activity=viewUserProfile&selectedMemberId=<?php echo $v; ?>"><?php echo $v; ?></a>
										<?php
									}
									else{
										echo $v;
									}

								?>
							</td>
						<?php
					}
					?>
					</tr>
					<?php
				}
				?>
			</tr>
		</table>
	</body>
</html>