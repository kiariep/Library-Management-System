
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/title.css">
		<link rel="stylesheet" type="text/css" href="../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link rel="stylesheet" type="text/css" href="../css/table.css">
	</head>
	<body>
		<div class="title">Search</div>
		<form action="home.php" class="searchForm">
			<div class="searchFormList">
				<select name="searchList" required autofocus>
					<option value="">Select an Option:</option>
					<option value="bookId">Book-Id</option>
					<option value="bookName">Book-Name</option>
					<option value="authorName">Author-Name</option>
				</select>
			</div>

			<div>
				<input type="text" name="searchField" class="searchFormField" required autofocus placeholder="Search" value=<?php echo $_REQUEST['searchField']; ?>>
			</div>
		</form>
		
			<div class="title">Book List</div>
			<table>
				<tr>
					<th>Book Id</th>
					<th>Title</th>
					<th>Author</th>
					<th>Price</th>
					<th>Available</th>
				</tr>
			<?php
			while($result1 = mysqli_fetch_assoc($returnD1)){
				//print_r($result1B);
				?>
				<tr>
				<?php
					foreach ($result1 as $k => $v) {	
						?>
							<td>
								<?php 
									if($k == 'bookId'){
										echo $v;
									}
									elseif($k == 'available'){
										if($result1['available'] == 1){
											$v = 'Yes';
										}
										elseif($result1['available'] == 0){
											$v = 'No';
										}
										echo $v;
									}
									else{
										echo ucfirst($v);
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
		</table>
	</body>
</html>