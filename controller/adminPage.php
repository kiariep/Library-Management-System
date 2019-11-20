<?php
	session_start();
	include("dbConfig.php");

	$username = $_SESSION['username'];

	$result = mysqli_fetch_assoc($con, mysqli_query("SELECT position FROM members WHERE username = '$username'"));

	if($_REQUEST['activity'] == 'logout'){
        $username = null;
        $username ="";
        unset($username);
        
        $_SESSION['username'] = null;
        $_SESSION['username'] ="";
        unset($_SESSION['username']);
        
        session_destroy();
    }

    if(empty($username)){
        header("location: ../home.php?activity=dashboard");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/title.css">
		<link rel="stylesheet" type="text/css" href="../css/userPage.css">
	</head>
	<body>
		<div class="userContainer">
			<div class="title">
				<?php 
					
					if($result['position'] == 'Student'){
						echo "Student Page";
					}
					else if($result['position'] == 'Faculty'){
						echo "Faculty Page";
					}
				?>
			</div>

			<div class="userWelcome">Welcome : <?php echo $_SESSION['username']; ?></div>

			<div class="logout"><a href="members/userPage.php?activity=logout">Logout</a></div>

			<div class="userAction">
				<ul>
					<li><a href="home.php?activity=userDashboard">Dashboard</a></li>
					<li><a href="home.php?activity=issueBooks">Issue Books</a></li>
					<li><a href="home.php?activity=returnBooks">Return Books</a></li>
					<li><a href="home.php?activity=issuedBooks">Issued Books</a></li>
					<li><a href="home.php?activity=returnedBooks">Returned Books</a></li>
				</ul>
			</div>

			<div class="userContent">
				<?php
				//ACTIVITY PERFORM...

					$activity = $_REQUEST['activity'];

					switch ($activity) {
						case 'userDashboard':
							include("userDashboard.php");
							break;
						
						case 'issueBooks':
							include("issueBooks.php");
							break;

						case 'returnBooks':
							include("returnBooks.php");
							break;

						case 'issuedBooks':
							include("issuedBooks.php");	
							break;	

						case 'returnedBooks':
							include("returnedBooks.php");
							break;	

						default:
							# code...
							break;
					}
				?>
			</div>
		</div>
	</body>
</html>