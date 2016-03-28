<?php if ($posts != null) {
     // $this->load->model('posts_model');
    foreach ($posts as $rows) {
        
   //     p($rows,0);
   $isLike =  $this->posts_model->find_like_on_post($this->session->userdata('user_id'), $rows['id']);
   $likesUser = $this->posts_model->total_likes_user_details($rows['id']);
  
      
        ?>


        <div class="orriztime orriztime-items mvm no_more_post">
            <a id="newsfeed-refresh-link" class="ng-binding"><span></span></a>
            <div class="orriztime-line"></div>
            <div class="orriztime-date"><?php echo $rows['time']; ?></div>

            <div class="ofv oln ptl pbxs">

                <a class="pull-left thumbnail orriztime-thumbnail" href="#">
                    <img src="<?php echo base_url(); ?>public/images/thumb/<?php if (($rows['image']) != null) {
            echo $rows['image'];
        } else echo "no.png"; ?>" style="width: 75px; height: 75px;">
                </a>
                <div class="orriztime-media-body">
                    <div class="orriztime-container">
                        <a class="orriztime-user-name ng-binding" href="#"><?php echo $rows['first_name'] . '  ' . $rows['last_name']; ?></a>
                        <span class="orriztime-user-info mls ng-binding"></span>

        <?php if (($rows['photos']) != null) { ?>
                            <div class="photos">
                                <a href="#">
                                    <div class="squarified ">
                                        <img src="<?php echo base_url(); ?>public/images/pic/<?php echo $rows['photos']; ?>">
                                    </div>
                                </a>


                            </div>
                                <?php } ?>
                        <div class="truncate">
                            <p class="orriztime-status"><?php echo ltrim($rows['status']); ?></p>

                        </div>

        <div class="orriztime-actions">

                            <a class="action like" href="javascript:void(0);" onclick="like_add('<?php echo $rows['id']; ?>');
                                    return false;"><i class="fa fa-thumbs-up"></i>
                                <span id="heart_<?php echo $rows['id']; ?>" class=""><?php echo !empty($isLike) ? "Unlike" : "Like"; ?></span></a>                 


                            <span class="bar"></span>
                            <a class="action comment">
                                <i class="fa fa-comment"></i>
                                <span onclick="get_comments('<?php echo $rows['id']; ?>'); ">Comment</span>
                            </a>
                            <span class="bar"></span>
                            <span class="time-ago">3 hours ago</span>
                        </div>
                    </div>
                    <div class="orriztime-comments">
                        <div class="orriztime-likes">
                            <div class="orriztime-comment-left tac pts">
                                <i class="fa fa-thumbs-up orriztime-large-thumb"></i>
                                <span id="<?php echo "post_id_" . $rows['id'] . "_likes"; ?>"> <?php echo $rows['likes']; ?>Likes
                                </span>

                            </div>
                            <div class="orriztime-likers-list">
                                <ul class="lstn mbn">
                                    
                                    <?php
                                    if(!empty($likesUser)) {
                                      foreach ($likesUser as $key => $value) { 
                                          
                                        $user = $this->posts_model->getUserDetails($value['member_id']);
                                      
                                          ?>
                                         
                                          <li class="dib pts">
                                        <a ref="javascript:void(0);">
                                            <img src="<?php echo base_url(); ?>public/images/pic/<?php  echo $user->image ; ?>" title="<?php echo $user->first_name.' '.$user->last_name; ?>" class="thumbnail" alt="<?php echo $user->first_name; ?>">
                                        </a>
                                    </li>
                                          
                                      
                                   <?php  }   
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>

      <div class="orriztime-comment read first">
                            <div class="lh20" id="get_comment_<?php echo $rows['id']; ?>">
                          
                            </div>
                        </div>
                        
                        
                        <div class="orriztime-comment post">
                                    <div class="orriztime-comment-left">
                                        <div class="thumbnail orriztime-comment-triangle-right">
                                            <img src="images/06.png" alt="">
                                        </div>
                                    </div>
                                    <div class="orriztime-container orriztime-comment-container">
                                        <form class="form-inline" role="form" id="commentbox_<?php echo $rows['id']; ?>" action="<?php echo base_url('posts/add_comment'); ?>" method="post" >
                                            <button class="btn btn-success  pvs phml pull-right mls button_post_comment"  href="javascript:void(0);"  disabled="true" onclick="add_comment('<?php echo $rows['id']; ?>');
                                                    return false;">Comment</button>
                                            <div class="textarea-wrapper">

                                                <textarea placeholder="Add comment..." class="w100 dib ofh font16 text_post_comment" name="comment_<?php echo $rows['id']; ?>" id="comment_<?php echo $rows['id']; ?>" ></textarea>
                                            </div>
                                            <span id="comment_<?php echo $rows['id']; ?>"></span>
                                        </form>
                                    </div>
                                </div>


                    </div>
                </div>

            </div>

        </div>


    <?php }
} //else echo "There is no post to show";  ?>

<script>
    $(document).ready(function () {

        $('.text_post_comment').on('keyup change', function ()
        {
    
        if ($(this).val().length)
            {
                // $(this).find('.button_post_comment')
                   $(this).parents('.textarea-wrapper').prev('.button_post_comment').attr("disabled", false);
              
            }
            else
            {
                $(this).parents('.textarea-wrapper').prev('.button_post_comment').attr("disabled", true);
            }
        });

//             $('.text_post_comment').keyup(function(e) {
//                
//                if (e.which == 13) {
//                //e.preventDefault();
//                console.log(($(this).parent().next().find('.button_post_comment').length));
//                $(this).parent().next().find('.button_post_comment').click();
//                
//                return false;
//             }
//         });
    });
</script>