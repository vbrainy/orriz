<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Site Title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap Css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>
public/css/bootstrap.min.css" />
    <!--Custom Css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>
public/css/style.css" /> 
    
    <!--Media Queries Css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>
public/css/screen.css" />
    <!--Jquery-1.11.1.min.js-->
    <script src="<?php echo base_url(); ?>public/js/jquery-1.11.3.min.js"></script>
    <!--Bootstrap Jquery-->
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>
public/css/popup.css" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>
public/css/error.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>
public/css/post.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>
public/css/wall.css" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/
           html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/
           respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        $(document).ready(function(){
            
            $(this).scrollTop(0);
            
            $total_records= <?php echo $this->data['total_records']; ?>;
            $records_per_page=<?php echo $this->data['records_per_page']; ?>;
            $number_of_pages=<?php echo $this->data['number_of_pages']; ?>;
            $current_page=<?php echo $this->data['current_page']; ?>;
            $start=<?php echo $this->data['start']; ?>;
            $friend_list=<?php echo json_encode($this->data['friends']); ?>;
            
            $privacy = localStorage.getItem('privacy_flag');
            if($privacy == 'undefined')
            {
                $privacy=<?php echo $this->data['privacy']; ?>;
            }
            
            var privacyButtonObj = $('#'+$privacy +'.privacy_button');
            changePrivacyButtonLookFill(privacyButtonObj);
            //console.log($privacy);
             $('#popup1').hide();
             
            if(!$('.detailBox').length)
            {
                load_data($records_per_page,$start,$privacy,$friend_list);
            } 
            
           $load_more=0; 
           localStorage.setItem('load_more_complete', 0);
           localStorage.setItem('load_more_ready', true);
           function load_data($records_per_page,$start,$privacy,$friend_list, $load_more){
                localStorage.setItem('load_more_ready', false);
//               console.log($('.detailBox').length);
//               if(!$('.detailBox').length)
//               {
//                   $start = 0;
//               }
//               else
//               {
//                    $start = $('.detailBox').length;
//                }
               //console.log($start);
               console.log(localStorage);
                $.ajax({
                    url: "<?php echo base_url('posts/ajex_load_posts'); ?>",
                    type: "post",
                    data:{"records_per_page": $records_per_page,"start": $start,"privacy": $privacy,"friends": $friend_list},
                    dataType: "html",
                    beforeSend:function(){
                        $("#wallz").append("<span class='load'><img src='<?php echo base_url() .$this->config->item('loading_image_path');?>'/></span>");
                    },
                    complete:function(){
                        $(".load").remove();
                    },
                    success:function(response){
                        
                        if(!response) 
                        {
                            localStorage.setItem('load_more_complete', 1);
                        }
                        else
                        {
                            localStorage.setItem('load_more_ready', true);   
                        }
                       
                        if($load_more != 'scroll')
                        {
                            $("#posts").html('');
                        }
                        $("#posts").append(response);
                        //alert(response);
                        var result = $('<div />').append(response).find('#posts').html();
                        
                        $('#posts').html(result);

                        
                        if(!$('.no_more_post').length)
                        {
                            $('#no_post_container').show();
                        }
                        

                    }
                });
            }

            $current_page=2;
            $(window).scroll(function(){
                //if($(window).scrollTop() == $(document).height() - $(window).height()) {
                if($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
                    //$start=($current_page * $records_per_page)-$records_per_page;
                    if(localStorage.getItem('load_more_ready') == false) return;
                    if(!$('.no_more_post').length)
                    {
                        $start = 0;
                    }
                    else
                    {
                        $start = $('.no_more_post').length;
                    }
                    //if($current_page<=$number_of_pages)
                    if(localStorage.getItem('load_more_complete') == "0" && localStorage.getItem('load_more_ready') == "true")
                    {
                        load_data($records_per_page,$start,localStorage.getItem('privacy_flag'),$friend_list, 'scroll');
                        $current_page++;
                    }
                }
            });
            
            $('.privacy_button').click(function(){
                $('.privacy_button').removeClass('btn-success').addClass('btn-default');
                $('#no_post_container').hide();
                $('.privacy_button').attr('disabled', false);
                localStorage.setItem('load_more_complete', 0);
                changePrivacyButtonLookFill($(this));
                var privacyFlag = $(this).attr('id');
                localStorage.setItem('privacy_flag' , privacyFlag);
                privacyFlag = localStorage.getItem('privacy_flag');
                load_data($records_per_page,0,privacyFlag,$friend_list);
            });
            
            function changePrivacyButtonLookFill(obj)
            {
                obj.removeClass('btn-default').addClass('btn-success');
                obj.attr('disabled', true);
            }
            
            
            $('#status').on('keyup change', function()
            {
                if($(this).val().length)
                {
                    changeSubmitPostAtt(false);
                }
                else
                {
                    changeSubmitPostAtt(true);
                }
            });
            $('#image').on('change', function()
            {
                if($(this).val().length)
                {
                    //$('#submit').attr('disabled', false);
                    changeSubmitPostAtt(false);
                }
            });
            
            function changeSubmitPostAtt(attValue)
            {
                $('#submit').attr('disabled', attValue);
            }
            
            
             $( '#myForm' )
       .submit( function( e ) {
           $.ajax( {
               url: '<?php echo base_url('posts/status_insert'); ?>',
               type: 'POST',
               data: new FormData( this ),
               processData: false,
               contentType: false,
               beforeSend:function(){
                   $("#wallz1").append("<span class='load'><img src='<?php echo base_url() .$this->config->item('loading_image_path');?>'/></span>");
               },
               complete:function(){
                   $(".load").remove();
                   //$('#wallz').find('#posts').html('');
               },
               success:function(response){
                  //If post found then remove that "no post" element
                  
                  $('#status').val('');
                  $('#image').val('');
                  //$("#posts1").prepend(response);
                  $("#posts").prepend(response);
                    if(!$('.detailBox').length)
                    {
                        $('#no_post_container').show();
                    }
                    else
                    {
                        $('#no_post_container').hide();
                    }
                    changeSubmitPostAtt(true);
                }
           } );
           e.preventDefault();
           }); 
          
                
        });
    </script>
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
                <div class="cover-picture" id="cover_picture">
                    <div class="profile-picture">
                        <img src="<?php echo base_url(); ?>public/images/thumb/<?php if(!empty($image)){ echo $image; }else echo "no.png"; ?>
						" alt="Profile Picture" />
                        
                    </div>
                    <h3 class="wraptext" id="wraptextelement"></h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix">
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="post-ad-form-container">
                <div class="post-ad-form">
                    <form role="form" method="post" action="<?php echo base_url('dashboard/postad'); ?>
						">
                        <h5 class="post-ad-form-title">Post Your Ads:</h5>
                        <?php echo $this->
                        session->flashdata('success'); ?>
                        <div class="post-ad-form-group">
                            <input type="text" name="ad_title" class="post-ad-form-control" placeholder="Ad Title" maxlength="25" required/>
                        </div>
                        <div class="post-ad-form-group">
                            <input type="text" name="ad_description" class="post-ad-form-control" placeholder="Ad Description" maxlength="70" required/>
                        </div>
                        <div class="post-ad-form-group">
                            <input type="text" maxlength="35" name="ad_url" class="post-ad-form-control" value="http://"/>
                        </div>
                        <div>
                            <input type="hidden" name="points" value="<?php echo $points; ?>"/>
                        </div>
                        <div class="post-ad-form-group">
                            <input type="submit" class="post-ad-submit-button" value="Post Ad"/>
                        </div>
                    </form>
                </div>
                <br>
                <?php foreach ($ads as $ad){
                    echo '<strong style="color:blue;">
				'.$ad['ad_title'].'</strong>'.'<br>
				'; echo '<a style="color: green" href="#">'.$ad['ad_url'].'</a>'.'<br>
				'; echo $ad['ad_description'].'<br>
				'; echo '----------------------------------------'.'<br>
				'; } ?>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="posts-ads-container">
                <div class="wall-posts">
                    <form role="form" id="myForm" action="" enctype="multipart/form-data" method="post">
                        <ul class="nav nav-tabs" style="width: 96%">
                            <li class="active"><a data-toggle="tab" href="#home">Status Update</a></li>
                            <li><a data-toggle="tab" href="#menu1">Add Photo</a></li>
                        </ul>
                        <div class="tab-content">
                            
                            <div id="home" class="tab-pane fade in active">
                                <textarea name="status" cols="87" id="status" rows="3" placeholder="Whats is in Your Mind?"></textarea>
                            </div>
                            
                            <div id="menu1" class="tab-pane fade" style="height: 71px;">
                                <h5>Select Photo From Your Computer</h5>
                                <input type="file" id="image" name="image"/> 
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-7">
                                <form role="form" method="post" action="<?php echo base_url('posts/privacy'); ?>
                                                            " > <label class="btn-default">Show:</label>
                                    <button type="button" value="1" id="1" class="btn-sm privacy_button btn-default"
                                                              name="privacy" >Everyone</button>
                                    <button type="button" value="2" id="2" class="btn-sm privacy_button btn-default"
                                                             name="privacy" >Friends</button>
                                    <button type="button" value="3" id="3" class="btn-sm privacy_button btn-default"
                                                             name="privacy" >Me</button>
                                </form>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group" style="margin-left :40px;">
                                    <select name="privacy" id="privacy" class="form-control privacy-dropdown pull-left input-sm">
                                        <option value="1" selected="selected">Public</option>
                                        <option value="2">Only my friends</option>
                                        <option value="3">Only me</option>
                                    </select>
                                    <input type="submit" name="submit" id="submit" value="Post" class="btn btn-primary pull-right" disabled="true">
                                </div>
                                
                            </div>
                        </div>
                    </form>
                    <span id="please_wait"></span>
                </div>
                
                <br>
                
             
                <div id="wallz1" class="fb_wall">
                    <ul id="posts1">
                    </ul>
                </div>
<!--                <div id="amardev" ></div>-->
                <div id="wallz" class="fb_wall">
                    <div id="posts"> </div>
                      
                </div>

   <div id="no_post_container" style="display: none;">
                    There is not posts available.
                </div>
					<span class="text-center">
					<ul class="pagination pagination-lg">
                        <?php  echo $this->
                        pagination->create_links(); ?> </span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="sidebar-ads">
                <img src="<?php echo base_url(); ?>public/images/sidebar-ad.jpg" alt="Sidebar Ad" />
            </div>
        </div>
    </div>
</div>
<div class="clearfix">
</div>
<div class="footer">
    <div class="container">
        <div class="col-xs-12">
            <div class="copyright">
                &copy 2015 Website Name. All rights reserved. <a href="#">Privacy Ploicy</a> | <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</div>
<div class="clearfix">
</div>
<div class="yellow-line">
</div>
<div id="overlay-back">
</div>
<div id="<?php if($active==0){echo "popup";}else echo "popup1"; ?>">
    <h1>Hello <?php echo $first_name; ?>
    </h1>
    <h3>Welcome to MLM website!</h3>
    <p>
        Your Account is Not verified Please check your email and click on the activation link to Verify Your account.
    </p>
</div>
<div id="error">
    <h3><?php if(!empty($message)){echo $message;} ?>
    </h3>
    <button class="btn-default close-image" id="error_btn" type="reset" name="ok" value="ok">ok</button>
</div>
<!--Marquee Jquery-->
<script src="<?php echo base_url(); ?>public/js/jquery.marquee.min.js"></script>
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
        
        var theDiv = document.getElementById("wraptextelement");
        var content;
        if (currenttime >= 5 && currenttime < 10) {
            document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/morning.png)";
            content = document.createTextNode("Morning");
        }else if(currenttime >= 10 && currenttime < 16){
            document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/afternoon.png)";
            content = document.createTextNode("Afternoon");
        }else if (currenttime >= 16 && currenttime < 19){
            document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/evening.png)";
            content = document.createTextNode("Evening");
        }else if(currenttime >= 19 && currenttime < 30) {
            document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/night.png)";
            content = document.createTextNode("Night");
        }else if(currenttime >= 0 && currenttime < 5) {
            document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/night.png)";
            content = document.createTextNode("Mid Night");
        }
        var breakLine = document.createElement("br");
        var dummyText =  document.createTextNode("Dummy text for 1 liner or 2 liner");
        theDiv.appendChild(content);
        theDiv.appendChild(breakLine);
        theDiv.appendChild(dummyText);
    }
