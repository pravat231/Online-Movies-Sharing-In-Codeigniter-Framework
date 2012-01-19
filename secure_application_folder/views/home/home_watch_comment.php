<a name="comments"></a>
<div class="choose_tabs2">
<ul class="tabNavigation2">
<li><a href="#forth" title="Comments on Last Cry">Last Cry Comments</a></li>
</ul>
<div class="actual_tab2" id="forth">
<?php
if(count($row_comments)>0){
foreach($row_comments as $comment_value){ ?>
<a name="<?php echo $comment_value['comment_id']; ?>"></a>
<div data-id="<?php echo $comment_value['comment_id']; ?>" class="comment_box">
    <div class="comment_box_avatar">
    <a href="<?php echo base_url(); ?>profile/<?php echo $comment_value['username']; ?>"><img src="<?php echo base_url().'user_thumb/'; if(file_exists($_SERVER['DOCUMENT_ROOT'].'/user_thumb/'.$comment_value['avatar'].'.jpg')){ echo $comment_value['avatar']; }else{ echo 'noavatar'; } ?>.jpg" width="50"></a>
    </div>
    <div class="comment_box_info">
    <table width="560" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td>Posted by <a href="<?php echo base_url(); ?>profile/<?php echo $comment_value['username']; ?>"><?php echo $comment_value['username']; ?></a> <?php echo date_when(mysql_to_unix($comment_value['comment_time'])); ?></td>
    <td width="200"><div class="comments_box_vote" ref='<?php echo $comment_value['comment_id']; ?>'>
    <div class="clearer"></div>
    </div></td>
    </tr>
    </table>
    <p><?php echo nl2br($comment_value['comment_msg']); ?></p>
    </div>
    <div class="clearer"></div>
</div>
<?php } ?>
<div class="clearer"></div>
<?php echo $this->pagination->create_links(); ?>
<div class="clearer"></div>
<?php }else{ ?>
<div class='info_message'>No comments on this item</div>
<?php } ?>