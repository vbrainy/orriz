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
                 <li ><a href="<?php echo base_url('members/edit_about_yourself'); ?>">About yourself</a></li>
                 <li><a href="<?php echo base_url('members/upload_profile_image'); ?>">Upload Image</a></li>
                 <li class="active"><a href="<?php echo base_url('members/change_password'); ?>">Change Password</a></li>
             </ul>
         </div>
  
 			<div class="col-xs-12">
                             <div style="color: #F8BB22">   <?php  echo  $this->session->flashdata('message'); ?> </div>
				<div class="first-step-form">
					<div class="form-title">
						<h5>Edit Profile</h5>
					</div>
					<div class="join-form-body">
						<div class="from-body-container">
							<h4 class="form-tagline">Edit Your Profile Password</h4>
							<form role="form" method="post" action="<?php echo base_url();?>members/change_password">
                                                            
                                                            
                                                            
							
                                                            	<div class="details-form-group">
									<div class="step-label-col">
										<label class="step-label">Current Password:</label>
									</div>
									<div class="step-input-field">
                                                                            <input type="password"   placeholder="Your Current Password" value="<?php echo set_value('password'); ?>" name="password"  class="join-form-control" required="required" />
									</div>
								</div>
							<div class="details-form-group">
									<div class="step-label-col">
										<label class="step-label">New Password:</label>
									</div>
									<div class="step-input-field">
                                                                            <input type="password"  placeholder="New Password" name="new_password" value="<?php echo set_value('new_password'); ?>"  class="join-form-control" required="required" />
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-label-col">
										<label class="step-label">Confirm Password:</label>
									</div>
									<div class="step-input-field">
                                                                            <input type="password"  placeholder="Confirm Password" name="new_confirm" value="<?php echo set_value('new_confirm'); ?>"  class="join-form-control" required="required" />
									</div>
								</div><div class="details-form-group">
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