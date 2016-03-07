<?php if($posts!=null){foreach($posts as $rows){
    ?>
    <div class="detailBox">
        <li>
            <div class="row">
                <div class="col-md-6">
                        <div class="userImage">
                            <a style="font-size: 15px;" href="#" target="_blank"><?php echo $rows['first_name'].'  '.$rows['last_name'];?></a>
                            <img style="width: 50px; height: 50px; margin-left:5px; margin-top:5px;" src="<?php echo base_url(); ?>public/images/thumb/<?php if(($rows['image'])!=null){ echo $rows['image'];} else echo "no.png"; ?>" class="avatar">
                        </div>
                </div>
                <div class="col-md-5">
                    <div class="pull-right">
                        <b> <?php echo $rows['time']; ?></b>
                    </div> 
                </div>
            </div>
            
<!--            <div class="userImage"><img style="width: 50px; height: 50px;" src="<?php echo base_url(); ?>public/images/thumb/<?php if(($rows['image'])!=null){ echo $rows['image'];} else echo "no.png"; ?>
						" class="avatar"><div class="pull-right">
                    Posted on: <?php echo $rows['time']; ?>
                </div> </div>-->
            <div class="status">
                
                <div class="commentBox">

                    <p class="taskDescription"><?php echo $rows['status'];?></p>
                </div>



                <?php if(($rows['photos'])!=null){ ?>

                    <img class="external_pic" src="<?php echo base_url(); ?>public/images/pic/<?php echo $rows['photos'];?>
								"> <?php } ?>
                    
                    <div class="clearfix"></div>


                <h5><a href="" onclick="like_add('<?php echo $rows['id']; ?>'); return false;"><span id="heart_<?php echo $rows['id']; ?>" class="glyphicon glyphicon-heart"></span></a> <span id="<?php echo "post_id_".$rows['id']."_likes"; ?>"><?php echo $rows['likes']; ?>
								</span> People <span class="glyphicon glyphicon-heart"></span> </h5>




                <div class="actionBox">
                    <ul class="commentList" id="get_comment_<?php echo $rows['id']; ?>">                <span id="view_<?php echo $rows['id']; ?>"><a href="" onclick="get_comments('<?php echo $rows['id']; ?>'); return false;">View Comments</a></span>

<!--                        <li>-->
<!--                            <div class="commenterImage">-->
<!--                                <img src="http://lorempixel.com/50/50/people/6" />-->
<!--                            </div>-->
<!--                            <div class="commentText">-->
<!--                                <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>-->
<!---->
<!--                            </div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div class="commenterImage">-->
<!--                                <img src="http://lorempixel.com/50/50/people/7" />-->
<!--                            </div>-->
<!--                            <div class="commentText">-->
<!--                                <p class="">Hello this is a test comment and this comment is particularly very long and it goes on and on and on.</p> <span class="date sub-text">on March 5th, 2014</span>-->
<!---->
<!--                            </div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div class="commenterImage">-->
<!--                                <img src="http://lorempixel.com/50/50/people/9" />-->
<!--                            </div>-->
<!--                            <div class="commentText">-->
<!--                                <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>-->
<!---->
<!--                            </div>-->
<!--                        </li>-->Whats is in Your Mind?
                    </ul>
                    <form class="form-inline" role="form" id="commentbox_<?php echo $rows['id']; ?>" action="<?php echo base_url('posts/add_comment'); ?>" method="post" >
                        <div class="row">
                            <div class="col-md-10">
                                <textarea cols="65" class="form-control text_post_comment" name="comment_<?php echo $rows['id']; ?>" id="comment_<?php echo $rows['id']; ?>" placeholder="Your comments" ></textarea>
                            </div>
                            <div class="col-md-2">
                            <button class="btn btn-success button_post_comment" href="javascript:void(0);" disabled="true" style="margin-top: 35px;" onclick="add_comment('<?php echo $rows['id']; ?>'); return false;">Submit</button>
                            </div>
                        </div>
                        <span id="comment_<?php echo $rows['id']; ?>"></span>
                    </form>
                </div>
            </div>

        </li>
    </div>
<?php }} //else echo "There is no post to show"; ?>

<script>
    $(document).ready(function(){
//       
//            console.log($('.status').length);
//            $('.detailBox .text_post_comment').on('keypress','textarea', function (e) {
//            console.log($(this).length);
//            });
//            
//            console.log($('.actionBox').find('textarea').length);

            $('.text_post_comment').on('keyup change', function()
            {
                if($(this).val().length)
                {
                    $(this).parent().next().find('.button_post_comment').attr("disabled", false);
                }
                else
                {
                    $(this).parent().next().find('.button_post_comment').attr("disabled", true);
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