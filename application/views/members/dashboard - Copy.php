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
            $total_records= <?php echo $this->data['total_records']; ?>;
            $records_per_page=<?php echo $this->data['records_per_page']; ?>;
            $number_of_pages=<?php echo $this->data['number_of_pages']; ?>;
            $current_page=<?php echo $this->data['current_page']; ?>;
            $start=<?php echo $this->data['start']; ?>;
            $friend_list=<?php echo json_encode($this->data['friends']); ?>;
            $privacy=<?php echo $this->data['privacy']; ?>;
            load_data($records_per_page,$start,$privacy,$friend_list);

            function load_data($records_per_page,$start,$privacy,$friend_list){
                $.ajax({
                    url: "<?php echo base_url('posts/ajex_load_posts'); ?>",
                    type: "post",
                    data:{"records_per_page": $records_per_page,"start": $start,"privacy": $privacy,"friends": $friend_list},
                    dataType: "html",
                    beforeSend:function(){
                        $("#amardev").append("<span class='load'>loading..</span>");
                    },
                    complete:function(){
                        $(".load").remove();
                    },
                    success:function(response){
                        $("#amardev").append(response);

                        var result = $('<div />').append(response).find('#amardev').html();
                        $('#amardev').html(result);

                    }
                })
            }
        })
    </script>
</head>
<body>
<div class="yellow-line">
</div>
<?php $this->
load->view('members/dashboard_top'); ?>
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
                    <form role="form" action="<?php echo base_url('posts/status_insert'); ?>
						" enctype="multipart/form-data" method="post">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Status Update</a></li>
                            <li><a data-toggle="tab" href="#menu1">Add Photo</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <textarea name="status" cols="88" rows="3" placeholder="Whats is in Your Mind?"></textarea>
                            </div>
                            <div id="menu1" class="tab-pane fade" style="height: 71px;">
                                <h5>Select Photo From Your Computer</h5>
                                <input type="file" name="image"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-offset-8">
                            <div class="form-group">
                                <select name="privacy" class="form-control privacy-dropdown pull-left input-sm">
                                    <option value="1" selected="selected">Public</option>
                                    <option value="2">Only my friends</option>
                                    <option value="3">Only me</option>
                                </select>
                                <input type="submit" name="submit" value="Post" class="btn btn-primary pull-right">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <form role="form" method="post" action="<?php echo base_url('posts/privacy'); ?>
						" > <label class="btn-default">Show:</label>
                        <button type="submit" value="1" <?php if($privacy=="1"){echo "disabled";}?> class="btn-sm btn-<?php if($privacy=="1"){echo "success";} else echo "default";?>
						 " name="privacy">Everyone</button>
                        <button type="submit" value="2" <?php if($privacy=="2"){echo "disabled";}?> class="btn-sm btn-<?php if($privacy=="2"){echo "success";} else echo "default";?>
						" name="privacy" >Friends</button>
                        <button type="submit" value="3" <?php if($privacy=="3"){echo "disabled";}?> class="btn-sm btn-<?php if($privacy=="3"){echo "success";} else echo "default";?>
						" name="privacy" >Me</button>
                    </form>
                </div>
                <br>
                <div id="amardev" ></div>
                <div id="wallz" class="fb_wall">
                       <ul id="posts">
                            <?php if($posts!=null){foreach($posts as $rows){
                                ?>
                                <div class="detailBox">
                                    <li>
                                        <div class="userImage"><img style="width: 50px; height: 50px;" src="<?php echo base_url(); ?>public/images/thumb/<?php if(($rows['image'])!=null){ echo $rows['image'];} else echo "no.png"; ?>
						" class="avatar"> </div>
                                        <div class="status">
                                            <h2><a href="#" target="_blank"><?php echo $rows['first_name'].'  '.$rows['last_name'];?>
                                                </a></h2>


                                            <div class="commentBox">

                                                <p class="taskDescription"><?php echo $rows['status'];?></p>
                                            </div>



                                            <?php if(($rows['photos'])!=null){ ?>

                                                <img class="external_pic" src="<?php echo base_url(); ?>public/images/pic/<?php echo $rows['photos'];?>
								"> <?php } ?>



                                            <h5>   Posted on: <?php echo $rows['time']; ?>
                                                <br/><a href="" onclick="like_add('<?php echo $rows['id']; ?>'); return false;"><span id="heart_<?php echo $rows['id']; ?>" class="glyphicon glyphicon-heart"></span></a> <span id="<?php echo " post_id_".$rows['id']."_likes"; ?>"><?php echo $rows['likes']; ?>
								</span> People <span class="glyphicon glyphicon-heart"></span> </h5>




                                            <div class="actionBox">
                                                <ul class="commentList">
                                                    <li>
                                                        <div class="commenterImage">
                                                            <img src="http://lorempixel.com/50/50/people/6" />
                                                        </div>
                                                        <div class="commentText">
                                                            <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="commenterImage">
                                                            <img src="http://lorempixel.com/50/50/people/7" />
                                                        </div>
                                                        <div class="commentText">
                                                            <p class="">Hello this is a test comment and this comment is particularly very long and it goes on and on and on.</p> <span class="date sub-text">on March 5th, 2014</span>

                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="commenterImage">
                                                            <img src="http://lorempixel.com/50/50/people/9" />
                                                        </div>
                                                        <div class="commentText">
                                                            <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                                                        </div>
                                                    </li>
                                                </ul>
                                                <form class="form-inline" role="form" id="commentbox_<?php echo $rows['id']; ?>" action="<?php echo base_url('posts/add_comment'); ?>" method="post" >
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="comment_<?php echo $rows['id']; ?>" id="comment_<?php echo $rows['id']; ?>" placeholder="Your comments" />

                                                    </div>
                                                    <div class="form-group">
                                                        <a class="btn btn-default" href="" onclick="add_comment('<?php echo $rows['id']; ?>'); return false;">Add</a>
                                                    </div>
                                                    <span id="comment_<?php echo $rows['id']; ?>"></span>
                                                </form>
                                            </div>
                                        </div>

                                    </li>
                                </div>
                            <?php }} else echo "There is no post to show"; ?>
                        </ul>
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
<div id="popup">
    <h1>Hello <?php echo $first_name; ?>
    </h1>
    <h3>Welcome to MLM website!</h3>
    <p>
        Your Account is Not verified Please check your email and click on the activation link to Verify Your account.
    </p>
</div>
<div id="error">
    <h3><?php echo $message; ?>
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
      var  comment= $('#comment_'+post_id).val();

        $.post('<?php echo base_url('posts/add_comment'); ?>',{post_id:post_id,comment:comment},function(data){
            if(data=='success'){
                $('#comment_'+post_id).val('');
                alert(data);
            }else
                alert(data);
        });
    }
    function like_get(post_id){
        $.post('<?php echo base_url('posts/get_like'); ?>',{post_id:post_id},function(data){
            $('#post_id_'+post_id+'_likes').text(data);
        });
    }
</script>
<script>
    function like_add(post_id){
        $.post('<?php echo base_url('posts/like_post'); ?>',{post_id:post_id},function(data){
            if(data=='success'){
                $('#heart_'+post_id).hide();
                like_get(post_id);
            }else
                $('#heart_'+post_id).hide();
        });
    }
    function like_get(post_id){
        $.post('<?php echo base_url('posts/get_like'); ?>',{post_id:post_id},function(data){
            $('#post_id_'+post_id+'_likes').text(data);
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