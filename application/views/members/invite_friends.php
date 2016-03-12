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



<!--    <script src="--><?php // echo base_url(); ?><!--public/js/typeahead.min.js"></script>-->

    <!--[if lt IE 9]>
    <script>
        $(document).ready(function(){
            $('input.typeahead').typeahead({
                name: 'typeahead',
                remote:'<?php echo base_url('dashboard/suggestions'); ?>?key=%QUERY',
                limit : 10
            });
        });
    </script>  
    <![endif]-->

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/2.7.0/
           html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.2.0/
           respond.min.js"></script>
    <![endif]-->

</head>
<body>

<div class="yellow-line">
</div>
<?php $this->load->view('members/dashboard_top'); ?>
<div class="clearfix">
</div>
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
                 <li ><a href="<?php echo base_url('dashboard/friendrequests'); ?>">Friend Requests</a></li>
                 <li><a href="#">Online Friends</a></li>
                 <li class="active"><a href="<?php echo base_url('dashboard/invitefriends'); ?>">Invite Friends</a></li>
             </ul>
         </div>
        <div class="col-sm-10">
             <div style="display: none;" class="alert-success alert fade in" id="successs">
                    <button aria-hidden="true" data-dismiss="alert" class="close" onclick="$(this).parent().hide();" type="button">×</button><span></span>

                </div>
         <div style="display: none;" class="alert-danger alert fade in" id="faield">
                    <button type="button" onclick="$(this).parent().hide();" class="close" data-dismiss="alert">&times;</button><span></span>


                </div>
            <form role="form" METHOD="post" action="<?php echo base_url('dashboard/invitefriends'); ?>">
 <div class="form-group">
  <label for="usr">
Invite to join orriz:</label>
  <input type="email" class="form-control" id="email" required />
</div>
                <div class="step-input-field">
                    <button type="button" id="btn-email" class="btn btn-primary">Invite</button>
                    <a href="javascript:void(0);" class="googleContactsButton">Import Friends</a>
		</div>
            </form>
            
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
    
    
    ///
     $('#btn-email').click(function () {
          var email = $('#email').val();
          
                      if (isEmail(email) == false) {
                $('#faield span').text('Please Enter Valid Email.');
                 $('#faield').show();
                return false;
            } else {
                 $('#faield').hide();
                $('.friend_invite p').remove();
            }
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url('dashboard/invitefriends'); ?>',
                data: {'email': email},
                success: function (data) {
                  
                    if (data == 0) {
                    $('#faield').hide();
                    $('#successs').hide();
                    $('#faield span').text('Something going wrong');
                    $('#faield').show();
                } else if (data == 1) {
                    $('#faield').hide();
                    $('#successs').hide();
                    $('#successs span').text('Invitation has been successfully sent.');
                    $('#successs').show();
                } 
                },
            });
    });
    
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    
</script>
<script type="text/javascript" src="https://apis.google.com/js/client.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
    // client secrete  MDfRyKoVwqka8gGicG-LmKgI 
    //  5_ZhEFMbYbn4ZgcGgZSEgYHu 
    var clientId = '1074175154926-pe504grbo95bk48i0ggkv33nfdska8on.apps.googleusercontent.com';
   
    var apiKey = 'AIzaSyC1n7qcy-2kRbF_KHb7GYIb1_lgCDW-ca4';
    
    var scopes = 'https://www.googleapis.com/auth/contacts.readonly';
    $(document).on("click", ".googleContactsButton", function (e) {
        if($('.fa-google .socialCheck').length == 0) {
             $('.fa-google').append('<span class="socialCheck"></span>');
        }
        gapi.client.setApiKey(apiKey);
        window.setTimeout(authorize);
    });
    function authorize() {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthorization);
    }

    function handleAuthorization(authorizationResult) {
        if (authorizationResult && !authorizationResult.error) {
            AjaxStartCall();
            $.get("https://www.google.com/m8/feeds/contacts/default/full?alt=json&access_token=" + authorizationResult.access_token + "&max-results=500&alt=json",
                    function (response) {
                        //process the response here
                        var arrContact = response.feed.entry;
                        $.each(arrContact, function (key, value) {
                            var email = value.gd$email[0].address;
                            var name = value.title.$t;
                            if (name == '') {
                                name = email;
                            }
                            var html = '<div class="friend_find"> <div class="friendPic"> <span><img src="/images/user-blank.png" alt=""></span> </div><label> ' + name + ' </label><div class="checkFriend"><div onclick="invitegmail(\'' + email + '\',this)"  class="radio_frnd"></div></div></div>';
                            $('#invite_user').append(html);
                            $('#twit_invite').hide();
                            $('#fb_invite').hide();
                        });
                        AjaxEndCall();
                    });
        }
    }
</script>
</body>
</html>