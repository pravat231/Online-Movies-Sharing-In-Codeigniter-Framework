<div style="margin:0px 5px 0px 0px;"></div>
<div class="index_container">
<?php
if(!empty($row_watch)){
?>
<script type="text/javascript" charset="utf-8">
$(function () {
	var tabContainers = $('div.choose_tabs > div');
	tabContainers.hide().filter(':first').show();
	$('div.choose_tabs ul.tabNavigation a').click(function () {
		tabContainers.hide();
		tabContainers.filter(this.hash).show();
		$('div.choose_tabs ul.tabNavigation a').removeClass('selected');
		$(this).addClass('selected');
		return false;
	}).filter(':first').click();
});
$(function () {
	var tabContainers = $('div.choose_tabs2 > div');
	tabContainers.hide().filter(':first').show();
	$('div.choose_tabs2 ul.tabNavigation2 a').click(function () {
		tabContainers.hide();
		tabContainers.filter(this.hash).show();
		$('div.choose_tabs2 ul.tabNavigation2 a').removeClass('selected');
		$(this).addClass('selected');
		return false;
	}).filter(':first').click();
});
</script>
<div class="stage_navigation movie_navigation"><?php echo $stage_nav; ?></div>
<h1 style="display:none"><?php echo $row_watch->film_name.' '.$row_watch->year; ?> Movie Watch Online</h1>
<div class="clearer"></div>
<div class="movie_info">
<div class="movie_info_thumb">
<div class="movie_thumb">
<img src="<?php echo base_url().'thumbs/'; if(file_exists($_SERVER['DOCUMENT_ROOT'].'/thumbs/'.$row_watch->website_poster_url.'.jpg')){ echo $row_watch->website_poster_url; }else{ echo "noposter"; } ?>.jpg" alt="Movie Banner" width="150px" height="225px" border="0"></div>
<span class="download_movie_button"><a href="#" title="Download <?php echo $row_watch->film_name; ?>" target="_blank">Download Movie</a></span>
</div>
<div class="movie_info_info">
<p><?php echo $row_watch->film_plot; ?></p>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td width="89"><strong>Released:</strong></td>
<td width="357"><?php echo $row_watch->month." ".$row_watch->date_ori.",".$row_watch->year; ?></td>
</tr>
<?php if(!empty($row_watch->film_genre_value)){ $row_genres=array(); if(stristr($row_watch->film_genre_value,',')){ $row_genres=explode(",",$row_watch->film_genre_value); }else{ array_push($row_genres,$row_watch->film_genre_value);} ?>
<tr>
<td width="89"><strong>Genres:</strong></td>
<td><span class="movie_info_genres"><?php foreach($row_genres as $genre_value){ ?><a href="<?php echo base_url(); ?>genre/<?php echo strtolower($genre_value); ?>"><?php echo $genre_value; ?></a> <?php } ?></span></td>
</tr>
<?php } ?>
<?php if(!empty($row_watch->film_director_value)){ $row_directors=array(); if(stristr($row_watch->film_director_value,',')){ $row_directors=explode(",",$row_watch->film_director_value); }else{ array_push($row_directors,$row_watch->film_director_value);} ?>
<tr>
<td width="89"><strong>Director:</strong></td>
<td><?php foreach($row_directors as $director_value){ list($director_id,$director_name) = explode('|', $director_value); ?><a href="<?php echo base_url(); ?>director/<?php echo $director_id; ?>"><?php echo $director_name; ?></a> <?php } ?></td>
</tr>
<?php } ?>
<?php if(!empty($row_watch->film_actor_value)){ $row_actors=array(); if(stristr($row_watch->film_actor_value,',')){ $row_actors=explode(",",$row_watch->film_actor_value); }else{ array_push($row_actors,$row_watch->film_actor_value);} ?>
<tr>
<td width="89"><strong>Actors: </strong></td>
<td><span class="movie_info_actors"><?php foreach($row_actors as $actor_value){ list($actor_id,$actor_name) = explode('|', $actor_value); ?><a href="<?php echo base_url(); ?>actor/<?php echo $actor_id; ?>"><?php echo $actor_name; ?></a> <?php } ?></span></td>
</tr>
<?php } ?>
<tr>
<td colspan="2">
<div class="movie_info_actions">
<div class="mlink_imdb"> <a href="<?php echo $row_watch->imdb_link; ?>" target="_blank"></a></div>
<div class="mlink_splitter"></div>
<div class="mlink_buydvd">
<a href="http://www.amazon.com/gp/search?ie=UTF8&amp;tag=go4filwatchon-20&amp;index=dvd&amp;linkCode=ur2&amp;camp=1789&amp;creative=9325&amp;keywords=<?php echo $row_watch->film_name; ?>" target="_blank"></a></div>
<div class="mlink_splitter"></div>
<div class="addthis_toolbox addthis_default_style mlink_share"><a href="http://www.addthis.com/bookmark.php?v=250&amp;username=pravat231" class="addthis_button_compact"><img src="<?php echo base_url(); ?>images/pixel.gif" alt="" style="border:none"></a></div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js?pub=pravat231"></script>
<div class="clearer"></div><br>
<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.go4film.com%2Fwatch%2F<?php echo $row_watch->film_post_link; ?>&amp;layout=standard&amp;show_faces=false&amp;width=300&amp;action=like&amp;font=segoe+ui&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:25px;"></iframe>
</div>
</td>
</tr>
</table>
</div>
<div class="clearer"></div>
</div> 
<div class="choose_tabs">
<ul class="tabNavigation">
<li><a href="#first" title="Watch <?php echo $row_watch->film_name; ?>"><?php echo $row_watch->film_name; ?> Links</a></li>
<li><a href="#second" title="Movies similar to <?php echo $row_watch->film_name; ?>">Similar</a></li>
<li><a href="#third" title="Share <?php echo $row_watch->film_name; ?>">Share</a></li>      
</ul>
<div class="actual_tab" id="first">
<?php if(!empty($row_watch->trailer)){ ?>
<table width="100%" cellpadding="0" cellspacing="0" class="movie_version">
<tr>
<td width=40 align="center" valign=middle><span class=quality_unknown></span></td>
<td align="left" valign=middle><span class="movie_version_link"><a href='javascript: void(0);' class="slick-toggle">Watch Trailer</a></span></td>
<td width="120" align="center" valign="middle"></td>
<td width="70" align="center" valign="middle"></td>
<td width="80" align="center" valign="middle"></td>
<td width="100" align="left" valign="middle">&nbsp;</td>
</tr>
</table>
<div class="movie_info_trailer" style="display:none"><?php echo str_replace('&','&amp;',$row_watch->trailer); ?></div>
<?php } ?>
<?php if(!empty($row_versions)){ $j=1; foreach($row_versions as $version_row){ ?>		  
<table width="100%" cellpadding="0" cellspacing="0" class="movie_version">
<tbody>
<tr>
<td align="center" width="40" valign="middle">
<?php if($version_row['link_type']=='dvd'){ ?><span class=quality_dvd></span><?php }elseif($version_row['link_type']=='ts'){ ?><span class="quality_ts"></span><?php }elseif($version_row['link_type']=='cam'){ ?><span class="quality_cam"></span><?php }else{ ?><span class=quality_unknown></span><?php } ?></td>
<td align="left" valign="middle"><span class="movie_version_link"><?php if($version_row['link_url_1']!=''){ ?><a href="<?php echo base_url(); ?>version/<?php echo $version_row['link_id']; ?>/part/1" rel="nofollow" target="_blank">Watch Version <?php echo $j; ?></a><?php }if($version_row['link_url_2']!=''){ ?>[<a href="<?php echo base_url(); ?>version/<?php echo $version_row['link_id']; ?>/part/2" rel="nofollow" target="_blank">Part 2</a>]<?php }if($version_row['link_url_3']!=''){ ?>[<a href="<?php echo base_url(); ?>version/<?php echo $version_row['link_id']; ?>/part/3" rel="nofollow" target="_blank">Part 3</a>]<?php } ?></span></td>
<td align="center" width="115" valign="middle"><span class="version_host"><?php echo $version_row['link_host_domain']; ?></span></td>
<td width="65" align="center" valign="middle"> <span class="version_veiws"><?php echo $version_row['link_views']; ?> views</span></td>
</tr>
</tbody>
</table>
<?php $j++;}}else{ ?>
<div class='warning_message'>No link available for this item</div>
<?php } ?>
<table cellspacing="2" cellpadding="2" border="0" width="100%">
<tbody><tr>
<td width="35"><span class="quality_dvd"></span></td>
<td>= High Quality</td>
<td width="35"><span class="quality_ts"></span></td>
<td>= Medium Quality</td>                
<td width="35"><span class="quality_cam"></span></td>
<td>= Low Quality</td>
<td width="200"><span class="help_link"><!--<a href="/faq.php">How do I watch these?</a>--></span></td>
</tr>
</tbody>
</table>
</div>
<div class="actual_tab" id="second">
<div class='info_message'>No similar stuff to show</div><div class="clearer"><center>Watch movies similar to <?php echo $row_watch->film_name; ?></center></div>
</div>
<div class="actual_tab" id="third">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
<tr>
<td><div class="form_info_header">HTML Code</div>
<textarea name="embed_html" rows="2" cols="3" class="embed_code_box"  onFocus="this.select()"><a href="<?php echo base_url(); ?>watch/<?php echo $row_watch->film_post_link; ?>">Watch "<?php echo $row_watch->film_name; ?>" <img src="<?php echo $row_watch->original_poster_url; ?>" alt=""></a></textarea></td>
<td><div class="form_info_header">Forum Code</div>
<textarea name="embed_forum" rows="2" cols="3" class="embed_code_box"  onFocus="this.select();">[URL=<?php echo base_url(); ?>watch/<?php echo $row_watch->film_post_link; ?>] Watch "<?php echo $row_watch->film_name; ?>"[/url][URL=<?php echo base_url(); ?>watch/<?php echo $row_watch->film_post_link; ?>][IMG]<?php echo $row_watch->original_poster_url; ?>[/IMG][/URL]</textarea></td>
</tr>
</table>
<div class="share_email" id='divToShowID3'>
<h3>Email movie to Friend</h3>
<form method="post" action="<?php echo base_url(); ?>share_email">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
<tr>
<td width="40%"><div class="form_info_header">Your Name</div>
<input name="share_name" type="text" size="30" maxlength="30"></td>
<td width="40%"><div class="form_info_header">Friend's E-Mail</div>
<input name="share_email" type="text" size="30"></td>
<td width="20%" align="center" valign="bottom"><input name="share_friend" type="submit" value="Send to Friend" id='shareemail' onClick="javascript:document.getElementById('shareemail').disabled=true"><input name="share_url" type="hidden" value="<?php echo base_url(); ?>watch/<?php echo $row_watch->film_post_link; ?>"><input name="share_img" type="hidden" value="<?php echo $row_watch->website_poster_url; ?>"><input name="share_movname" type="hidden" value="<?php echo $row_watch->film_name; ?>"></td>
</tr>
</table>
</form>
</div>
</div>
<script type="text/javascript">
$('#shareemail').click(function(){
var strText1 = $('input[name="share_name"]').val();
var strText2 = $('input[name="share_email"]').val();
var strText3 = '<?php echo base_url(); ?>watch/<?php echo $row_watch->film_post_link; ?>';
var strText4 = '<?php echo $row_watch->website_poster_url; ?>';
var strText5 = '<?php echo $row_watch->film_name; ?>';
$.post('<?php echo base_url(); ?>share_email/yes/',{share_name: strText1, share_email: strText2 , share_url: strText3 , share_img: strText4 , share_movname: strText5 , ajax: 1}, function(data) {
$('#divToShowID3').html(data);
});
return false;
});
$(".slick-toggle").click(function () {
$(".movie_info_trailer").slideToggle("fast");
});
</script>
</div>
<?php }else{ ?>
<div class="movie_info">
<div class='info_message'>Movie Not Found</div>
</div> 
<?php } ?>
</div>
</div>