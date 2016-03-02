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

    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/browse.css" />
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/friends.css" />

    <script src="<?php echo base_url(); ?>public/js/jquery-1.11.3.min.js"></script>
    <!--Bootstrap Jquery-->
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $('input.typeahead').typeahead({
                name: 'typeahead',
                remote:'<?php echo base_url('dashboard/suggestions'); ?>?key=%QUERY',
                limit : 10
            });
        });
    </script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/2.7.0/
           html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.2.0/
           respond.min.js"></script>
    <![endif]-->

</head>
<body>


<div class="yellow-line"></div>
<?php $this->load->view('members/dashboard_top'); ?>
<div class="clearfix"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="cover-picture-profile">

                <div class="cover-picture" id="cover_picture"  >
                    <div class="profile-picture">


                        <img src="<?php echo base_url(); ?>public/images/thumb/<?php if(!empty($image)){ echo $image; }else echo "no.png"; ?>" alt="Profile Picture" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="container">
    <div class="row">
        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li ><a href="<?php echo base_url('dashboard/friends'); ?>">Friends</a></li>
                <li class="active"><a href="<?php echo base_url('dashboard/friendrequests'); ?>">Friend Requests</a></li>
                <li><a href="#">Online Friends</a></li>
                <li><a href="#">Invite Friends</a></li>
            </ul>
        </div>
        <div class="col-sm-10">
            <hr>
            <?php if(isset($messages1)){echo $messages1;}?>
            <?php if(isset($friend_requests)){
            foreach($friend_requests as $rows){ ?>
            <div class="col-md-2">
                <div class="productbox">
                    <div class="imgthumb img-responsive">
                        <img src="<?php echo base_url(); ?>public/images/thumb/<?php if(($rows['image'])!=null) echo $rows['image']; else echo "no.png"; ?>">
                    </div>
                    <div >
                        <div class="text-center" style="font-size: 12px;"><strong> <?php echo $rows['first_name'].' '.$rows['last_name'] ?></strong></div>
                        <a class="btn btn-info btn-xs" role="button" href="<?php
                        echo base_url('dashboard/requestaccept').'?friend_id='.$rows['id'];
                        ?>">Accept</a>  <a class="btn btn-info btn-xs pull-right" role="button" href="<?php
                        echo base_url('dashboard/requestdelete').'?friend_id='.$rows['id'];
                        ?>">Delete</a>

                    </div>
                </div>
            </div>
               <?php }}?>
<!--            <div class="col-md-2">-->
<!--                <div class="productbox">-->
<!--                    <div class="imgthumb img-responsive">-->
<!--                        <img src="http://lorempixel.com/250/250/business/?ac=22">-->
<!--                    </div>-->
<!--                    <div >-->
<!--                        <h5>Lorem ipsum dolor</h5>-->
<!--                        <a href="#" class="btn btn-default btn-xs pull-right" role="button"><i class="glyphicon glyphicon-edit"></i></a> <a href="#" class="btn btn-info btn-xs" role="button">Button</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="col-md-2">-->
<!--                <div class="productbox">-->
<!--                    <div class="imgthumb img-responsive">-->
<!--                        <img src="http://lorempixel.com/250/250/business/?af=2">-->
<!--                    </div>-->
<!--                    <div >-->
<!--                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h5>-->
<!--                        <a href="#" class="btn btn-default btn-xs pull-right" role="button"><i class="glyphicon glyphicon-edit"></i></a> <a href="#" class="btn btn-info btn-xs" role="button">Button</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="col-md-2">-->
<!--                <div class="productbox">-->
<!--                    <div class="imgthumb img-responsive">-->
<!--                        <img src="http://lorempixel.com/250/250/business/?a=4">-->
<!--                    </div>-->
<!--                    <div >-->
<!--                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit Lorem ipsum dolor sit amet, consectetur adipisicing elit</h5>-->
<!--                        <a href="#" class="btn btn-default btn-xs pull-right" role="button"><i class="glyphicon glyphicon-edit"></i></a> <a href="#" class="btn btn-info btn-xs" role="button">Button</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="col-md-2">-->
<!--                <div class="productbox">-->
<!--                    <div class="imgthumb img-responsive">-->
<!--                        <img src="http://lorempixel.com/250/250/business/?ag=5">-->
<!--                    </div>-->
<!--                    <div >-->
<!--                        <h5>Thumbnail label</h5>-->
<!--                        <a href="#" class="btn btn-default btn-xs pull-right" role="button"><i class="glyphicon glyphicon-edit"></i></a> <a href="#" class="btn btn-info btn-xs" role="button">Button</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="col-md-2">-->
<!--                <div class="productbox">-->
<!--                    <div class="imgthumb img-responsive">-->
<!--                        <img src="http://lorempixel.com/250/250/business/?a=6">-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h5>-->
<!--                        <div class="btn-group">-->
<!--                            <button type="button" class="btn btn-info btn-xs" role="button">Left</button>-->
<!---->
<!--                        </div>-->
<!--                        <a href="#" class="btn btn-default btn-xs pull-right" role="button"><i class="glyphicon glyphicon-edit"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="col-md-2">-->
<!--                <div class="productbox">-->
<!--                    <div class="imgthumb img-responsive">-->
<!--                        <img src="http://lorempixel.com/250/250/business/?a=7">-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <h5>Thumbnail label</h5>-->
<!--                        <s class="text-muted">$2.29</s> <b class="finalprice">$1.2</b> from <b>Amazon</b>-->
<!--                        <a href="#" class="btn btn-default btn-xs pull-right" role="button"><i class="glyphicon glyphicon-zoom-in"></i></a>-->
<!--                        <p>-->
<!--                            <button type="button" class="btn btn-success btn-md btn-block">Get Offer</button>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="saleoffrate">-->
<!--                        <b>90%</b><br>OFF-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div><!--/row-->


        <div class="col-sm-2">
            <div class="sidebar-ads">
                <img src="<?php echo base_url(); ?>public/images/sidebar-ad.jpg" alt="Sidebar Ad" />
            </div>
        </div>
    </div>
</div>

<br>
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
<div id="overlay-back"></div>

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
<script>
    window.onload; {
        var a=0;
        a =<?php if(!empty($message)){echo 1;}else echo 0 ?>;

        if(a===1)  {
            $('#overlay-back').fadeIn(500, function () {
                $('#error').show();
            });
            $("#error_btn").on('click', function() {
                $('#error').hide();
                $('#overlay-back').fadeOut(500);
            });

        } else {
            $('#error').hide();
        }

        ;}
</script>
</body>
</html>