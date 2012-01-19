<div class="col2">
<div class="featured_movies">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div class="heading">Watch Movies - Featured</div></td>
    <td width="170" align="right"><?php echo anchor('sort/featured','Show More'); ?></td>
  </tr>
</table>
<?php foreach($featured as $value){ ?>
<div class="featured_movie_item"><a href="<?php echo base_url().'watch/'.$value['film_post_link']; ?>" title="Watch <?php echo $value['film_name']; ?>"><img src="<?php echo base_url().'thumbs/'; if(file_exists($_SERVER['DOCUMENT_ROOT'].'/thumbs/'.$value['website_poster_url'].'.jpg')){ echo $value['website_poster_url']; }else{ echo "noposter"; } ?>.jpg" alt="Movie Banner" width="75px" height="113px" border="0"><?php echo $value['f_name'].".. (".$value['year'].")"; ?></a></div>
<?php } ?>
<div class="clearer"></div>
</div>