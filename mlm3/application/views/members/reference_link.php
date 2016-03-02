<!DOCTYPE html>
<html>
<head>
    <title>Site Title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap Css-->
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/bootstrap.min.css" />

    <!--Custom Css-->
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/style.css" />

    <!--Media Queries Css-->
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/screen.css" />

    <!--Jquery-1.11.1.min.js-->
    <script src="<?php  echo base_url(); ?>public/js/jquery-1.11.3.min.js"></script>

    <!--Bootstrap Jquery-->
    <script src="<?php  echo base_url(); ?>public/js/bootstrap.min.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/
           html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/
           respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="yellow-line"></div>
<div class="header-inner-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="navigations">
                    <ul>
                        <li><a href="index.html">HOME</a></li>
                        <li><a href="#">WALLET</a></li>
                    </ul>
                </div>
                <div class="right-menu">
                    <div class="right-menu-button-container">
                        <button class="right-menu-button">
                            <img src="<?php echo base_url(); ?>public/images/setting-icon.png" alt="Settings" />
                        </button>
                    </div>
                    <div class="pop-over-menu">
                        <ul>
                            <li><a href="#">Setting</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="container">
    <div class="refer-points-box">
        <div class="row">
            <div class="col-sm-3">
                <div class="referral-container">
                    <div class="referral-buttons-container">
                        <a class="referral-button" href="<?php echo base_url('dashboard/reference_link');?>">Refer A Friend</a>
                        <button class="referral-button">Your Referral Tree</button>
                        <button class="referral-button">Your Referral table</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="referral-content-container">
                    <div class="referral-number">
                        <p>Reference Link <span class="direct-referral-counting"><?php $segments = array($reference_link);

                                echo site_url($segments); ?></span></p>
                    </div>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="points-container">
                    <div class="points-counting-container">
                        <div class="points-counting">
                            You have <span class="points-number-counting">162</span> Points
                        </div>
                    </div>
                </div>
                <div class="points-button-container">
                    <button class="points-button">Buy Points</button>
                    <button class="points-button">Earn FREE Points</button>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="footer">
    <div class="container">
        <div class="col-xs-12">
            <div class="copyright">
                &copy 2015 Website Name. All rights reserved. <a href="#">Privacy Ploicy</a> | <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="yellow-line"></div>

<!--Marquee Jquery-->
<script src="<?php  echo base_url(); ?>public/js/jquery.marquee.min.js"></script>

<script>
    $(function (){
        $('.footer-gallery').marquee({
            speed: 50000,
            gap: 0,
            delayBeforeStart: 0,
            direction: 'left',
            duplicated: true
        });
    });
    $(".right-menu-button").click(function(){
        $(".pop-over-menu").slideToggle(500);
    });
</script>
</body>
</html>