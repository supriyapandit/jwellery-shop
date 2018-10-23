<?php    
    require 'config/config.php';
    if ( isset($_GET['id'])) {
        $id = $_REQUEST['id'];
    }   

    try {
        $stmt = $connect->prepare('SELECT * FROM jewels where id = :id');
        $stmt->execute(array(
            ':id' => $id
        ));
        $data = $stmt->fetch(PDO::FETCH_ASSOC); 

        $stmt = $connect->prepare('SELECT * FROM jewels where folder_name = :folder_name');
        $stmt->execute(array(
            ':folder_name' => $data['folder_name']
        ));
        $jewels = $stmt->fetchAll (PDO::FETCH_ASSOC);   

        $stmt = $connect->prepare('SELECT count(*) as cnt, folder_name FROM jewels group by folder_name');
        $stmt->execute(array(
            ':folder_name' => $data['folder_name']
        ));
        $counts = $stmt->fetchALL(PDO::FETCH_ASSOC);
               
    }catch(PDOException $e) {
        $errMsg = $e->getMessage();
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
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="col-md-12">
                    <br>
                    <!-- <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li><a href="#">Ladies</a>
                        </li>
                        <li><a href="#">Tops</a>
                        </li>
                        <li>Neckaless</li>
                    </ul> -->
                </div>
                <?php include('includes/side-nav.php') ?>
                <div class="col-md-9">
                    <div class="row" id="productMain">
                        <div class="col-sm-6">
                            <div id="mainImage">
                              <?php  echo '<img src="'.str_replace("../", "", $data['image_path']).'" alt="" class="img-responsive" data-imagezoom="true">';
                              ?>
                            </div>

                            <div class="ribbon sale">
                                <div class="theribbon">SALE</div>
                                <div class="ribbon-background"></div>
                            </div>
                            <!-- /.ribbon -->

                            <div class="ribbon new">
                                <div class="theribbon">NEW</div>
                                <div class="ribbon-background"></div>
                            </div>
                            <!-- /.ribbon -->

                        </div>
                        <div class="col-sm-6">
                            <div class="box">
                                <h4 class="text-center" style="color: #ffbf00;"><?php echo $data['item_name'] ?></h4>
                                <div class="goToDescription"><?php echo $data['item_description'] ?></div>
                                <div class="price"><i class="fa fa-inr"></i> <?php echo $data['price'] ?></div>

                                <!-- <p class="text-center buttons">
                                    <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a> 
                                    <a href="basket.html" class="btn btn-default"><i class="fa fa-heart"></i> Add to wishlist</a>
                                </p> -->
                                <!-- <div class="text-center">
                                    <b>Contact Us</b>
                                    <br>Plot No. 25 Laxmi Road 
                                    Bharat Nagar Shahapur 
                                    BELGAUM-590009 Karnataka, India.
                                </div>
                                <div>
                                    <b><span class="text-center">Tel: +91 0831 2497650 
                                    <br>Mobile: +91 88677-90751 
                                    <br>Mobile: +91 94485-78191.</span> </b>
                                </div> -->  
                                <a href="#footer"><h3 style="color:darkorange;" class="text-center">Contact Us</h3></a>
                               
                            </div>

                            <div class="row" id="thumbs">
                                <div class="col-xs-4">
                                    <?php  
                                        echo '<a href="'.str_replace("../", "", $data['image_path']).'" class="thumb">';
                                        echo '<img src="'.str_replace("../", "", $data['image_path']).'" alt="" class="img-responsive">';                          
                                        echo '</a>';                                    
                                    ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php
                                        if ($data['folder_name'] === 'Bajuband') {
                                            # code...
                                            echo '<a href="img/Bajuband/back com.JPG" class="thumb">';
                                            echo '<img src="img/Bajuband/back com.JPG" alt="" class="img-responsive">';
                                            echo '</a>';
                                        }else if(is_dir('img/Bangles/'.$data['id'])){                                                                                 echo '<a href="img/Bangles/'.$data['id'].'/'.scandir('img/Bangles/'.$data['id'])[2].'" class="thumb">';
                                            echo '<img src="img/Bangles/'.$data['id'].'/'.scandir('img/Bangles/'.$data['id'])[2].'" alt="" class="img-responsive">';
                                            echo '</a>';
                                        }else{
                                            echo '<a href="'.str_replace("../", "", $data['image_path']).'" class="thumb">';
                                            echo '<img src="'.str_replace("../", "", $data['image_path']).'" alt="" class="img-responsive">';
                                            echo '</a>';
                                        }                                       
                                    ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php
                                        if(is_dir('img/Bangles/'.$data['id'])){                                                                                 echo '<a href="img/Bangles/'.$data['id'].'/'.scandir('img/Bangles/'.$data['id'])[3].'" class="thumb">';
                                            echo '<img src="img/Bangles/'.$data['id'].'/'.scandir('img/Bangles/'.$data['id'])[3].'" alt="" class="img-responsive">';
                                            echo '</a>';
                                        }else{
                                            echo '<a href="'.str_replace("../", "", $data['image_path']).'" class="thumb">';
                                            echo '<img src="'.str_replace("../", "", $data['image_path']).'" alt="" class="img-responsive">';
                                            echo '</a>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box" id="details">
                        <hr>
                        <p>
                            <h4>Product name</h4>
                            <p><?php echo $data['item_name'] ?></p>
                            <h4>Product details</h4>
                            <p><?php echo $data['item_description'] ?></p>
                            <!-- <h4>Material & care</h4>
                            <ul>
                                <li>Polyester</li>
                                <li>Machine wash</li>
                            </ul> -->
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Size</h4>
                                    <p><?php echo $data['size'] ?></p>
                                </div>
                                <div class="col-md-4">
                                     <h4>Width</h4>
                                    <p><?php echo $data['width'] ?></p>
                                </div>
                                <div class="col-md-4">
                                    <h4>Weight</h4>
                                    <p><?php echo $data['weight'] ?></p>
                                </div>
                            </div>

                            <blockquote>
                                <h4>Jewelry Care Instructions</h4>
                                <p><em><?php echo $data['instructions'] ?></em>
                                </p>
                            </blockquote>
                            <hr>
                            <!-- <div class="social">
                                <h4>Show it to your friends</h4>
                                <p>
                                    <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                                    <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                                </p>
                            </div> -->
                    </div>                    

                    <div class="row same-height-row">
                        <!-- <div class="col-md-3 col-sm-6"> -->
                            <div class=""> 
                                <h3 class="text-center">Products viewed recently</h3>
                            </div>
                         <!--</div> -->
                            <?php foreach ($jewels as $key => $row) {
                            # code...                       
                                echo '<div class="col-md-4 col-sm-6">';
                                    echo '<div class="product same-height" style="padding:5px;">';
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
                                        echo '<a href="detail.php" class="invisible">';
                                           echo '<img src="" alt="" class="img-responsive">';
                                        echo '</a>';
                                        echo '<div class="text1">';
                                            echo '<h4>'.$row['item_name'].'</h4>';
                                            echo '<p class="price"><i class="fa fa-inr"></i> '.$row['price'].'</p>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                         } ?>

                    </div>
                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        <?php include('./includes/footer.php') ?>
    </div>
    <!-- /#all -->

    <!-- *** SCRIPTS TO INCLUDE *** -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/imagezoom.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>
</body>
</html>