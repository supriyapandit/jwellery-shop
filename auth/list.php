<?php
    
    require '../config/config.php';
    if(empty($_SESSION['username']))
        header('Location: login.php');

    $stmt = $connect->prepare('SELECT * FROM jewels');
    $stmt->execute();
    $jewels = $stmt->fetchAll (PDO::FETCH_ASSOC);

    $errMsg = '';
    if(isset($_GET['action']) && $_GET['action'] == 'reg') {
        $errMsg = 'Update successfull. Thank you';
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
</head>
<body>

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
                    <!-- <li><a href="register.html">Register</a>
                    </li>
                    <li><a href="contact.html">Contact</a>
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
        <h2 class="text-center">Hi welcome admin</h2>
        <div class="row">
            <h3 class="text-center" style="color:red;"><?php echo $errMsg; ?></h3>
            <div class="col-md-10 col-md-offset-1">         
                <h3>List Of Products Uploaded</h3>
                <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Item name</th>
                    <th>Size</th>
                    <th>Width</th>
                    <th>Weight</th>
                    <th>Price</th>
                    <th>Description</th>     
                    <th>Action</th>              
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($jewels as $key => $value) {
                            echo '<tr>';
                                echo '<td>'.$value['id'].'</td>';
                                echo '<td>'.$value['item_name'].'</td>';
                                echo '<td>'.$value['size'].'</td>';
                                echo '<td>'.$value['width'].'</td>';
                                echo '<td>'.$value['weight'].'</td>';
                                echo '<td>'.$value['price'].'</td>';
                                echo '<td width="30%">'.$value['item_description'].'</td>'; 
                                echo '<td><a  href="edit.php?id='.$value['id'].'">Edit</a></td>';                  
                            echo '</tr>';
                        }
                    ?>                 
                </tbody>
              </table>
            </div>
        </div>            
     </div>

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.cookie.js"></script>
    <script src="../js/waypoints.min.js"></script>
    <script src="../js/modernizr.js"></script>
    <script src="../js/bootstrap-hover-dropdown.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/front.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $('.table').dataTable();
    });
</script>
</body>
</html>