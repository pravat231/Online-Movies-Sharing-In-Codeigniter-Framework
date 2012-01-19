<div style="margin:0px 5px 0px 0px;"></div>
<div class="index_container">
<div class="stage_navigation">
<?php echo $stage_nav; ?>
</div>
<div class="index_show_by2">
<table width="170" border="0" cellpadding="1" cellspacing="1">
<tr>
<td width="50"><?php if($sort_url!=''){ ?>Sort By:<?php } ?></td>
<td width="120">
<div class="menu">
<ul>
<?php echo $sort_url; ?>
</ul>
</div>
</td>
</tr>
</table>
</div>
<div class="clearer"></div>
<h1 style="display:none">Watch free and latest movies online at go4film.com</h1>
<?php
if(count($latest_post)>0){
$i=1; 
foreach($latest_post as $row){ 
?>
<div class="index_item"><a href="<?php echo base_url(); ?>watch/<?php echo $row['film_post_link']; ?>" title="Watch <?php echo $row['film_name']; ?>"><img src="<?php echo base_url().'thumbs/'; if(file_exists($_SERVER['DOCUMENT_ROOT'].'/thumbs/'.$row['website_poster_url'].'.jpg')){ echo $row['website_poster_url']; }else{ echo "noposter";  } ?>.jpg" alt="Movie Banner" width="150px" height="225px" border="0"></a>
<div class="index_title"><a href="<?php echo base_url(); ?>watch/<?php echo $row['film_post_link']; ?>" title="Watch <?php echo $row['film_name']; ?>"><?php echo $row['film_name']; ?></a></div>
<div class="index_info_left">Release:</div>
<div class="index_info_right"><?php echo $row['DATE']; ?> <a href="<?php echo base_url(); ?>year/<?php echo $row['YEAR']; ?>/month/<?php echo $row['month_ori']; ?>"><?php echo $row['MONTH']; ?></a> <a href="<?php echo base_url(); ?>year/<?php echo $row['YEAR']; ?>"><?php echo $row['YEAR']; ?></a></div>
<div class="clearer"></div></div>
<?php $i++; if($i==5){ ?>
<div class=clearer></div>
<?php $i=1; }} ?>
<div class=clearer></div>
<div class=clearer></div>
<?php echo $this->pagination->create_links(); }else{ ?>
<div class='info_message'>Sorry but I couldn't find anything like that.</div>
<div class=clearer></div>
<div class=clearer></div>
<?php } ?>
</div>
</div>