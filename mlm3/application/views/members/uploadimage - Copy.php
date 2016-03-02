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
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/crop.css" />

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
		<div class="row">
			<div class="col-xs-12">
				<div class="first-step-form">
					<div class="form-title">
						<h5>Step 3 of 3 - Upload Profile Picture</h5>
					</div>
					<div class="step-3-form-body">
                        <script src="<?php echo base_url(); ?>public/js/cropbox.js"></script>
                        <div class="uploaded-image-part">

                        <div class="imageBox ">

                            <div class="spinner" style="display: none">	<img src="<?php echo base_url(); ?>public/images/no-image.jpg" alt="Image" /></div>

                        </div>


                        </div>


                        <div class="upload-form-part">
                            <h4 class="upload-form-part-title">Upload A Photo</h4>              <form role="form" action="<?php echo base_url(); ?>dashboard/doupload" method="POST" enctype="multipart/form-data" >
                            <span class="upload-form-part-sub-title">From Your Computer</span>          <div class="action">
                                    <input style="float:left; width: 250px" type="file" class="file-upload" id="file"  name="image"/>



                            </div>
                                <br>
                                <div class="error"><?php if(isset($message))echo $message;
                                    ?></div>



                            <br>
                            <div>
                            <input type="submit" id="submit" name="submit" value="Save and Countine" class="file-upload-btn" />
                        </div>
                            </form>
                            <div class="may-later">
                                <a href="<?php echo base_url(); ?>dashboard" class="may-later-btn">May Be later</a>
                            </div>
                        </div>
                        <br>

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
    <script type="text/javascript">
        window.onload = function() {
            var options =
            {
                imageBox: '.imageBox',

                spinner: '.spinner',
                imgSrc: 'avatar.png'
            }
            var cropper = new cropbox(options);
            document.querySelector('#file').addEventListener('change', function(){
                var reader = new FileReader();
                reader.onload = function(e) {
                    options.imgSrc = e.target.result;
                    cropper = new cropbox(options);
                }
                reader.readAsDataURL(this.files[0]);
                this.files = [];
            })

        };
    </script>

</body>
</html>