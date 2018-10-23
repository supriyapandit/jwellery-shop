<!-- *** TOPBAR *** -->
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
               <b href="#" data-animate-hover="shake">Call Us: <small>Tel: 0831-2444444 </small>  <small>Mobil: +91 9443333333 </small> </b>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu" style="font-size: 16px;">
                    <?php 
                      if(empty($_SESSION['username'])){
                        echo '<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>';
                      }else{
                        echo '<li class="nav-item">';
                         echo '<a class="nav-link" href="./auth/dashboard.php">Home</a>';
                       echo '</li>';
                      }
                    ?>
                    
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
                        <form action="index.php" method="post">
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