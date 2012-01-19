<link rel="stylesheet" href="<?php echo base_url(); ?>css/go4film_gallery.css" type="text/css">
<div style="margin:0px 5px 0px 0px;"></div>
<div class="index_container">
<?php echo $this->session->flashdata('msg'); ?>
<div class="stage_navigation">
<?php echo $stage_nav; ?>
</div>
<div class="clearer"></div>
<div class="heading_text_under"><a href="<?php echo base_url(); ?>photos/<?php echo $this->uri->segment(3); ?>">Back to Your Gallery</a>   [ <a href="<?php echo base_url(); ?>editpics">Edit Pictures</a> ] <a href="<?php echo base_url(); ?>profile/<?php echo $this->uri->segment(3); ?>">Back to <?php echo $this->uri->segment(3); ?>'s Profile</a></div>
<div class="clearer"></div>
<div class="photo_thumbs_container">
<p>This user has <strong><?php echo count($latest_pics); ?></strong> pictures for you to check out.</p>
<?php 
if(count($latest_pics)>0)
{
$i=1; 
foreach($latest_pics as $row){ 
?>
<a href="<?php echo base_url(); ?>photos/<?php echo $this->uri->segment(3); ?>/<?php echo $row['picture_id']; ?>"><img src="<?php echo base_url().'pix/'.$pic_user_id.'/'.$row['picture_act_id'] ?>.jpg" width="100px" height="75px" border="0" /></a>
<?php $i++; if($i==5){ ?>
<div class=clearer></div>
<?php $i=1; }} ?>
<div class=clearer></div>
<div class=clearer></div>
<?php echo $this->pagination->create_links(); }else { ?>
<div class='info_message'>This user doesn't have any Photos</div>
<?php } ?>
</div>
</div>
</div>
<div class="clearer"></div>
</div>