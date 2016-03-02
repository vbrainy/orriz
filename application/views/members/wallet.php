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
    <?php $this->load->view('members/dashboard_top'); ?>
	<div class="clearfix"></div>
	<div class="container">
		<div class="refer-points-box">
			<div class="row">
				<div class="col-sm-3">
					<div class="referral-container">
						<div class="referral-buttons-container">
							<a class="referral-button" href="<?php echo base_url('dashboard/reference');?>">Refer A Friend</a>
                            <a href="<?php echo base_url('dashboard/tree');?>" class="referral-button">Your Referral Tree</a>
							<a href="<?php echo base_url('dashboard/table'); ?>" class="referral-button">Your Referral table</a>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="referral-content-container">
						<div class="referral-number">
							<p>Total number of your Direct Referrals: <span class="direct-referral-counting"><?php echo $total_direct_referel; ?></span></p>
						</div>	
						<div class="referral-number">
							<p>Total number of your In-direct Referrals: <span class="in-direct-referral-counting"><?php echo $total_referel-$total_direct_referel; ?></span></p>
						</div>	
					</div>
				</div>
				<div class="col-sm-3">
					<div class="points-container">
						<div class="points-counting-container">
							<div class="points-counting">
								You have <span class="points-number-counting"><?php echo $points; ?></span> Points
							</div>
						</div>
					</div>
					<div class="points-button-container">
					<a href="<?php echo base_url('dashboard/buy'); ?>">	<button class="points-button">Buy Points</button></a>
					<a href="<?php echo base_url('dashboard/reference'); ?>">	<button class="points-button">Earn FREE Points</button>   </a>
						
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