<?php

	include("dbConfig.php");

	$query = mysqli_query($con, "Select count(id) From members Where position = 'Student'");
	$result = mysqli_fetch_assoc($query);

	$query2 = mysqli_query($con, "Select count(bookId) From books");
	$result2 = mysqli_fetch_assoc($query2);

	$query3 = mysqli_query($con, "Select count(id) From members Where position = 'Faculty'");
	$result3 = mysqli_fetch_assoc($query3);

	$query4 = mysqli_query($con, "Select count(publisher) From books Group By publisher");
	$result4 = mysqli_num_rows($query4);
	
	$query5 = mysqli_query($con, "Select sum(price) From books");
	$result5 = mysqli_fetch_assoc($query5);

	$query6 = mysqli_query($con, "Select count(bookId) From books Where available = 1");
	$result6 = mysqli_fetch_assoc($query6);

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
		<link rel="stylesheet" type="text/css" href="../css/title.css">
	</head>
	<body>
		<div class="title">Dashboard</div>
		<div class="containerDashboard">

			<div class="tile">Total Student : <br> <?php echo $result['count(id)'];?></div>

			<div class="tile">Total Book : <br> <?php echo $result2['count(bookId)']; ?></div>

			<div class="tile">Total Faculty : <br> <?php echo $result3['count(id)']?></div>			

			<div class="tile">Total Publishers: <br> <?php echo $result4; ?></div>

			<div class="tile">Price of all books: <br> <?php echo $result5['sum(price)']; ?></div>

			<div class="tile">Books in library: <br> <?php echo $result6['count(bookId)']; ?></div>

		</div>
	</body>
</html>