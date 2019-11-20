<?php
	session_start();

	include("../dbConfig.php");
	error_reporting(0);

	$username = $_SESSION['username'];

	$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT position FROM members WHERE username = '$username'"));

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
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/userPage.css">
		<link rel="stylesheet" type="text/css" href="../../css/home.css">
		<link rel="stylesheet" type="text/css" href="../../css/header.css">
		<link rel="stylesheet" type="text/css" href="../../css/navigation.css">
	</head>
	<body>
		<div class="container">
			<div class="header">
				<?php include("../header.php"); ?>
			</div>
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

				<div class="logout"><a href="userPage.php?activity=logout">Logout</a></div>

				<div class="userAction">
					<ul>
						<li><a href="userPage.php?activity=viewProfile">View Profile</a></li>
						<li><a href="userPage.php?activity=editProfile">Edit Profile</a></li>
						<li><a href="userPage.php?activity=issueBooks">Issue Books</a></li>
						<li><a href="userPage.php?activity=returnBooks">Return Books</a></li>
						<li><a href="userPage.php?activity=issuedBooks">Issued Books</a></li>
						<li><a href="userPage.php?activity=requestForBooks">Request For Books</a></li>
					</ul>
				</div>

				<div class="userContent">
					<?php
					//ACTIVITY PERFORM...

						$activity = $_REQUEST['activity'];

						switch ($activity) {
							
							case 'issueBooks':
								include("issueBooks.php");
								break;

							case 'returnBooks':
								include("returnBooks.php");
								break;

							case 'issuedBooks':
								include("issuedBooks.php");	
								break;	

							case 'requestForBooks':
								include("requestForBooks.php");
								break;	

							case 'bookDetails':
								include("bookDetails.php");
								break;

							case 'editProfile':
								include("editProfile.php");
								break;

							case 'viewProfile':
								include("viewProfile.php");
								break;

							case 'deleteReturnedBooksHistory':
									
	                                $deleteReturnId = $_REQUEST['deleteReturnId'];
	                                $deleteReturnDate = $_REQUEST['deleteReturnDate'];

	                                $deleteResult = mysqli_query($con, "Delete From borrow Where returnId = '$deleteReturnId' && returnDate = '$deleteReturnDate'");

	                                    if($deleteResult){
	                                        header("location: userPage.php?activity=returnedBooks");
	                                    }

								break;

							default:
								//include("viewProfile.php");
								break;
						}
					?>

					<?php
	                //UPDATE MEMBER...

	                    if(isset($_REQUEST['updateMemberBtn'])){

	                        $umemberId = $_REQUEST['umemberId'];
	                        $firstName = $_REQUEST['firstName'];
	                        $lastName = $_REQUEST['lastName'];
	                        $position = $_REQUEST['position'];
	                        $mobile = $_REQUEST['mobile'];
	                        $email = $_REQUEST['email'];

	                        $imgEdit = $_FILES['imgEdit'];

							$actualFileName = $imgEdit['name'];
							$tmpName = $imgEdit['tmp_name'];
							//$type = $imgEdit['type'];
							//$size = $imgEdit['size'];
							//$error = $imgEdit['error'];
							$targetLocation = "pic/$actualFileName";

							move_uploaded_file($tmpName, $targetLocation);

	                        $query1 = mysqli_query($con, "UPDATE members Set firstName ='$firstName', lastName ='$lastName', position ='$position', mobile ='$mobile', email ='$email', pic = '$actualFileName' Where id = '$umemberId'");

	                        if($query1){
	                            //$errorMsg = "Updation is successfully done.";
	                            header("location: userPage.php?activity=viewProfile");
	                        }
	                        //include("editProfile.php");
	                    }    
	                ?>

					<?php
					//ISSUE BOOK...

						if(isset($_REQUEST['issueBtn'])){ //if click on issue button..

	                        $issueBookId = $_REQUEST['issueBookId'];
	                        $issuerId = $_REQUEST['issuerId'];

	                        if(!empty($issueBookId) && !empty($issuerId)){ //checks that both fields is not empty..

	                        	$query1 = "Select bookId From books Where bookId = '$issueBookId'";
	                            $returnD1 = mysqli_query($con, $query1);
	                            $result1 = mysqli_fetch_assoc($returnD1);

	                            $query2 = "Select id From members Where id = '$issuerId'";
	                            $returnD2 = mysqli_query($con, $query2);
	                            $result2 = mysqli_fetch_assoc($returnD2);

	                            if($issueBookId == $result1['bookId'] && $issuerId == $result2['id']){ //checks that book or issuer id exists or not..

	                                $query3 = "Select bookId,issueId From borrow Where bookId = '$issueBookId'";
	                                $returnD3 = mysqli_query($con, $query3);
	                                $result3 = mysqli_fetch_assoc($returnD3);

	                                    if($issueBookId != $result3['bookId']){//checks that book is already issued or not..

	                                        date_default_timezone_set('Asia/Kolkata');
	                                        $dt = date("y/m/d h:i:s");

	                                        $query = "Insert Into borrow(bookId,issueId,issueDate) Values('$issueBookId','$issuerId','$dt')";        
	                                        $returnD = mysqli_query($con, $query);

	                                        $queryForUnavailableBook = mysqli_query($con, "Update books Set available = 0 Where bookId = '$issueBookId'");

	                                        if($returnD){
	                                            $errorMsg = "Book has been successfully issued.";
	                                        }
	                                        else{
	                                            $errorMsg = "Problem in issueing this book.";
	                                        }
	                                    }
	                                    else{
	                                        $errorMsg = "Already issued to ".$result3['issueId'].".";
	                                    }

	                            }
	                            elseif($issueBookId != $result1['bookId']){
	                                $errorMsg = "Please! Enter valid Book-Id.";
	                            }
	                            elseif($issuerId != $result2['id']){
	                                $errorMsg = "Please! Enter valid Issuer-Id.";
	                            }
	                        }
	                        else{
	                            $errorMsg = "Both fields can't be Empty.";
	                        }

	                        include("issueBooks.php");
	                    }

					?>

					<?php
					//RETURN BOOK...

						if(isset($_REQUEST['returnBtn'])){//checks that return button is clicked or not...

	                        $returnId = $_REQUEST['returnId'];
	                        $returnBookId = $_REQUEST['returnBookId'];

	                        if(!empty($returnId) && !empty($returnBookId)){ //checks that both fields are filled or not...

	                            $query1 = "Select bookId,issueId,returnId From borrow Where bookId = '$returnBookId' && issueId = '$returnId'";
	                            $returnD1 = mysqli_query($con, $query1);
	                            $result1 = mysqli_fetch_assoc($returnD1);

	                            if($returnId == $result1['issueId'] && $returnBookId == $result1['bookId']){ //checks that book is issued or not or student id exists or not...

	                                date_default_timezone_set('Asia/Kolkata');
	                                $dt = date("y/m/d h:i:s");

	                                $query2 = "Update borrow Set returnBookId = '$returnBookId',bookId = '', returnId = '$returnId', issueId = '' , returnDate = '$dt' Where bookId = '$returnBookId' && issueId = '$returnId'";
	                                $returnD2 = mysqli_query($con, $query2);

	                                $queryForAvailableBook = mysqli_query($con, "Update books Set available = 1 Where bookId = '$returnBookId'");
	                                
	                                if($returnD2){ //checks that book is returned or not..
	                                    $errorMsg = "Book has been successfully returned.";
	                                }
	                                else{
	                                    $errorMsg = "Problem in returning this book.";
	                                }

	                            }
	                            else{
	                                $errorMsg = "Book-Id or Issued-Id does not Exists or may not be issued.";
	                            }
	                        }
	                        else{
	                            $errorMsg = "Both fields must be filled.";
	                        }

	                        include("returnBooks.php");
	                    }   

					?>

					<?php
					//REQUEST FOR BOOKS...

						if (isset($_REQUEST['bookRequestBtn'])) {
							
							$requestId = $_REQUEST['requestId'];
							$rbookName = $_REQUEST['rbookName'];
							$rauthorName = $_REQUEST['rauthorName'];
							$rdescription = $_REQUEST['rdescription'];

							if(!empty($requestId) && !empty($rbookName) && !empty($rauthorName)){

								date_default_timezone_set('Asia/Kolkata');
	                            $dt = date("y/m/d h:i:s");

								$query = mysqli_query($con, "INSERT INTO requestforbooks(requestId,bookName,authorName,description,requestDate) VALUES('$requestId','$rbookName','$rauthorName','$rdescription','$dt')");

								if ($query) {
									$errorMsg = "You successfully requested for book.";
								}
							}
							else{
								$errorMsg = "Please! Enter in the empty field.";
							}

							include("requestForBooks.php");
						}

					?>

					<?php
			        if(isset($errorMsg)){
			            ?>
			            <div class="errorMsg"><?php echo $errorMsg; ?></div>
		                <?php	
		        	}
			  		?>

				</div>
			</div>
		</div>
	</body>
</html>