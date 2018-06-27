<!--
Author: Amir Hamdy
Author Mail: amirhamdy4@gmail.com
-->
<?php include_once './includes/app_initialize.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>About Us</title>
        <!-- for-mobile-apps -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Amir Hamdy" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //for-mobile-apps -->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!-- js -->
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <!-- //js -->
        <!-- animation-effect -->
        <link href="css/animate.min.css" rel="stylesheet">
        <script src="js/wow.min.js"></script>
        <script> new WOW().init();</script>
        <!-- //animation-effect -->
        <link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,300italic,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <!-- banner -->
        <?php include_once './banner.php'; ?>
        <!-- //banner -->
        <div class="about-section">
            <!-- partners section -->
            <section class="partners">
                <div class="container">
                    <h3 class="text-center">Our Partners</h3>
                    <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <div class="sliderfig">
                        <ul id="flexiselDemo1">
                            <li>
                                <img src="images/part-img7.jpg" alt="w3layouts" title="w3layouts" class="img-responsive" />
                            </li>
                            <li>
                                <img src="images/part-img6.jpg" alt="w3layouts" title="w3layouts" class="img-responsive" />
                            </li>
                            <li>
                                <img src="images/part-img4.jpg" alt="w3layouts" title="w3layouts" class="img-responsive" />
                            </li>
                            <li>
                                <img src="images/part-img3.jpg" alt="w3layouts" title="w3layouts" class="img-responsive" />
                            </li>
                            <li>
                                <img src="images/part-img2.jpg" alt="w3layouts" title="w3layouts" class="img-responsive" />
                            </li>
                            <li>
                                <img src="images/part-img5.png" alt="w3layouts" title="w3layouts" class="img-responsive" />
                            </li>
                            <li>
                                <img src="images/part-img1.jpg" alt="w3layouts" title="w3layouts" class="img-responsive" />
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- /partners section -->
        </div>
        <!-- footer -->
        <?php include_once './footer.php'; ?>
        <!-- //footer -->


        <!-- js files -->
        <script type="text/javascript">
            $(window).load(function () {
                $("#flexiselDemo1").flexisel({
                    visibleItems: 4,
                    animationSpeed: 1000,
                    autoPlay: true,
                    autoPlaySpeed: 3000,
                    pauseOnHover: true,
                    enableResponsiveBreakpoints: true,
                    responsiveBreakpoints: {
                        portrait: {
                            changePoint: 480,
                            visibleItems: 1
                        },
                        landscape: {
                            changePoint: 640,
                            visibleItems: 2
                        },
                        tablet: {
                            changePoint: 768,
                            visibleItems: 3
                        }
                    }
                });

            });
        </script>
        <script type="text/javascript" src="js/jquery.flexisel.js"></script>
        <!-- /js files -->
    </body>
</html>
