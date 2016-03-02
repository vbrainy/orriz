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
                    <br/><a href="" onclick="like_add('<?php echo $rows['id']; ?>'); return false;"><span id="heart_<?php echo $rows['id']; ?>" class="glyphicon glyphicon-heart"></span></a> <span id="<?php echo "post_id_".$rows['id']."_likes"; ?>"><?php echo $rows['likes']; ?>
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
<!--                        </li>-->
                    </ul>
                    <form class="form-inline" role="form" id="commentbox_<?php echo $rows['id']; ?>" action="<?php echo base_url('posts/add_comment'); ?>" method="post" >
                        <div class="form-group">
                            <textarea class="form-control" style="height: 30px;" type="text" name="comment_<?php echo $rows['id']; ?>" id="comment_<?php echo $rows['id']; ?>" placeholder="Your comments" ></textarea>

                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" href="" onclick="add_comment('<?php echo $rows['id']; ?>'); return false;">Add</button>
                        </div>
                        <span id="comment_<?php echo $rows['id']; ?>"></span>
                    </form>
                </div>
            </div>

        </li>
    </div>
<?php }} else echo "There is no post to show"; ?>