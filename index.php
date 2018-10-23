<?php
    require 'config/config.php';

    $stmt = $connect->prepare('SELECT * FROM jewels ORDER BY RAND() limit 30');
    $stmt->execute();
    $data = $stmt->fetchAll (PDO::FETCH_ASSOC);

    //count the number of visitor on click index html
    $count =  fopen("counter/clickcount.txt", "r");
    $counter = (int ) fread($count,20);
    fclose ($count);
    $counter++;
    file_put_contents("counter/clickcount.txt", $counter);
    
    if(isset($_POST['login'])) {

        // Get data from FORM
        $username = $_POST['username'];
        $email = $_POST['username'];
        $password = $_POST['password'];

        try {
            $stmt = $connect->prepare('SELECT * FROM users WHERE username = :username OR email = :email');
            $stmt->execute(array(
                ':username' => $username,
                ':email' => $email
                ));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if($data == false){
                $errMsg = "User $username not found.";
            }
            else {
                if(md5($password) == $data['password']) {
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['fullname'] = $data['fullname'];
                    $_SESSION['role'] = $data['role'];
                    header('Location: auth/dashboard.php');
                    exit;
                }
                else
                    $errMsg = 'Password not match.';
            }
        }
        catch(PDOException $e) {
            $errMsg = $e->getMessage();
        }
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
        jwellery
    </title>
    <meta name="keywords" content="">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="css/style.pink.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/respond.min.js"></script>
    <link rel="shortcut icon" href="favicon.png">
</head>
<body>

    <?php include('includes/top.php') ?>

    <?php include('includes/header.php') ?>

    <?php include('includes/carousel.php') ?>
    
            <!-- *** HOT PRODUCT SLIDESHOW *** -->
            <div id="hot">
                <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2>Hot this week</h2>
                            <pre><h4 class="text-center">Number Of hits: <small style="color:red;"><?php echo $counter ?></small></h4></pre>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="product-slider">
                        <?php 
                            foreach ($data as $row) {
                                # code...
                               echo '<div class="item">';
                                 echo '<div class="product">';
                                         echo '<div class="flip-container">';
                                             echo '<div class="flipper">';
                                                 echo '<div class="front">';
                                                     echo '<a  href="detail.php?id='.$row['id'].'">';
                                                         echo '<img src="'.str_replace("../", "", $row['image_path']).'" alt="" class="img-responsive" style="height: 242px;">';
                                                     echo '</a>';
                                                 echo '</div>';
                                                 echo '<div class="back">';
                                                     echo '<a  href="detail.php?id='.$row['id'].'">';
                                                         echo '<img src="'.str_replace("../", "", $row['image_path']).'" alt="" class="img-responsive" style="height: 242px;">';
                                                     echo '</a>';
                                                 echo '</div>';
                                             echo '</div>';
                                         echo '</div>';
                                         echo '<a href="#" class="invisible">';
                                             echo '<img src="" alt="" class="img-responsive">';
                                         echo '</a>';
                                         echo '<div class="text1">';
                                         echo '<br>';
                                            echo '<b><p class="price">'.$row['item_name'].'</p></b>';
                                            echo '<p class="price"><i class="fa fa-inr"></i> '.$row['price'].'</p>';
                                         echo '</div>';
                                     echo '</div>';
                                 echo '</div>';
                            }                        
                        ?>
                    </div>
                    <!-- /.product-slider -->
                </div>
                <!-- /.container -->

            </div>
            <!-- /#hot -->

            <!-- *** HOT END *** -->

            <!-- *** GET INSPIRED ***
 _________________________________________________________ -->
            <div class="container" data-animate="fadeInUpBig">
                <div class="col-md-12">
                    <div class="box slideshow">
                        <h3>Get Inspired</h3>
                        <p class="lead">Get the inspiration from our world class designers</p>
                        <div id="get-inspired" class="owl-carousel owl-theme">
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired1.JPG" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired2.JPG" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired3.JPG" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *** GET INSPIRED END *** -->

            <!-- *** BLOG HOMEPAGE *** -->

<!--             <div class="box text-center" data-animate="fadeInUp">
                <div class="container">
                    <div class="col-md-12">
                        <h3 class="text-uppercase">From our blog</h3>

                        <p class="lead">What's new in the world of fashion? <a href="blog.php">Check our blog!</a>
                        </p>
                    </div>
                </div>
            </div> -->

            <!-- <div class="container">

                <div class="col-md-12" data-animate="fadeInUp">

                    <div id="blog-homepage" class="row">
                        <div class="col-sm-6">
                            <div class="post">
                                <h4><a href="post.html">Fashion now</a></h4>
                                <p class="author-category">By <a href="#">John Slim</a> in <a href="">Fashion and style</a>
                                </p>
                                <hr>
                                <p class="intro">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean
                                    ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                                <p class="read-more"><a href="post.html" class="btn btn-primary">Continue reading</a>
                                </p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="post">
                                <h4><a href="post.html">Who is who - example blog post</a></h4>
                                <p class="author-category">By <a href="#">John Slim</a> in <a href="">About Minimal</a>
                                </p>
                                <hr>
                                <p class="intro">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean
                                    ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                                <p class="read-more"><a href="post.html" class="btn btn-primary">Continue reading</a>
                                </p>
                            </div>

                        </div>

                    </div>
                </div>
            </div> -->
            <!-- /.container -->

            <!-- *** BLOG HOMEPAGE END *** -->
        </div>
        <!-- /#content -->
        <?php include('./includes/footer.php') ?>

    </div>
    <!-- /#all -->
    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script> 
</body>
</html>