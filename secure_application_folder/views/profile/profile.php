<script type="text/javascript" src="<?php echo base_url(); ?>js/ed.js"></script>
<div style="margin:0px 5px 0px 0px;"></div>
<div class="index_container">
<div class="col2">
<div class="regular_page profile_page">
	<h1><a href="<?php echo base_url().'profile/'.$row_profile->username; ?>"><?php echo $row_profile->username; ?></a></h1>
	<div class="profile_left_col">
	<table width="100%" border="0" cellspacing="2" cellpadding="2">
		<tr><td colspan="2" align="center" valign="top"><div class="profile_avatar"><img src="<?php echo base_url(); ?>user_thumb/<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'].'/user_thumb/'.$row_profile->avatar.'.jpg'))?$row_profile->avatar:"noavatar"; ?>.jpg" width="75px" height="100px" /></div></td></tr>
	</table>
	</div>
	<div class="profile_right_col" style="min-height:320px">
	<table width="100%" border="0" cellspacing="3" cellpadding="0">
		<tr>
			<td width="80" align="left" valign="top" class="profile_info_header">From:</td>
		   	<td align="left" valign="top"><?php echo (!empty($row_profile->country_name))?$row_profile->country_name:"Earth"; ?></td>
			<?php echo $right_col; ?>        
		</tr>
		<tr>
		   <td width="80" align="left" valign="top" class="profile_info_header">Gender:</td>
		   <td align="left" valign="top"><?php echo $row_profile->gender; ?></td>
		</tr>
		<tr>
		   <td width="80"  align="left" valign="top" class="profile_info_header">Joined:</td>
		   <td align="left" valign="top"><?php echo date_when($row_profile->registration_date); ?></td>
		</tr>
		<tr>
		  <td  align="left" valign="top" class="profile_info_header">DOB:</td>
		  <td align="left" valign="top"><?php echo $row_profile->birth_day; ?></td>
	    </tr>
		<tr>
		  <td  align="left" valign="top" class="profile_info_header">Last Access:</td>
		  <td align="left" valign="top"><?php echo date_when($row_profile->lastlogin); ?></td>
	    </tr>
		<tr>
		   <td width="80"  align="left" valign="top" class="profile_info_header">Profile Views:</td>
		   <td align="left" valign="top"><?php echo $row_profile->profileviews; ?></td>
		</tr>
	</table>
    <table width="100%" border="0" cellpadding="3" cellspacing="0">
	    <tr>
		   <td width="80" align="left" valign="top" class="profile_info_header">About Me:</td>
		   <td valign="top"><p><?php echo (!empty($row_profile->about_me))?nl2br($row_profile->about_me):"Not Entered"; ?></p></td>
		</tr>
		<tr>
		   <td align="left" valign="top" class="profile_info_header">Hobbies:</td>
		   <td valign="top"><p><?php echo (!empty($row_profile->hobbies))?nl2br($row_profile->hobbies):"Not Entered"; ?></p></td>
		</tr>
	</table>
	</div>
	<div class="clearer"></div>