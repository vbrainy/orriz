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
        
        <div class="col-sm-10">
            

            <form class="form-inline browsefriendform" action="browsefriends" method="post">
                
        <div class="form-group">

            <label class="sr-only" for="inputEmail">City</label>
            <input type="text"  class="form-control" name="city" id="City" placeholder="City">

        </div>
 <div class="form-group">

            <label class="sr-only" for="inputEmail">Country</label>
            <input type="text" class="form-control" name="country" id="Country" placeholder="Country">
             

        </div>
         <div class="form-group">

            <label class="sr-only" for="inputEmail">Age</label>
            <select name="start_age">
                <option value=""><?php echo "AGE" ?></option>
            <?php for($i=18;$i<=65;$i++) {?> 
                 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select> -
             <select name="end_age">
                 <option value=""><?php echo "AGE" ?></option>
            <?php for($i=18;$i<=65;$i++) {?> 
                 <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </div>
         <div class="form-group">

            <label class="sr-only" for="inputEmail">Gender</label>
            <select name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

       

        <button type="submit" class="btn btn-primary">Search</button>

    </form>


            <hr>
            <?php if(isset($messages1)){echo $messages1;}?>
           

          <?php if(!empty($users)){
            foreach($users as $rows){
           
            $time = strtotime($rows['last_activity_timestamp']);

            $curtime = time();
            $status = "statusdeactive";
           // p(intval($curtime-$time));
            if(($time - $curtime) > 1200 && $rows['is_login']==1) { 
                $status = "statusactive";
            }  ?>
            <div class="col-md-2">
                <div class="browse_box">
                    <div class="imgthumb img-responsive">
                        <img src="<?php echo base_url(); ?>public/images/thumb/<?php if(($rows['image'])!=null) echo $rows['image']; else echo "no.png"; ?>">
                    </div>
                    <div class="<?php echo $status; ?>" title="Online Now" rel="online">Online</div>
                    <div >
                        <div class="text-center" style="font-size: 12px;"><strong> <?php echo $rows['first_name'].' '.$rows['last_name'] ?></strong></div>
                        <a id="<?php echo $rows['id']; ?>" href="javascript:void(0);" class="btn btn-info btn-xs btn_add_friend">Add Friend</a>  

                    </div>
                </div>
            </div>
            
            
   
               <?php } ?>
               
               <?php if($this->pagination->create_links()){
                //   p(51611);
                   ?>
    <div class="pagination">
        <?php  $this->pagination->create_links(); ?></div>
    <?php } ?>
               
               
          <?php  }else {  ?>
             <div class="form-message warning">
      <p>No records found.</p>
    </div>
               <?php } ?>
        </div>


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

<script>
    addFriendsUrl = "<?php echo base_url('dashboard/sentrequest'); ?>";
    $(document).on('click', '.btn_add_friend', function () {
        
      var friend_id = $(this).attr("id");
      var class1 = this;
     // alert(friend_id);
     $.ajax({
                url: addFriendsUrl,
                cache: false,
                // dataType: 'json',
                data: {
                    friend_id: friend_id,
                },
                type: 'POST',
                async: false,
                success: function (data) {
                    
                    if (data) {

                         $(class1).html("Request Sent");
                         $(class1).removeClass("btn_add_friend");
                       
                    }
                }
            });
    
    });

</script>



</body>
</html>

