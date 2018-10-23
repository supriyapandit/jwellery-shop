<?php
    
    require 'config/config.php';

    if ( isset($_GET['cat'])) {
        $cat = $_REQUEST['cat'];
    }   

    try {
        $stmt = $connect->prepare('SELECT * FROM jewels where folder_name = :cat');
        $stmt->execute(array(
            ':cat' => $cat
        ));
        $data = $stmt->fetchAll (PDO::FETCH_ASSOC);


        $stmt = $connect->prepare('SELECT count(*) as cnt, folder_name FROM jewels group by folder_name');
        $stmt->execute(array(
            ':cat' => $cat
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
                    <!-- <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Ladies</li>
                    </ul> -->
                    <br>
                </div>

                <?php include('includes/side-nav.php') ?>

                <div class="col-md-9">
                    <div class="box">
                        <h1 class="text-center"><?php echo $cat; ?></h1>
                        <!-- <p>In our Ladies department we offer wide selection of the best products we have found and carefully selected worldwide.</p> -->
                    </div>

                    <!-- <div class="box info-bar">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 products-showing">
                                Showing <strong>12</strong> of <strong>25</strong> products
                            </div>

                            <div class="col-sm-12 col-md-8  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-number">
                                                <strong>Show</strong>  <a href="#" class="btn btn-default btn-sm btn-primary">12</a>  <a href="#" class="btn btn-default btn-sm">24</a>  <a href="#" class="btn btn-default btn-sm">All</a> products
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-sort-by">
                                                <strong>Sort by</strong>
                                                <select name="sort-by" class="form-control">
                                                    <option>Price</option>
                                                    <option>Name</option>
                                                    <option>Sales first</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="row products">
                             <?php 
                                foreach ($data as $key => $row) {
                                echo '<div class="col-md-4 col-sm-6">';
                                    # code...
                                    echo '<div class="product" style="padding:5px;">';
                                        echo '<div class="flip-container">';
                                            echo '<div class="flipper">';
                                                echo '<div class="front">';
                                                    echo '<a href="detail.php?id='.$row['id'].'">';
                                                        echo '<img src="'.str_replace("../", "", $row['image_path']).'" alt="" class="img-responsive">';
                                                    echo '</a>';
                                                echo '</div>';
                                                echo '<div class="back">';
                                                    echo '<a href="detail.php?id='.$row['id'].'">';
                                                        echo '<img src="'.str_replace("../", "", $row['image_path']).'" alt="" class="img-responsive">';
                                                    echo '</a>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<a href="detail.php?id='.$row['id'].'" class="invisible">';
                                            echo '<img src="" alt="" class="img-responsive">';
                                        echo '</a>';                                        
                                        echo '<div class="text">';
                                            echo '<h3><a href="detail.php?id='.$row['id'].'">'.$row['item_name'].'</a></h3>';
                                            echo '<p class="price"><i class="fa fa-inr"></i> '.$row['price'].'</p>';                                            
                                        echo '</div>';
                                    echo '</div>';
                                                      
                        echo '</div>';
                           } 
                            ?>   
                    </div>
                    <!-- /.products -->

                    <!-- <div class="pages">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a>
                            </li>
                            <li class="active"><a href="#">1</a>
                            </li>
                            <li><a href="#">2</a>
                            </li>
                            <li><a href="#">3</a>
                            </li>
                            <li><a href="#">4</a>
                            </li>
                            <li><a href="#">5</a>
                            </li>
                            <li><a href="#">&raquo;</a>
                            </li>
                        </ul>
                    </div> -->
                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
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