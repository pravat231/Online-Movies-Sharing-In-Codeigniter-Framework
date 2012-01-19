<div class="col1">
<H2>Free Movie Newsletter</H2>
<div class="email_subscribe_box">
<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=go4film', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">Provided by Feedburner (part of Google), so you won't be spammed!<br><input type="text" style="width:180px" name="email" onFocus="clearText(this)" onBlur="clearText(this)" value="Enter Email">
<input type="hidden" value="go4film" name="uri">
<input type="hidden" name="loc" value="en_US">
<input type="submit" value="Subscribe"><a href="http://feeds.feedburner.com/go4film" rel="alternate" type="application/rss+xml" target="_blank"><img src="<?php echo base_url(); ?>images/feed-icon.png" alt="Feed Icon" width="16px" height="16px" style="vertical-align:middle;border:0"></a>
</form>
</div>
<h2>What Should I Watch?</h2>
<div class="what_watch">
<form method="post" action="<?php echo base_url(); ?>whatiwatch/yes">
<select name="what_genre" class="what_form_select">
<option value="0">Choose Genre</option>
<?php foreach($watch_category as $value){ ?>
<option value ="<?php echo $value['genre_id']; ?>"><?php echo ucwords($value['genre_name']); ?></option><?php } ?>
</select>
<input type="submit" name="what_submit" value="Suggest Movie"  class="what_form_submit">
</form>
</div>
<h2>Latest Stuff</h2>
<div class="latest_comment" id="side_advert1">
</div>
<h2>Help us</h2>
<div class="latest_comment" id="side_advert2">
</div>
<div class="other_stuff" style="height:100px">&nbsp;</div>
</div>
<div class="clearer"></div>