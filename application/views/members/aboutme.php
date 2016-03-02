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
				<div class="second-step-form">
					<div class="form-title">
						<h5>Step 2 of 3 - Add About Yourself</h5>

					</div>
					<div class="join-form-body">
						<div class="second-step-body-container">
							<h4 class="form-tagline">Tell more about yourself</h4>
							<form role="form" METHOD="post" action="<?php echo base_url('dashboard/aboutyourself'); ?>">
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Music:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Fav. Music" name="music" class="join-form-control second-form-textarea"></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Movies:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Fav. Movies" name="movies" class="join-form-control second-form-textarea"></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">TV:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Fav. TV Shows" name="tv" class="join-form-control second-form-textarea"></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Books:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Fav. Books" name="books" class="join-form-control second-form-textarea"></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Sports:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Fav. Sports" name="sports" class="join-form-control second-form-textarea"></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Interests:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Interests" name="interests" class="join-form-control second-form-textarea"></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Dreams:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Dreams" name="dreams" class="join-form-control second-form-textarea"></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Best Feature:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Best Feature" name="best_feature" class="join-form-control second-form-textarea"></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">About Me:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="About Me" name="about_me" class="join-form-control second-form-textarea"></textarea>
									</div>
								</div>
								
								<div class="details-form-group">
									<div class="step-label-col">
									</div>
									<div class="step-input-field">
										<input type="submit" value="Save & Continue" class="second-step-submit-button" />
										<div class="second-step-skip-button">
											<span>or</span>
											<a class="second-step-skip" href="<?php echo base_url('dashboard/uploadimage') ?>">Skip</a>
										</div>
									</div>
								</div>
							</form>	
						</div>
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