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
                 <li class="active"><a href="<?php echo base_url('members/edit_profile'); ?>">Edit profile info</a></li>
                 <li ><a href="<?php echo base_url('members/edit_about_yourself'); ?>">About yourself</a></li>
                 <li><a href="<?php echo base_url('members/upload_profile_image'); ?>">upload Image</a></li>
                 <li><a href="<?php echo base_url('members/change_password'); ?>">Change Password</a></li>
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
							<h4 class="form-tagline">Your Profile info</h4>
							<form role="form" method="post" action="<?php echo base_url();?>members/edit_profile">
                                                            	<div class="details-form-group">
									<div class="step-label-col">
										<label class="step-label">Name:</label>
									</div>
									<div class="step-input-field">
										<div class="first-name-field">
                                                                                    <input type="text"  placeholder="Your First Name" name="first_name" value="<?php echo !empty($getStep1ProfileDetails->first_name)? $getStep1ProfileDetails->first_name : "" ?>" class="join-form-control" required/>
										</div>
										<div class="last-name-field">
										<input type="text" placeholder="Your Last name"  name="last_name" value="<?php echo !empty($getStep1ProfileDetails->last_name)? $getStep1ProfileDetails->last_name : "" ?>" class="join-form-control" required/>
										</div>
									</div>
								</div>
                                                            
                                                            
								<div class="details-form-group">
									<div class="step-label-col">
										<label class="step-label">City & Country:</label>
									</div>
									<div class="step-input-field">
										<div class="first-name-field">
										<input type="text" placeholder="Your City Name" name="city" value="<?php echo !empty($getStep1ProfileDetails->city)? $getStep1ProfileDetails->city : "" ?>" class="join-form-control" required/>
										</div>
										<div class="last-name-field">
										<input type="text" placeholder="Your Country name"  name="country" value="<?php echo !empty($getStep1ProfileDetails->country)? $getStep1ProfileDetails->country : "" ?>" class="join-form-control" required/>
										</div>
									</div>
								</div>
                                                            	<div class="details-form-group">
									<div class="step-label-col">
										<label class="step-label">Email:</label>
									</div>
									<div class="step-input-field">
                                                                            <input type="text" readonly="readonly" disabled="disabled" placeholder="Your Religion" name="religion" value="<?php echo !empty($getStep1ProfileDetails->email)? $getStep1ProfileDetails->email : "" ?>" class="join-form-control" />
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-label-col">
										<label class="step-label">Relationship Status</label>
									</div>
									<div class="step-input-field">
										<div class="relationship-field">
											<select name="relationship_status" class="join-form-control">
                                                                                            <option value=""><--- Relationship Status ---></option>
                                                                                            <option value="Single" <?php if($getStep1ProfileDetails->relationship_status == "Single"){ ?>selected="selected" <?php } ?> >Single</option>
                                                                                            <option value="Dating" <?php if($getStep1ProfileDetails->relationship_status == "Dating"){ ?>selected="selected" <?php } ?>>Dating</option>
												<option value="In a relationship" <?php if($getStep1ProfileDetails->relationship_status == "In a relationship"){ ?>selected="selected" <?php } ?>>In a relationship</option>
												<option value="Engaged" <?php if($getStep1ProfileDetails->relationship_status == "Engaged"){ ?>selected="selected" <?php } ?>>Engaged</option>
                                                                                                <option value="Married" <?php if($getStep1ProfileDetails->relationship_status == "Married"){ ?>selected="selected" <?php } ?> >Married</option>
												<option value="It's Complicated" <?php if($getStep1ProfileDetails->relationship_status == "It's Complicated"){ ?>selected="selected" <?php } ?>>It's Complicated</option>
												<option value="Open Relationship" <?php if($getStep1ProfileDetails->relationship_status == "Open Relationship"){ ?>selected="selected" <?php } ?>>Open Relationship</option>
												<option value="Separated" <?php if($getStep1ProfileDetails->relationship_status == "Separated"){ ?>selected="selected" <?php } ?>>Separated</option>
												<option value="Divorced" <?php if($getStep1ProfileDetails->relationship_status == "Divorced"){ ?>selected="selected" <?php } ?>>Divorced</option>
												<option value="Widowed" <?php if($getStep1ProfileDetails->relationship_status == "Widowed"){ ?>selected="selected" <?php } ?>>Widowed</option>
											</select>
										</div>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-label-col">
										<label class="interested-in-label">Interested In:</label>
									</div>
									<div class="step-input-field">
										<div class="interest-checkbox-section">
											<div class="checkbox-col">
                                                                                            <input type="checkbox" id="dating" class="interest-checkbox" <?php if($getStep1ProfileDetails->intrest_in_dating == 1) {?>checked="checked" <?php }?> name="dating"/>
												<label for="dating" class="interest-label">Dating</label>
											</div>
											<div class="checkbox-col">
												<input type="checkbox" id="friends" name="friends" <?php if($getStep1ProfileDetails->intrest_in_friends == 1) {?>checked="checked" <?php }?> class="interest-checkbox"/>
												<label for="friends" class="interest-label">Friends</label>
											</div>
										</div>
										<div class="interest-checkbox-section">
											<div class="checkbox-col">
												<input type="checkbox" id="serious-relationship" class="interest-checkbox" name="serious_relationship" <?php if($getStep1ProfileDetails->intrest_in_serious_relationship == 1) {?>checked="checked" <?php }?>/>
												<label for="serious-relationship" class="interest-label">Serious Relationship</label>
											</div>
											<div class="checkbox-col">
												<input type="checkbox" id="networking" class="interest-checkbox" name="networking" <?php if($getStep1ProfileDetails->intrest_in_networking == 1) {?>checked="checked" <?php }?>/>
												<label for="networking" class="interest-label">Networking</label>
											</div>
										</div>
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-label-col">
										<label class="step-label">Religion:</label>
									</div>
									<div class="step-input-field">
										<input type="text" placeholder="Your Religion" name="religion" value="<?php echo !empty($getStep1ProfileDetails->religion)? $getStep1ProfileDetails->religion : "" ?>" class="join-form-control" />
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-label-col">
										<label class="step-label">School:</label>
									</div>
									<div class="step-input-field">
										<input type="text" placeholder="Your School Name" value="<?php echo !empty($getStep1ProfileDetails->school)? $getStep1ProfileDetails->school : "" ?>" name="school" class="join-form-control" />
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-label-col">
										<label class="step-label">College:</label>
									</div>
									<div class="step-input-field">
										<input type="text" placeholder="Your College Name" value="<?php echo !empty($getStep1ProfileDetails->college)? $getStep1ProfileDetails->college : "" ?>" name="college" class="join-form-control" />
									</div>
								</div>
								<div class="details-form-group">
									<div class="step-label-col">
										<label class="step-label">University:</label>
									</div>
									<div class="step-input-field">
										<input type="text" placeholder="Your University Name" value="<?php echo !empty($getStep1ProfileDetails->university)? $getStep1ProfileDetails->university : "" ?>" name="university" class="join-form-control" />
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