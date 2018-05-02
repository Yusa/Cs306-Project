<?php
   session_start();
   $_SESSION["username"] = "";

    require "Query.php";
    Query::connectDatabase();
    $query = "SELECT *
                FROM CATEGORY";
    $result = Query::$conn->query($query);           
    $myarr=array();
    while($row = mysqli_fetch_array($result))
    {
        array_push($myarr, $row);
    }
?>
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Obaju
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
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="shortcut icon" href="favicon.png">



</head>

<body>

    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">

            </div>
            <div class="col-md-6" data-animate="fadeInDown">

                <ul class="menu" data-valid=' <?php echo $_SESSION["valid"]; ?> '>
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                    </li>
                    <li><a href="register.php">Register</a>
                    </li>
                    <li><a href="customer-account.php">Account</a>
                    </li>
                    <li><a href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="false">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="Login.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" name="mail" placeholder="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" name="password" placeholder="password">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-sign-in"></i>Login</button>
                            </p>

                        </form>
                        <p style="color:red" class="text-center text-muted" id="loginError"> </p>
                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.php"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute!</p>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <img src="img/logo.png" alt="Obaju logo" class="hidden-xs">
                    <img src="img/logo-small.png" alt="Obaju logo" class="visible-xs"><span class="sr-only">Obaju - go to homepage</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>

                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="index.php">Home</a>
                    </li>

                     <li class="dropdown yamm-fw">
                        <a href="category.php" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Categories <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                             <h5><a href="category.php">Categories</a></h5>
                                            <ul>
                                                <?php
                                                    $row_number=count($myarr);

                                                    for($i=0;$i<$row_number;$i++)
                                                    {
                                                        $cname=$myarr[$i]['cname'];
                                                        echo "<li>" .$cname.  "</li>";
                                                    }
                                                ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Template <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h5>Shop</h5>
                                            <ul>
                                                <li><a href="index.php">Homepage</a>
                                                </li>
                                                <li><a href="category.php">Category - sidebar left</a>
                                                </li>
                                                <li><a href="category-right.php">Category - sidebar right</a>
                                                </li>
                                                <li><a href="category-full.php">Category - full width</a>
                                                </li>
                                                <li><a href="detail.php">Product detail</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>User</h5>
                                            <ul>
                                                <li><a href="register.php">Register / login</a>
                                                </li>
                                                <li><a href="customer-orders.php">Orders history</a>
                                                </li>
                                                <li><a href="customer-order.php">Order history detail</a>
                                                </li>
                                                <li><a href="customer-wishlist.php">Wishlist</a>
                                                </li>
                                                <li><a href="customer-account.php">Customer account / change password</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Order process</h5>
                                            <ul>
                                                <li><a href="basket.php">Shopping cart</a>
                                                </li>
                                                <li><a href="checkout1.php">Checkout - step 1</a>
                                                </li>
                                                <li><a href="checkout2.php">Checkout - step 2</a>
                                                </li>
                                                <li><a href="checkout3.php">Checkout - step 3</a>
                                                </li>
                                                <li><a href="checkout4.php">Checkout - step 4</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Pages and blog</h5>
                                            <ul>
                                                <li><a href="blog.php">Blog listing</a>
                                                </li>
                                                <li><a href="post.php">Blog Post</a>
                                                </li>
                                                <li><a href="faq.php">FAQ</a>
                                                </li>
                                                <li><a href="text.php">Text page</a>
                                                </li>
                                                <li><a href="text-right.php">Text page - right sidebar</a>
                                                </li>
                                                <li><a href="404.php">404 page</a>
                                                </li>
                                                <li><a href="contact.php">Contact</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">

                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm"></span></a>
                </div>
                <!--/.nav-collapse -->

            </div>

            
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->



    <div id="all">

        <div id="content">

            <div class="container">
                <div class="col-md-12">
                    <div id="main-slider">
                        <div class="item">
                            <img src="img/slide.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/getinspired1.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/slider2.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/main-slider4.jpg" alt="">
                        </div>
                    </div>
                    <!-- /#main-slider -->
                </div>
            </div>

            <!-- *** ADVANTAGES HOMEPAGE ***
 _________________________________________________________ -->
            

            <!-- *** HOT PRODUCT SLIDESHOW ***
 _________________________________________________________ -->
           
            <!-- *** BLOG HOMEPAGE ***
 _________________________________________________________ -->



        </div>
        <!-- /#content -->

        <!-- *** FOOTER ***
 _________________________________________________________ -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 col-sm-6">

                        <h4>Where to find us</h4>

                        <p><strong>Obaju Ltd.</strong>
                            <br>Sabanci University
                            <br>Tuzla/Istanbul
                            <strong>Turkey</strong>
                        </p>
                    </div>
                    <!-- /.col-md-3 -->



                    
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2018 Erguven Okuyucu.</p>

                </div>
                
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->



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
    <script type="text/javascript">
        $(function() {
            //alert($('.menu').data("valid"))
            elements = $('.menu').children();
            if($('.menu').data("valid") == true){
                $.each(elements, function (i, val) {
                    if(i < 2)
                    val.remove();
                })
            }
            else{
                $.each(elements, function (i, val) {
                    if(i > 1)
                    val.remove();
                })
            }
        })
    </script>



</body>

</html>