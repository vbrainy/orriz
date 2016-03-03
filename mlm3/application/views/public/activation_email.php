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
                <div class="logo-text">
                    <h1><a href="index.html">Website Logo</a></h1>
                </div>
                <div class="right-menu">
                    <div class="right-menu-button-container">
                        <button class="right-menu-button">
                            <img src="<?php echo base_url();?>/public/images/setting-icon.png" alt="Settings" />
                        </button>
                    </div>
                    <div class="pop-over-menu">
                        <ul>
                            <li><a href="#">Account Setting</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="<?php echo base_url('members/logout') ?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="first-step-form">
                <div class="form-title">
                    <h5>Account Created Successfully</h5>
                </div>
                <div class="step-3-form-body">
                    <div class="join-form-body">
                        <div class="second-step-body-container">
                          <div style="color: #F9B820"> <h4 class="form-tagline">Please check your email and click on the activation link to activate it</h4> </div>
                           <form role="form" method="post" action="<?php echo base_url('dash_board/logout'); ?>">
                               <input type="submit" id="submit" name="submit" value="Finish" class="file-upload-btn" />
                           </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php $this->load->view('public/footer');  ?>
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