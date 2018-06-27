<!--
Author: Amir Hamdy
Author Mail: amirhamdy4@gmail.com
-->
<?php include_once './includes/app_initialize.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contact Us</title>
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
        <script>
            new WOW().init();
        </script>
        <!-- //animation-effect -->
        <link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,300italic,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <!-- banner -->
        <?php include_once './banner.php'; ?>
        <!-- //banner -->
        <div class="contact">
            <div class="container">
                <h2>Contact Us</h2>
                <?php printMSG(); ?>
                <div class="mail-grids wthree-22">
                    <div class="col-md-6 mail-grid-left">
                        <div class="mail-grid-left1">
                            <form action="controllers/contactController.php" method="post">
                                <input type="text" name="name" placeholder="Full Name" required="">
                                <input type="email" name="mail" placeholder="Email" required="">
                                <input type="text" name="subject" placeholder="Subject" required="">
                                <textarea type="text" name="message" required="" onfocus="this.value = '';"
                                          onblur="if (this.value == '') {
                                                      this.value = 'Message...';
                                                  }">Message...</textarea>
                                <input type="submit" name="send" value="Submit Now">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 mail-grid-right">
                        <div class="mail-grid-right1 agile-22">
                            <ul>
                                <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i></li>
                                <li>33 Cheshire Road<span>London</span><span>N22 8JJ</span></li>
                            </ul>
                            <ul>
                                <li><i class="glyphicon glyphicon-send" aria-hidden="true"></i></li>
                                <li><a href="mailto:info@proper-scaffolding.co.uk">info@proper-scaffolding.co.uk</a></li>
                            </ul>
                            <ul>
                                <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i></li>
                                <li>
                                    <span>07708847766</span><span>07871424077</span>
                                </li>
                                <li>
                                    <span> ---- </span><span> ---- </span>
                                </li>
                                <li>
                                    <span>02072062733</span><span>07732200265</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317716.36474145186!2d-0.10159865000001353!3d51.52864165000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C+UK!5e0!3m2!1sen!2s!4v1438097250648" width="0" height="0" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
        <!-- footer -->
        <?php include_once './footer.php'; ?>
        <!-- //footer -->
    </body>
</html>
