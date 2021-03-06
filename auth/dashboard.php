<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: ../index.php');
	// item_name item_description price size other status image_path folder_name
	$errMsg = '';
	if(isset($_POST['item_upload'])) {			
			// Get data from FROM
			$item_name = $_POST['item_name'];
			$item_description = $_POST['item_description'];
			$price = $_POST['price'];
			$size = $_POST['size'];
			$weight = $_POST['weight'];
			$width = $_POST['width'];
			$instructions = $_POST['instructions'];
			$other = $_POST['other'];
			//$image_path = $_POST['image_path'];
			$folder_name = $_POST['folder_name'];

			//upload an images
			$target_file = "";
			if (isset($_FILES["image_path"]["name"])) {

				$target_file = "../img/".$folder_name."/".basename($_FILES["image_path"]["name"]);
				$file = "../img/".$folder_name;
				if(!is_dir($file)){
					mkdir("../img/".$folder_name);
				}				
				
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
			    $check = getimagesize($_FILES["image_path"]["tmp_name"]);			
			    if($check !== false) {
			    	move_uploaded_file($_FILES["image_path"]["tmp_name"], "../img/".$folder_name."/". $_FILES["image_path"]["name"]);
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image_path.";
			        $uploadOk = 0;
			    }
			}
			//end of image upload

			try {
				$stmt = $connect->prepare('INSERT INTO jewels (item_name, item_description, price, size, weight, width, instructions, other, image_path, folder_name) VALUES (:item_name, :item_description, :price, :size, :weight, :width, :instructions, :other, :image_path, :folder_name)');
				$stmt->execute(array(
					':item_name' =>$item_name,
					':item_description' =>$item_description,
					':price' =>$price,
					':size' =>$size,
					':weight' => $weight, 
					':width' => $width, 
					':instructions' => $instructions,
					':other' =>$other,
					':image_path' =>$target_file,
					':folder_name' =>$folder_name
					));	
				header('Location: dashboard.php?action=reg');
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
	}

	if($_SESSION['role'] == 'admin'){
		$stmt = $connect->prepare('SELECT count(*)  FROM users');
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_ASSOC);
	}	

	if(isset($_GET['action']) && $_GET['action'] == 'reg') {
		$errMsg = 'Uploaded successfull. Thank you';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <title>
        Jewels
    </title>
    <meta name="keywords" content="">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="../css/font-awesome.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet">
    <link href="../css/owl.carousel.css" rel="stylesheet">
    <link href="../css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="../css/style.pink.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="../css/custom.css" rel="stylesheet">
    <script src="../js/respond.min.js"></script>
    <link rel="shortcut icon" href="favicon.png">    
</head>
<body class="mant-bdy">

	<div id="top" style="background: #a94442;">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
               <a class="navbar-brand home" href="../index.php" data-animate-hover="bounce" style="margin-top: -10%;"> Logo </a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu" style="font-size: 16px;">
                    <li><a href="dashboard.php">Admin(<?php echo $_SESSION['fullname'] ?>)</a>
                    </li>
                	<li><a href="dashboard.php">Dashboard</a>
                    </li>
                	<li><a href="list.php">Product List</a>
                    </li>
                    <li><a href="logout.php">Logout</a>
                    </li>                    
                    <!-- <li><a href="contact.html">Contact</a>
                    </li>
                    <li><a href="#">Recently viewed</a> 
                    </li>-->
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-md">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Admin login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email Address/User Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" name="username" required>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
                          </div>
                          <button type="submit" class="btn btn-primary" name='login' value="Login">Submit</button>
                        </form> 

                       <!--  <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.html"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p> -->

                    </div>
                </div>
            </div>
        </div>
    </div>


     <div class="container">
     	<!-- <h2 class="text-center">Hi welcome admin</h2> -->
     	<div class="row">
     		<div class="col-md-10">
     		<h3 class="text-center">Upload Products<small style="color:red;">  <?php echo $errMsg; ?> </small></h3> 
     		    <!-- item_name item_description price size other status image_path image_name -->
            	<form action="" method="post" enctype="multipart/form-data">
            		<div class="row">
            			<div class="col-md-4">
            				<div class="form-group">
			                    <label for="item_name">Item Name</label>
			                    <input type="text" class="form-control" id="item_name" placeholder="Item Name" name="item_name" required>
			                </div>
            			</div>
            			
            			<div class="col-md-4">
            				<div class="form-group">
			                    <label for="price">Price</label>
			                    <input type="text" class="form-control" id="price" placeholder="Price" name="price" required>
			                </div>
            			</div>

            			<div class="col-md-4">
            				<div class="form-group">
			                    <label for="size">Size</label>
			                    <input type="text" class="form-control" id="size" placeholder="Size" name="size" required>
			                </div>
            			</div>
            		</div>

            		<div class="row">
            			<div class="col-md-4">
            				<div class="form-group">
			                    <label for="weight">Weight</label>
			                    <input type="text" class="form-control" id="weight" placeholder="Item Name" name="weight" required>
			                </div>
            			</div>
            			
            			<div class="col-md-4">
            				<div class="form-group">
			                    <label for="width">Width</label>
			                    <input type="text" class="form-control" id="width" placeholder="Width" name="width" required>
			                </div>
            			</div>

            			<div class="col-md-4">
            				<div class="form-group">
			                    <label for="other">Other Details</label>
			                    <input type="textarea" class="form-control" id="other" placeholder="Other" name="other">
			                </div>
            			</div>            			
            		</div>

            		<div class="row"> 
            			<div class="col-md-4">
            				<div class="form-group">
			                    <label for="instructions">Instructions</label>
			                    <textarea rows="4" cols="50" class="form-control" id="instructions" placeholder="Instructions" name="instructions"></textarea>
			                </div>
            			</div>           			
            			
            			<div class="col-md-4">
            				<div class="form-group">
			                    <label for="item_description">Item Description</label>
			                    <textarea rows="4" cols="50" class="form-control" id="item_description" placeholder="Item Description" name="item_description"></textarea>
			                </div>
            			</div>
            		</div>
            		<div class="row">
            			<div class="col-md-4">
            				<div class="form-group">
			                    <label for="folder_name">Select folder name</label>
			                    <select class="form-control" id="folder" name="folder_name">
								    <option value="">Select folder name</option>
								    <option value="Necklace">Necklace</option>
								    <option value="Bangles">Bangles</option>
								    <option value="Earings">Earings</option>
								    <option value="Nate">Nath</option>
								    <option value="Bajuband">Bajuband</option>
								 </select>
			                </div>
            			</div>
            			<div class="col-md-4">
            				<div class="form-group">
			                    <label for="image_path">Upload File</label>
			                    <input type="file" class="form-control" id="image_path" name="image_path" required>
			                </div>
            			</div>
            		</div>
                  <button type="submit" class="btn btn-warning" name='item_upload' value="item_upload">Submit</button>
                </form> 
            </div>
     	</div>            
     </div>

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="../js/jquery-1.11.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.cookie.js"></script>
    <script src="../js/waypoints.min.js"></script>
    <script src="../js/modernizr.js"></script>
    <script src="../js/bootstrap-hover-dropdown.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/front.js"></script>
    
</body>
</html>