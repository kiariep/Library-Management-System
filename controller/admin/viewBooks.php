<?php
	
	include("../dbConfig.php");

	$query = "SELECT bookId,title,author,available FROM books";
	$returnD = mysqli_query($con, $query);
	$returnD1 = mysqli_query($con, $query);
	$result = mysqli_fetch_assoc($returnD);

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
	</head>
	<body>
		
		<div class="title">Book List</div>
		<table>
			<tr>
				<th>Book Id</th>
				<th>Title</th>
				<th>Author</th>
				<th>Available</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php
				while($result1 = mysqli_fetch_assoc($returnD1)){
				?>
				<tr>
					<td>
						<a href="adminPage.php?activity=bookDetails&selectedBookId=<?php echo $result1['bookId']; ?>"> <?php echo $result1['bookId']; ?> </a>
					</td>
					<td><?php echo ucfirst($result1['title']); ?></td>
					<td><?php echo ucfirst($result1['author']); ?></td>
					<td>
						<?php 
							
							if($result1['available'] == 1){
								echo 'Yes';
							}
							elseif($result1['available'] == 0){
								echo 'No';
							}
						?>
					</td>
					<td>
						<a href="adminPage.php?activity=updateBook&uBookId=<?php echo $result1['bookId'];?>">Edit</a>
					</td>
					<td>
						<a href="adminPage.php?activity=deleteBook&deleteBookId=<?php echo $result1['bookId']; ?>">Delete</a>
					</td>
				</tr>
				<?php
				}
			?>
			
		</table>
	</body>
</html>