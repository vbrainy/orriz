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
<?php $this->load->view('public/top'); ?>
<div class="clearfix"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="front-page-section">
                <div class="front-page-title">
                    <h2>
                        <a href="<?php  echo base_url(); ?>public/#" class="front-page-title-links">Join Now!</a>
                        <a href="<?php  echo base_url(); ?>public/#" class="front-page-title-links">Make Friends!</a>
                        <a href="<?php  echo base_url(); ?>public/#" class="front-page-title-links">Share Life!</a></h2>
                </div>
                <div class="homepage-banner">
                    <img src="<?php  echo base_url(); ?>public/images/home-page-banner.jpg" alt="Home Page Banner" />
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="join-form">
                <form role="form" method="post" action="<?php echo base_url('members/reset_password').'/'.$code; ?>">
                    <div class="form-title">
                        <h5>Password Reset!</h5>
                        <h4>Please Enter Your New Password</h4>
                    </div>
                    <div class="join-form-body">
                        <div style="color:#F9B920 " ><?php echo $this->session->flashdata('message_forgot_password'); ?></div>
                        <div style="color: #F8BB22"> <?php if(isset($message)) echo $message ?>   </div>



                        <div class="join-form-group">
                            <input type="password" placeholder="New Password" id="new_password" value="<?php echo set_value('new_password'); ?>" name="new_password" class="join-form-control" required  />
                        </div>
                        <div class="join-form-group">
                            <input type="password" placeholder="Confirm New Password" id="new_confirm" value="<?php echo set_value('new_confirm'); ?>" name="new_confirm" class="join-form-control" required />
                        </div>
                        <div class="join-form-group">
                            <input type="hidden" placeholder="Email" id="user_id" value="<?php echo $user_id; ?>" name="user_id" class="join-form-control" required />
                        </div>




                        <div class="submit-join-form">
                            <input type="submit" value="Submit" class="join-form-submit-button" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="footer-gallery">
    <ul>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-1.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-2.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-3.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-4.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-5.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-1.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-2.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-3.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-4.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-5.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-1.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-2.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-3.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-4.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-5.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-1.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-2.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-3.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-4.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-5.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-1.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-2.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-3.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-4.jpg" alt="Gallery Images" /></li>
        <li><img src="<?php  echo base_url(); ?>public/images/gallery-image-5.jpg" alt="Gallery Images" /></li>
    </ul>
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
</script>
</body>
</html>