</script>
<script>
    window.onload;{
        // you can use just jquery for this
        var active=<?php echo $active; ?>;
        if(active===0) {
            $('#overlay-back').fadeIn(500, function () {
                $('#popup').show();
            });
        }else {
            $('#popup').hide();
        }
        ;}
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
    function add_comment(post_id){
//        console.log(post_id);
    $('#commentbox_'+post_id).find('.button_post_comment').off('click');
    $('#commentbox_'+post_id).find('.button_post_comment').attr('disabled', true);
      var  comment= $('#comment_'+post_id).val();

        $.post('<?php echo base_url('posts/add_comment'); ?>',{post_id:post_id,comment:comment},function(data){
            if(data=='success'){
                $('#comment_'+post_id).val('');

                get_comments(post_id);
                
            }else

                alert(data);
        });
    }
    function get_comments(post_id){
        $.post('<?php echo base_url('posts/get_comments'); ?>',{post_id:post_id},function(comments){

            $('#view_'+post_id).hide();
            $('#get_comment_'+post_id).html(comments);

        });
    }


</script>
<script type="text/javascript">
    function clear(){
        $("#myForm : input").each(function(){
            $(this).val("");
        });
        
    }
    

</script>
<script>
    
    function like_add(post_id){
        
        
        
        $.post('<?php echo base_url('posts/like_post'); ?>',{post_id:post_id},function(data){
            
        //   alert(data);
            if(data=='1'){
                like_get(post_id);
                $('#hearts_'+post_id).hide();
                  $('#heart_'+post_id).text('Unlike');

            }else{
                  like_get(post_id);
                $('#hearts_'+post_id).hide();
            $('#heart_'+post_id).text('like');
        }
        });
    }
    function like_get(post_id){
      
        $.post('<?php echo base_url('posts/get_like'); ?>',{post_id:post_id},function(data){
            $('#post_id_'+post_id+'_likes').text(data+'  Likes');
        });
    }
    
</script>
<!--<script>
    function comment_add(post_id){
            comment=$("#commentbox_'+post_id' :input[name='comment']");
        $.post('<?php /*echo base_url('posts/add_comment'); */?>',{post_id:post_id,comment:comment},function(data){
            if(data=='success'){
                $('#comment_'+post_id).data()

            }else
                $('#comment_'+post_id).data()
        });
    }
</script>-->

</body>
</html>