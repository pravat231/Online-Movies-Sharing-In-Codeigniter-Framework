<div style="margin:0px 5px 0px 0px;"></div>
<div class="index_container">
<?php echo $this->session->flashdata('msg'); ?>
<div class="stage_navigation">
<?php echo $stage_nav; ?>
</div>
<div class="clearer"></div>
<?php 
if(count($latest_post)>0)
{
$i=1; 
foreach($latest_post as $row){ 
?>
<div class="index_item"><a href="<?php echo base_url(); ?>watch/<?php echo $row['film_post_link']; ?>" title="Watch <?php echo $row['film_name']; ?>"><img src="<?php echo base_url().'thumbs/'; if(file_exists($_SERVER['DOCUMENT_ROOT'].'/thumbs/'.$row['website_poster_url'].'.jpg')){ echo $row['website_poster_url']; }else{ echo "noposter";  } ?>.jpg" width="150px" height="225px" border="0" /></a>
<div class="index_title"><a href="<?php echo base_url(); ?>watch/<?php echo $row['film_post_link']; ?>" title="Watch <?php echo $row['film_name']; ?>"><?php echo $row['film_name']; ?></a></div>
<div class="fav_date">Added: <?php echo $row['added_on']; ?></div>
<?php if($this->session->userdata('user_name')==$this->uri->segment(3)){ ?>
<div class="favs_deleted"><a href='<?php echo base_url(); ?>delfrmfavs/<?php echo $row['favorite_id']; ?>' ref='delete_fav' name='delete'>Delete Favorite</a></div>
<?php } ?>
<div class="clearer"></div>
</div>
<?php $i++; if($i==5){ ?>
<div class=clearer></div>
<?php $i=1; }} ?>
<div class=clearer></div>
<div class=clearer></div>
<?php echo $this->pagination->create_links(); }else { ?>
<div class='info_message'>This user doesn't have any watched videos</div>
<?php } ?>
</div>
</div>
<div class="clearer"></div>
</div>