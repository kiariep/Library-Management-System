<?php
	session_start();
	include("../dbConfig.php");
	//error_reporting(0);
	$username = $_SESSION['username'];

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
        header("location: ../home.php?activity=adminLogin");
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
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
	</head>
	<body>
		<div class="container">
			<div class="header">
				<?php include("../header.php"); ?>
			</div>
			<div class="userContainer">
				<div class="title">Admin Page</div>

				<div class="userWelcome">Welcome : <?php echo $_SESSION['username']; ?></div>

				<div class="logout"><a href="adminPage.php?activity=logout">Logout</a></div>

				<div class="userAction">
					<ul>
						<li><a href="adminPage.php?activity=adminDashboard">Dashboard</a></li>
						<li><a href="adminPage.php?activity=viewProfile">View Profile</a></li>
						<li><a href="adminPage.php?activity=editProfile">Edit Profile</a></li>
						<li><a href="adminPage.php?activity=viewUsers">View Users</a></li>
						<li><a href="adminPage.php?activity=addBooks">Add Books</a></li>
						<li><a href="adminPage.php?activity=viewBooks">View Books</a></li>
						<li><a href="adminPage.php?activity=viewBooksRequest">View Books Request</a></li>
						<li><a href="adminPage.php?activity=issuedBooks">Issued Books</a></li>
						<li><a href="adminPage.php?activity=returnedBooks">Returned Books</a></li>
					</ul>
				</div>

				<div class="userContent">
					<?php
					//ACTIVITY PERFORM...

						$activity = $_REQUEST['activity'];

						switch ($activity) {
							case 'adminDashboard':
								include("adminDashboard.php");
								break;
							
							case 'viewProfile':
								include("viewProfile.php");
								break;

							case 'editProfile':
								include("editProfile.php");
								break;

							case 'viewUsers':
								include("viewUsers.php");	
								break;	

							case 'addBooks':
								include("addBooks.php");
								break;	

							case 'viewBooks':
								include("viewBooks.php");
								break;

							case 'issuedBooks':
								include("issuedBooks.php");
								break;	

							case 'returnedBooks':
								include("returnedBooks.php");
								break;	

							case 'bookDetails':
								include("bookDetails.php");
								break;

							case 'viewUserProfile':
								include("viewUserProfile.php");
								break;

							case 'viewBooksRequest':
								include("viewBooksRequest.php");
								break;

							case 'deleteBook':
									
                                	$deleteBookId = $_REQUEST['deleteBookId'];

                                	$result = mysql_num_rows(mysqli_query("SELECT bookId FROM borrow Where bookId = '$deleteBookId'"));
                                	$availabilityBook = mysql_num_rows(mysqli_query("SELECT bookId FROM books WHERE available = '1' && bookId = '$deleteBookId'"));
                               
                                	if(empty($result) && !empty($availabilityBook)){
                                		$deleteResult = mysqli_query("Delete From books Where bookId = '$deleteBookId'");

                                		header("location: adminPage.php?activity=viewBooks");
                                	}
                                	else{
                                		include("viewBooks.php");
                                		$errorMsg = "Book is issued to someone.So, it can't be deleted until it available to library.";
                                	}

                            	break;

                            case 'deleteReturnedBook':
                            		
                            		$deleteReturnId = $_REQUEST['deleteReturnId'];
                            		$deleteReturnDate = $_REQUEST['deleteReturnDate'];

                                	$result = mysql_num_rows(mysqli_query("SELECT returnId,returnDate FROM borrow Where returnId = '$deleteReturnId' && returnDate = $deleteReturnDate"));
                               
                                	if(empty($result['returnId']) && empty($result['returnDate'])){
                                		$deleteResult = mysqli_query("Delete From borrow Where returnId = '$deleteReturnId' && returnDate = '$deleteReturnDate'");

                                	}
                                	header("location: adminPage.php?activity=returnedBooks");

                            	break;	

                            case 'updateBook':
                            		
                            		$uBookId = $_REQUEST['uBookId'];

                            		if(!empty($uBookId)){

                            			$result = mysqli_fetch_assoc(mysqli_query("SELECT available FROM books WHERE bookId = '$uBookId'"));

                            			if($result['available'] == 1){

	                            			$result = mysqli_fetch_assoc(mysqli_query("SELECT title,author,price,publisher FROM books WHERE bookId = '$uBookId'"));
	                            			?>
	                            			<div class="title">Update Book</div>
	                            			<div class="bookUpdateForm">
	                            				<form action="adminPage.php">
	                            					<input type="text" name="uBookId" value=<?php echo $uBookId; ?> readonly><br>
	                            					<input type="text" name="title" required autofocus placeholder="Book-Name" value=<?php echo $result['title']; ?>><br>
	                            					<input type="text" name="author" required autofocus placeholder="Author-Name" value=<?php echo $result['author'];; ?>><br>
	                            					<input type="text" name="price" required autofocus placeholder="Price" value=<?php echo $result['price'];; ?>><br>
	                            					<input type="text" name="publisher" required autofocus placeholder="Publisher" value=<?php echo $result['publisher'];; ?>><br>

	                            					<input type="submit" name="updateBookBtn" value="Update">
	                            				</form>
	                            			</div>
	                            			<?php
                            			}
                            			else{
                            				include("viewBooks.php");
                            				$errorMsg = "Book is issued to someone. So it can't be edited.";
                            			}
                            		}

                            	break;

                            case 'dBookRequest':
                            			
                            		$rd = $_REQUEST['rd'];

                                	if(!empty($rd)){
                                		$deleteResult = mysqli_query("Delete From requestforbooks Where requestDate = '$rd'");

                                	}
                                	header("location: adminPage.php?activity=viewBooksRequest");

                            	break;
									
							default:
								include("adminDashboard.php");
								break;
						}
					?>

					<?php
					//UPDATE BOOK...

						if(isset($_REQUEST['updateBookBtn'])){

							$uBookId = $_REQUEST['uBookId'];
							$title = $_REQUEST['title'];
							$author = $_REQUEST['author'];
							$price = $_REQUEST['price'];
							$publisher = $_REQUEST['publisher'];

							if(!empty($title) && !empty($author) && !empty($price) && !empty($publisher)){

								$result = mysqli_query("UPDATE books SET title = '$title', author = '$author', price = '$price', publisher = '$publisher' WHERE bookId = '$uBookId'");

								if(!empty($result)){
									header("location: adminPage.php?activity=viewBooks");
								}
							}
							else{
								$errorMsg = "Please! Enter in the Empty Field.";
							}
						}

					?>

					<?php
	                //Edit Admin...

	                    if(isset($_REQUEST['adminUpdateBtn'])){

	                        $uadminId = $_REQUEST['uadminId'];
	                        $firstName = $_REQUEST['firstName'];
	                        $lastName = $_REQUEST['lastName'];
	                        $username = $_REQUEST['username'];
	                        $pwd = $_REQUEST['pwd'];
	                        $email = $_REQUEST['email'];

	                        $imgEdit = $_FILES['imgEdit'];

							$actualFileName = $imgEdit['name'];
							$tmpName = $imgEdit['tmp_name'];
							//$type = $imgEdit['type'];
							//$size = $imgEdit['size'];
							//$error = $imgEdit['error'];
							$targetLocation = "pic/$actualFileName";

							move_uploaded_file($tmpName, $targetLocation);

	                        $query1 = mysqli_query("UPDATE admin Set firstName ='$firstName', lastName ='$lastName', username ='$username', pwd ='$pwd', email ='$email', pic ='$actualFileName' Where id = '$uadminId'");

	                        if($query1){
	                            //$errorMsg = "Updation is successfully done.";
	                            header("location: adminPage.php?activity=viewProfile");
	                        }
	                        //include("editProfile.php");
	                    }    
	                ?>

                    <?php 
                    //ADD BOOK...

                        $query = "Select Max(bookId) From books";
                        $returnD = mysqli_query($con, $query);
                        $result = mysqli_fetch_assoc($returnD);
                        $maxRows = $result['Max(bookId)'];
                        if(empty($maxRows)){
                            $lastRow = $maxRows = 1001;      
                        }else{
                            $lastRow = $maxRows + 1 ;
                        }

                        if(isset($_REQUEST['addBookBtn'])){

                            $bookId = $_REQUEST['bookId'];
                            $bookName = $_REQUEST['bookName'];
                            $authorName = $_REQUEST['authorName'];
                            $bookPrice = $_REQUEST['bookPrice'];
                            $bookPublisher = $_REQUEST['bookPublisher'];

                            if(!empty($bookId) && !empty($bookName) && !empty($authorName)){

                                if($maxRows){

                                    $query = "Insert Into books(bookId,title,author,price,publisher,available) Values('$bookId','$bookName','$authorName','$bookPrice','$bookPublisher','1')";
                                    mysqli_query($con, $query);
                                    $errorMsg = "Book Sucessfully Added.";

                                    $query = "Select Max(bookId) From books";
                                    $returnD = mysqli_query($con, $query);
                                    $result = mysqli_fetch_assoc($returnD);
                                    $maxRows = $result['Max(bookId)'];
                                    if(empty($maxRows)){
                                        $lastRow = $maxRows = 1001;      
                                    }else{
                                        $lastRow = $maxRows + 1 ;
                                    }
                                }
                                else{
                                    $errorMsg = "Table is Empty.";
                                }

                            }
                            else{
                                $errorMsg = "Please! Enter in Empty Field.";
                            }

                            include("addBooks.php");
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