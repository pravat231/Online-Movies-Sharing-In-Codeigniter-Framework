<div class="quick_search_box">
<form method="get" action="<?php echo base_url(); ?>searching/page/1/" id="searchform">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle">
<input name="s" type="text" class="quicksearch_fields" value="Search Title"  onFocus="clearText(this)" onBlur="clearText(this)" id="s" />
<input type="submit" value="Search" class="quicksearch_button"> 
<div id="suggestions"></div>
</td>
<td align="right" valign="middle"><strong><a href="<?php echo base_url()."profile/".$this->session->userdata('user_name'); ?>"><?php echo $this->session->userdata('user_name'); ?></a></strong> - <span class="pm_indicator_read"><a href="<?php echo base_url(); ?>pm">Messages</a></span> <span class="pm_indicator_read"><a href="<?php echo base_url(); ?>friends">Friends</a></span> <a href="<?php echo base_url(); ?>logout/yes">Logout</a></td>
</tr>
</table>
</form>
</div>