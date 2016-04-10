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
					<form role="form" method="post" action="<?php echo base_url(); ?>members/register_member">
						<div class="form-title">
							<h5>Join Free!</h5>
						</div>
						<div class="join-form-body">



                            <div class="join-form-group">
								<div class="first-name-field">
									<input type="text" value="<?php echo set_value('first_name'); ?>" placeholder="First Name" id="join-first-name" name="first_name" class="join-form-control" required />
                                    <div class="error"> <?php echo form_error('first_name'); ?>   </div>
								</div>
								<div class="last-name-field">
									<input type="text" value="<?php echo set_value('last_name'); ?>" placeholder="Last Name" id="join-last-name" name="last_name" class="join-form-control" />
                                    <div class="error"> <?php echo form_error('last_name'); ?>   </div>
								</div>
							</div>
							<div class="join-form-group">
								<input type="email" placeholder="Email" id="join-first-email" value="<?php echo set_value('email'); ?>" name="email" class="join-form-control" required />
                               <div class="error"> <?php echo form_error('email'); ?>   </div>
							</div><div class="join-form-group">
                                <input type="password" placeholder="New Password" id="join-first-password" value="<?php echo set_value('password'); ?>"  name="password" class="join-form-control" required />
                                <div class="error"> <?php echo form_error('password'); ?>   </div>
							</div>
							<div>
								<input type="password" placeholder="Confirm Password" id="join-first-password" value="<?php echo set_value('password_confirm'); ?>"  name="password_confirm" class="join-form-control" required />     <div class="error"> <?php echo form_error('password_confirm'); ?>   </div>
							</div>
							<div class="join-form-birthday">
								<span>Birthday:</span>
							</div>
							<div class="join-form-group">
								<div class="birthday-day">
									<select class="join-form-control" name="birthday[]" required>
										<option value="">Day</option>
                                        <?php for($i=1;$i<=31;$i++){
                                            if(strlen($i)!=2){
                                                echo '<option value="'."0".$i.'">'.$i. '</option>';
                                            }else
                                            echo '<option value="'.$i.'">'.$i. '</option>';
                                        } ?>

									</select>
								</div>
								<div class="birthday-month">
									<select class="join-form-control" name="birthday[]" required="required">
										<option value="">Month</option>
										<option value="01" <?php  if (set_value('birthday[1]')==="01") echo "Selected";?>>January</option>
										<option value="02" <?php  if (set_value('birthday[1]')==="02") echo "Selected";?>>February</option>
										<option value="03" <?php  if (set_value('birthday[1]')==="03") echo "Selected";?>>March</option>
										<option value="04" <?php  if (set_value('birthday[1]')==="04") echo "Selected";?>>April</option>
										<option value="05" <?php  if (set_value('birthday[1]')==="05") echo "Selected";?>>May</option>
										<option value="06" <?php  if (set_value('birthday[1]')==="06") echo "Selected";?>>June</option>
										<option value="07" <?php  if (set_value('birthday[1]')==="07") echo "Selected";?>>July</option>
										<option value="08" <?php  if (set_value('birthday[1]')==="08") echo "Selected";?>>August</option>
										<option value="09" <?php  if (set_value('birthday[1]')==="09") echo "Selected";?>>September</option>
										<option value="10" <?php  if (set_value('birthday[1]')==="10") echo "Selected";?>>October</option>
										<option value="11" <?php  if (set_value('birthday[1]')==="11") echo "Selected";?>>November</option>
										<option value="12" <?php  if (set_value('birthday[1]')==="12") echo "Selected";?>>December</option>
									</select>
								</div>

								<div class="birthday-year">
									<select class="join-form-control" name="birthday[]" required>                              <option value="">Year</option>
                                        <?php for($i=1950;$i<= date('Y')-18;$i++){
                                            echo '<option value="'.$i.'">'.$i. '</option>';
                                        } ?>
									</select>
								</div>
                               <div class="error"> <?php echo form_error('birthday'); ?>  </div>
							</div>
							<div class="join-form-group">
								<input type="radio" name="gender" value="male" <?php if(set_value('gender')==="male" ) echo "checked" ; ?> id="male" class="radio-label" required /><label for="male" class="radio-label-text">Male</label>
								<input type="radio" name="gender" value="female"  <?php if(set_value('gender')==="female" ) echo "checked"; ?> id="female" class="radio-label" required /><label for="female" class="radio-label-text">Female</label>
							</div>
							<div class="join-free-form-text">
								<p>By clicking Sign up, you are indicating that you have read & agree to the <a href="<?php  echo base_url(); ?>public/#">Terms of Service</a> and <a href="<?php  echo base_url(); ?>public/#">Privacy Policy</a>.</p>
							</div>
							<div class="submit-join-form">
								<input type="submit" value="Sign Up" class="join-form-submit-button" />
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
                        <?php foreach($members as $key=>$value) { if(!empty($value['image'])) { ?>
    			<li><img src="<?php  echo base_url(); ?>public/images/thumb/<?php echo $value['image']; ?> " alt="Gallery Images" /></li>
                        <?php } } ?>
			<li><img src="<?php  echo base_url(); ?>public/images/gallery-image-2.jpg" alt="Gallery Images" /></li>
			<li><img src="<?php  echo base_url(); ?>public/images/gallery-image-3.jpg" alt="Gallery Images" /></li>
<!--			<li><img src="<?php  echo base_url(); ?>public/images/gallery-image-4.jpg" alt="Gallery Images" /></li>
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
			<li><img src="<?php  echo base_url(); ?>public/images/gallery-image-5.jpg" alt="Gallery Images" /></li>-->
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
		//duplicated: true
		});
		});
	</script>
</body>
</html>