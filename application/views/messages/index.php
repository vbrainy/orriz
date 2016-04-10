<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <title>Site Title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Bootstrap Css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css" />  
        <!--Custom Css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css" />
        <!--Media Queries Css-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/screen.css" />
        <!--Jquery-1.11.1.min.js-->
        <script src="<?php echo base_url(); ?>public/js/jquery-1.11.3.min.js"></script>
        <!--Bootstrap Jquery-->
        <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/common.js"></script>
        <script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/popup.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/error.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/post.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/wall.css" />
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
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="cover-picture-profile">
                        <div class="cover-picture" id="cover_picture">
                            <div class="profile-picture">
                                <img src="<?php echo base_url(); ?>public/images/thumb/<?php
                                if (!empty($image)) {
                                    echo $image;
                                }
                                else
                                    echo "no.png";
                                ?>
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
            <div class="row" style="height: 500px;">
                <div class="col-md-12">
                    <div class="posts-ads-container">
                        <ul class="nav nav-tabs" style="width: 96%">
                            <li class="active"><a data-toggle="tab" href="#inbox_tab">Inbox</a></li>
                            <li><a data-toggle="tab" href="#sentbox_tab">Sentbox</a></li>
                            <li><a data-toggle="tab" href="#compose_tab">Compose Message</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="inbox_tab" class="tab-pane fade in active">
                                <div class="row inbox_header">
                                    <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2"><input type="checkbox" class="checkbox_message"/></div>

                                        <div class="col-md-2"></div>
                                        <div class="col-md-3">From</div>

                                        <div class="col-md-3">Subject</div>

                                        <div class="col-md-2">Action</div>

                                    </div>
                                    </div>
                                </div>
                                <hr class="hr_margin">
                                
                                <?php if(isset($msgTypeFlag) && $msgTypeFlag == 'reply') { //print_R($thread_init); ?>
                                <a href="<?php echo base_url() ?>messages/index">Back to Inbox</a>
                                <form method="post" action="<?php echo base_url('messages/reply').'/'.$this->uri->segments['3'];?>">
                                    <input type="hidden" name="sender_id" value="<?php echo $this->session->userdata('user_id') ?>"/>
                                    <input type="hidden" name="receiver_id" value="<?php echo $thread_end['sender_id'] ?>"/>
                                    <input type="hidden" name="subject" value="<?php echo $thread_end['subject'] ?>"/>
                                    <input type="hidden" name="parent_id" value="<?php echo $thread_init[0]['id'] ?>"/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="details-form-group">
                                            <textarea name="message" class="ckeditor"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pull-right">
                                        <div class="col-md-6">
                                            <div class="details-form-group">
                                            <input type="submit" value="Submit" class="btn btn-primary"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="details-form-group">
                                                <a href="<?php echo base_url() ?>messages/index" class="btn btn-default">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
    
                                <?php } else { ?>
                                
                                <?php if(!empty($inbox_data)) { ?>
                                <?php foreach($inbox_data as $key=>$value) { ?>
                                <div class="row inbox_rows">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2"><input type="checkbox" class="checkbox_message"/></div>
                                            
                                            <div class="col-md-2"><img class="image_resize" src="<?php echo base_url(); ?>public/images/thumb/<?php echo $value['image'] ?>" /></div>
                                            
                                            <div class="col-md-3"><?php echo $value['first_name'] ?></div>
                                            
                                            <div class="col-md-3"><?php echo $value['subject'] ?></div>
                                            
                                            <div class="col-md-2"><a href="<?php echo base_url() ?>messages/reply/<?php echo $value['thread_id'] ?>">Reply</a> | <a href="<?php echo base_url() ?>messages/delete/<?php echo $value['id'] ?>">Delete</a></div>
                                            
                                        </div>
                                    </div>
                                </div> 
                                <hr class="hr_margin">
                                <?php } ?>
                                <?php } else { ?>
                                <div class="row inbox_rows">
                                    <div class="col-md-12">
                                      No Recornds Found  
                                    </div>
                                </div>
                                <?php  } ?>
                                <?php } ?>
                            </div>

                            <div id="sentbox_tab" class="tab-pane fade" style="height: 71px;">
                                <div class="row inbox_header">
                                    <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2"><input type="checkbox" class="checkbox_message"/></div>

                                        <div class="col-md-2"></div>
                                        <div class="col-md-3">From</div>

                                        <div class="col-md-3">Subject</div>

                                        <div class="col-md-2">Action</div>

                                    </div>
                                    </div>
                                </div>
                                <hr class="hr_margin">
                                <?php if(!empty($sentbox_data)) { ?>
                                <?php foreach($sentbox_data as $key=>$value) { ?>
                                <div class="row inbox_rows">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2"><input type="checkbox" class="checkbox_message"/></div>
                                            
                                            <div class="col-md-2"><img class="image_resize" src="<?php echo base_url(); ?>public/images/thumb/<?php echo $value['image'] ?>" /></div>
                                            
                                            <div class="col-md-3"><?php echo $value['first_name'] ?></div>
                                            
                                            <div class="col-md-3"><?php echo $value['subject'] ?></div>
                                            
                                            <div class="col-md-2"><a href="<?php echo base_url() ?>messages/delete/<?php echo $value['id'] ?>">Delete</a></div>
                                            
                                        </div>
                                    </div>
                                </div> 
                                <hr class="hr_margin">
                                <?php } ?>
                                <?php } else { ?>
                                <div class="row inbox_rows">
                                    <div class="col-md-12">
                                      No Recornds Found  
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div id="compose_tab" class="tab-pane fade" style="height: 71px;">
                                <div style="color: #F8BB22">   <?php  echo  $this->session->flashdata('message'); ?> </div>
                                <form method="post" action="<?php echo base_url('messages/compose') ?>">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="step-label">From:</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="hidden" name="sender_id" value="<?php echo $this->session->userdata('user_id'); ?>"/>
                                            <div class="details-form-group">
                                            <?php echo isset($first_name) ? $first_name : '' ." "; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="step-label">To:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="details-form-group">
                                            <select name="receiver_id" class="join-form-control">
                                                <?php foreach ($friends_list as $key => $value) { ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['first_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="step-label">Subject:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="details-form-group">
                                            <input type="text" name="subject"  class="join-form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="details-form-group">
                                            <textarea name="message" class="ckeditor"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pull-right">
                                        <div class="col-md-6">
                                            <div class="details-form-group">
                                            <input type="submit" value="Submit" class="btn btn-primary"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="details-form-group">
                                            <a href="<?php echo base_url() ?>messages/index" class="btn btn-default">Cancel</a>
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
        <!--<div id="<?php
        if ($active == 0) {
            echo "popup";
        }
        else
            echo "popup1";
        ?>">
            <h1>Hello <?php echo $first_name; ?>
            </h1>
            <h3>Welcome to MLM website!</h3>
            <p>
                Your Account is Not verified Please check your email and click on the activation link to Verify Your account.
            </p>
        </div>
        <div id="error">
            <h3><?php
        if (!empty($message)) {
            echo $message;
        }
        ?>
            </h3>
            <button class="btn-default close-image" id="error_btn" type="reset" name="ok" value="ok">ok</button>
        </div>
        Marquee Jquery
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
        </script>-->
        <script>
            window.onload;
            {
                time = new Date().getUTCHours();
                minute = new Date().getUTCMinutes();
                timezone = new Date().getTimezoneOffset();
                if (timezone > 0) {
                    hour = time * 60 + minute + timezone;
                    currenttime = hour / 60;
                } else
                    hour = time * 60 + minute - timezone;
                currenttime = hour / 60;
                var theDiv = document.getElementById("wraptextelement");
                var content;
                if (currenttime >= 5 && currenttime < 10) {
                    document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/morning.png)";
                    content = document.createTextNode("Morning");
                } else if (currenttime >= 10 && currenttime < 16) {
                    document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/afternoon.png)";
                    content = document.createTextNode("Afternoon");
                } else if (currenttime >= 16 && currenttime < 19) {
                    document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/evening.png)";
                    content = document.createTextNode("Evening");
                } else if (currenttime >= 19 && currenttime < 24) {
                    document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/night.png)";
                    content = document.createTextNode("Night");
                    theDiv.style.color = 'white';
                } else if (currenttime >= 24 && currenttime < 30) {
                    document.getElementById("cover_picture").style.background = "url(<?php echo base_url(); ?>public/images/night.png)";
                    content = document.createTextNode("Mid Night");
                    theDiv.style.color = 'white';
                }
                var breakLine = document.createElement("br");
                var dummyText = document.createTextNode("Dummy text for 1 liner or 2 liner");
                theDiv.appendChild(content);
                theDiv.appendChild(breakLine);
                theDiv.appendChild(dummyText);
            }
        </script>
    </body>
</html>