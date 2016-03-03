<?php foreach($comments as $comment) {?>
<li>
    <div class="commenterImage">
        <img src="<?php echo base_url(); ?>public/images/thumb/<?php if(($comment['image'])!=null){ echo $comment['image'];} else echo "no.png"; ?>"/>
    </div>
    <div class="commentText">
        <p class=""><?php echo $comment['first_name'].'  '.$comment['last_name'].': ';?><?php echo $comment['comment'] ?></p> <span class="date sub-text">on <?php echo $comment['timestamp']; ?></span>

    </div>
</li>
<?php } ?>