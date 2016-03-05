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
    
    
    <div class="yellow-line">
</div>
<?php $this->load->view('members/dashboard_top'); ?>
<div class="clearfix">
</div>


	<div class="clearfix"></div>
	<div class="container">
      <div class="row">
             <div class="cover-picture-profile">
                <div class="cover-picture" id="cover_picture">
                    <div class="profile-picture">
                        <img src="<?php echo base_url(); ?>public/images/thumb/<?php if(!empty($getStep1ProfileDetails->image)){ echo $getStep1ProfileDetails->image; }else echo "no.png"; ?>
						" alt="Profile Picture" />
                    </div>
                </div>
            </div>
                            <div class="panel-body">
             <ul class="nav nav-tabs" role="tablist">
                 <li ><a href="<?php echo base_url('members/edit_profile'); ?>">Edit profile info</a></li>
                 <li class="active" ><a href="<?php echo base_url('members/edit_about_yourself'); ?>">About yourself</a></li>
                 <li><a href="<?php echo base_url('members/upload_profile_image'); ?>">upload Image</a></li>
                 <li><a href="<?php echo base_url('members/change_password'); ?>">Change Password</a></li>
             </ul>
         </div>

			<div class="col-xs-12">
                            
				<div class="first-step-form">
					<div class="form-title">
						<h5>Edit Profile</h5>
					</div>
					<div class="join-form-body">
						<div class="from-body-container">
							<h4 class="form-tagline">Edit about yourself</h4>
							<form role="form" METHOD="post" action="<?php echo base_url('members/edit_about_yourself'); ?>">
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Music:</label>
									</div>
									<div class="step-2-input-field">
                                                                            <textarea placeholder="Your Fav. Music" name="music" class="join-form-control second-form-textarea"><?php echo !empty($getStep2ProfileDetails->music) ? trim($getStep2ProfileDetails->music) : "";  ?></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Movies:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Fav. Movies" name="movies" class="join-form-control second-form-textarea"><?php echo !empty($getStep2ProfileDetails->movies) ? trim($getStep2ProfileDetails->movies) : "";  ?></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">TV:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Fav. TV Shows" name="tv" class="join-form-control second-form-textarea"><?php echo !empty($getStep2ProfileDetails->tv) ? trim($getStep2ProfileDetails->tv) : "";  ?></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Books:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Fav. Books" name="books" class="join-form-control second-form-textarea"><?php echo !empty($getStep2ProfileDetails->books) ? trim($getStep2ProfileDetails->books) : "";  ?></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Sports:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Fav. Sports" name="sports" class="join-form-control second-form-textarea"><?php echo !empty($getStep2ProfileDetails->sports) ? trim($getStep2ProfileDetails->sports) : "";  ?></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Interests:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Interests" name="interests" class="join-form-control second-form-textarea"><?php echo !empty($getStep2ProfileDetails->interests) ? trim($getStep2ProfileDetails->interests) : "";  ?></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Dreams:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Dreams" name="dreams" class="join-form-control second-form-textarea"><?php echo !empty($getStep2ProfileDetails->dreams) ? trim($getStep2ProfileDetails->dreams) : "";  ?></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">Best Feature:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="Your Best Feature" name="best_feature" class="join-form-control second-form-textarea"><?php echo !empty($getStep2ProfileDetails->best_feature) ? trim($getStep2ProfileDetails->best_feature) : "";  ?></textarea>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-2-label-col">
										<label class="second-step-label">About Me:</label>
									</div>
									<div class="step-2-input-field">
										<textarea placeholder="About Me" name="about_me" class="join-form-control second-form-textarea"><?php echo !empty($getStep2ProfileDetails->about_me) ? trim($getStep2ProfileDetails->about_me) : "";  ?></textarea>
									</div>
								</div>
								
								<div class="details-form-group">
									<div class="step-label-col">
									</div>
									<div class="step-input-field">
										<input type="submit" value="Save" class="add-detail-submit-button" />
										<div class="skip-button">
											<span>or</span>
										<a class="add-detail-skip" href="<?php echo base_url('dashboard/index'); ?>"> Cancel </a>
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
    <script>
    window.onload;
    {
        time = new Date().getUTCHours();
        minute = new Date().getUTCMinutes();
        timezone = new Date().getTimezoneOffset();
        if (timezone > 0) {
            hour= time*60+minute+timezone;
            currenttime= hour/60;
        }else
            hour= time*60+minute-timezone;
        currenttime= hour/60;
        if (currenttime >= 5 && currenttime < 10) {
            document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/morning.png)";
        }else if(currenttime >= 10 && currenttime < 16){
            document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/afternoon.png)";
        }else if (currenttime >= 16 && currenttime < 19){
            document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/evening.png)";
        }else if(currenttime >= 19 && currenttime < 30) {
            document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/night.png)";
        }else if(currenttime >= 0 && currenttime < 5) {
            document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/night.png)";
        }
    }
</script>
</body>
</html>