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
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/tree.css" />

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
<?php $this->load->view('admin/top'); ?>
<div class="clearfix"></div>
<div class="container">
    <div class="col-md-6">
        <h4>Member Detail</h4>
        <h5 class="error"><?php echo $this->session->flashdata('message');
           ?></h5>
        <form class="form-horizontal" method="post" action="<?php echo base_url('admin/updatemember'); ?>">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" name="first_name" class="form-control" value="<?php echo $member_detail[0]['first_name']; ?>" id="name" >
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" name="last_name" class="form-control" value="<?php echo $member_detail[0]['last_name']; ?>" id="name" >
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" value="<?php echo $member_detail[0]['email']; ?>" class="form-control" id="email">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Change Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="password" placeholder="if want to change password">
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                    <select name="status" class="dropdown">
                        <option value="1" <?php if($member_detail['0']['active']==1){echo "Selected";}?>>Active</option>
                        <option  value="0" <?php if($member_detail['0']['active']==0){echo "Selected";}?>>Inactive</option>
                    </select>

                </div>
                <input type="hidden" name="id" value="<?php echo $member_detail['0']['id'];?>"/>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                   <button type="submit" class="btn btn-default">Update </button>
                    <a href="<?php echo base_url('admin/memberslist'); ?>" class="btn btn-default">Cancel </a>
                </div>
            </div>
        </form>

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