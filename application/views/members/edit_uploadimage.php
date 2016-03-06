<?php

error_reporting (E_ALL ^ E_NOTICE);

$upload_path =base_url()."/public/images/pic/";

$thumb_width = "150";
$thumb_height = "150";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload File and    </title>


    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/style - Copy.css" />
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/screen.css" />

    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/cropimage.css" />
    <link type="text/css" href="<?php echo base_url(); ?>public/css/imgareaselect-default.css" rel="stylesheet" />


    <!--Custom Css-->
    <style>
        .crop_select_image {
    float: left;
    padding: 0;
    width: 150px;
}

.crop_preview_submit {
    margin: 14px -40px -19px;
    text-align: center;
    width: 160px;
}
.second-step-skip-button {
    color: #d5dcde;
    float: left;
    line-height: 0;
    margin-left: 60px;
}

    </style>
    <!--Jquery-1.11.1.min.js-->
    <script src="<?php  echo base_url(); ?>public/js/jquery-1.11.3.min.js"></script>

    <!--Bootstrap Jquery-->
    <script src="<?php  echo base_url(); ?>public/js/bootstrap.min.js"></script>
    <!--Media Queries Css-->

    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.imgareaselect.js"></script>



    <script type="text/javascript">
        function preview(img, selection) {
            var scaleX = <?php echo $thumb_width;?> / selection.width;
            var scaleY = <?php echo $thumb_height;?> / selection.height;

            $('#thumbviewimage > img').css({
                width: Math.round(scaleX * img.width) + 'px',
                height: Math.round(scaleY * img.height) + 'px',
                marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
                marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
            });

            var x1 = Math.round((img.naturalWidth/img.width)*selection.x1);
            var y1 = Math.round((img.naturalHeight/img.height)*selection.y1);
            var x2 = Math.round(x1+selection.width);
            var y2 = Math.round(y1+selection.height);

            $('#x1').val(x1);
            $('#y1').val(y1);
            $('#x2').val(x2);
            $('#y2').val(y2);

            $('#w').val(Math.round((img.naturalWidth/img.width)*selection.width));
            $('#h').val(Math.round((img.naturalHeight/img.height)*selection.height));

        }

        $(document).ready(function () {
            $('#save_thumb').click(function() {
                var x1 = $('#x1').val();
                var y1 = $('#y1').val();
                var x2 = $('#x2').val();
                var y2 = $('#y2').val();
                var w = $('#w').val();
                var h = $('#h').val();
                if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
                    alert("Please Make a Selection First");
                    return false;
                }else{
                    return true;
                }
            });
        });
    </script>



</head>
<body>
<div class="yellow-line"></div>
<div class="header-inner-page">
 <?php $this->load->view('members/dashboard_top'); ?>
</div>

<div class="clearfix"></div>
 <div style="color: #F8BB22">   <?php  echo  $this->session->flashdata('message'); ?> </div>
    <div class="container1">

        <div class="crop_box">
            <form class="uploadform" method="post" enctype="multipart/form-data"  name="photo">
                <div class="crop_set_upload">
                    <div class="pull-left"><input type="file" name="imagefile" id="imagefile" style="padding-left: 20px;"  /> </div>


                    <div class="crop_select_image pull-left"><input type="submit" value="Upload" class="upload_button" name="submitbtn" id="submitbtn" /><h6> Use mouse to select area of your photo to crop</h6></div>
                </div>
            </form>
            <div class="crop_set_preview">
                <div class="crop_preview_left">
                    <div class="crop_preview_box_big" id='viewimage'>

                    </div>
                </div>
                <div class="crop_preview_right">
                       Current Image
                    <div class="profile-picture">
 <img src="<?php echo base_url(); ?>public/images/thumb/<?php  if(!empty($image_details)){ echo $image_details; }else { echo "no.png";} ?>
      " alt="Profile Picture" />
                    </div>
                    Preview (150x150 px)
                    <div class="crop_preview_box_small" id='thumbviewimage' style="position:relative; overflow:hidden;"> </div>
                    

                    <form name="thumbnail" action="<?php echo base_url('members/upload_image');?>" method="post">
                        <input type="hidden" name="x1" value="" id="x1" />
                        <input type="hidden" name="y1" value="" id="y1" />
                        <input type="hidden" name="x2" value="" id="x2" />
                        <input type="hidden" name="y2" value="" id="y2" />
                        <input type="hidden" name="w" value="" id="w" />
                        <input type="hidden" name="h" value="" id="h" />
                        <input type="hidden" name="wr" value="" id="wr" />

                        <input type="hidden" name="filename" value="" id="filename" />
                        <div class="crop_preview_submit"><input type="submit" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb" class="submit_button" /> </div>
                        <div class="second-step-skip-button">
                            <span>or</span>

                            <a class="add-detail-skip" href="<?php echo base_url('members/edit_profile') ?>"> Cancel </a>
                        </div>
                    </form>

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
<script type="text/javascript" >
    $(document).ready(function() {
        $('#submitbtn').click(function() {
            $("#viewimage").html('');
            $("#viewimage").html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');
            $(".uploadform").ajaxForm({
                url: '<?php echo base_url('dashboard/upload'); ?>',
                success:showResponse
            });
        });
    });

    function showResponse(responseText, statusText, xhr, $form){

        if(responseText.indexOf('.')>0){
            $('#thumbviewimage').html('<img src="<?php echo $upload_path; ?>'+responseText+'"   style="position: relative;" alt="Thumbnail Preview" />');
            $('#viewimage').html('<img class="preview" alt="" src="<?php echo $upload_path; ?>'+responseText+'"   id="thumbnail" />');
            $('#filename').val(responseText);
            $('#thumbnail').imgAreaSelect({  aspectRatio: '1:1', handles: true  , onSelectChange: preview });
        }else{
            $('#thumbviewimage').html(responseText);
            $('#viewimage').html(responseText);
        }
    }

</script>
</body>
</html>