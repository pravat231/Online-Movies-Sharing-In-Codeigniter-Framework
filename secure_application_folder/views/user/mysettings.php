<div style="margin:0px 5px 0px 0px;"></div>
<div class="regular_page"><div class="heading_text"><h2>Settings and Profile Management</h2></div>
<?php echo $this->session->flashdata('msg_set'); ?>
<?php echo @$error; ?>
<div class="settings_container">
<form name="my_settings" method="post" action="<?php echo base_url().'mysettings/yes'; ?>" enctype="multipart/form-data">
<a name="profile"></a>
<fieldset>
<legend>Edit Profile</legend>
<div class="heading_text_under_left">Edit your basic profile.</div>
<span class="form_info_header">Username</span><br />
<strong><?php echo $user_data->username; ?></strong> <br>
<br>
<span class="form_info_header">Date of Birth</span><br />
<strong><?php echo $user_data->birth_day; ?></strong> <br>
<br>
<span class="form_info_header">Gender</span><br />
<strong><?php echo $user_data->gender; ?></strong><br>
<br>
<span class="form_info_header">Country</span><br>
<select name="country">
<option value="">Select Country</option>
<?php foreach($country as $row_country){ ?>
<option value="<?php echo $row_country['country_code'];?>" <?php if($user_data->country==$row_country['country_code']){echo 'selected="selected"'; } ?>><?php echo $row_country['country_name'];?></option>
<?php } ?>
</select>
<br>
<br>
<span class="form_info_header">About Me</span><br>
<textarea name="aboutme" cols="75" rows="5"><?php echo $user_data->about_me; ?></textarea>
<br>
<br>
<span class="form_info_header">Hobbies</span><br>
<textarea name="hobbies" cols="75" rows="5"><?php echo $user_data->hobbies; ?></textarea>
<br>
<br>
<input name="mysettings" type="submit" class="submit_form_button" value="Update Profile">
</fieldset>
<a name="privacy"></a>
<fieldset>
<legend>Privacy Setting</legend>
<div class="heading_text_under_left">Customize your account.</div>
<span class="form_info_header">Get email notification when i get a new private message?</span><br>
<input name="pmnotify" type="radio" value="yes" <?php if($user_data->pm_notify_mail=='yes')echo 'checked="checked"'; ?> />Yes
<input name="pmnotify" type="radio" value="no" <?php if($user_data->pm_notify_mail=='no')echo 'checked="checked"'; ?> />No
<br>
<br>
<span class="form_info_header">Who can view my content?</span><br>
<input name="who_can_view" type="radio" value="every" <?php if($user_data->view_content_to=='every')echo 'checked="checked"'; ?> />Everyone
<input name="who_can_view" type="radio" value="register" <?php if($user_data->view_content_to=='register')echo 'checked="checked"'; ?> />Only My Friends
<br>
<br>
<span class="form_info_header">Show who visits my profile?</span><br>
<input name="recentvisit" type="radio" value="yes" <?php if($user_data->view_recent_visit=='yes')echo 'checked="checked"'; ?> />Yes
<input name="recentvisit" type="radio" value="no" <?php if($user_data->view_recent_visit=='no')echo 'checked="checked"'; ?> />No
<br>
<br>
<span class="form_info_header">Allow me to tag on photos?</span><br>
<input name="tagging" type="radio" value="yes" <?php if($user_data->photo_tagging=='yes')echo 'checked="checked"'; ?> />Enable photo tagging
<input name="tagging" type="radio" value="no" <?php if($user_data->photo_tagging=='no')echo 'checked="checked"'; ?> />Disable photo tagging
<br>
<br>

<input name="mysettings" type="submit" class="submit_form_button" value="Update Privacy">
</fieldset>
<fieldset>
<legend>Avatar</legend>
<div class="heading_text_under_left">Change your avatar here</div>
<span class="form_info_header">Current Avatar</span><br />
<img src="<?php echo base_url(); ?>user_thumb/<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'].'/user_thumb/'.$user_data->avatar.'.jpg'))?$user_data->avatar:"noavatar"; ?>.jpg" width="75px" height="100px" />
<br>
<br>
<span class="form_info_header">Upload a new one</span><br />
<input type="file" name="user_avatar" class="textbox" size="40" />
<input type="hidden" name="oldavatar" value="<?php echo $user_data->avatar; ?>" />
<br>
<br>
<input type="submit" name="mysettings" class="submit_form_button" value="Update Avatar">
</fieldset>
<a name="email"></a>
<fieldset>
<legend>Email</legend>
<div class="heading_text_under_left"> If you wish to change your email, you can do that here </div>
<span class="form_info_header">Email Address</span><br />
<input name="opt_email" id="opt_email" type="text" class="textbox"size="25" value="<?php echo $user_data->email; ?>"/>
<input name="hidden_opt_email" id="hidden_opt_email" type="hidden" value="<?php echo $user_data->email; ?>" />
<br>
<br>
<input type="submit" name="mysettings" class="submit_form_button" value="Update Email">
</fieldset>
<a name="pass"></a>
<fieldset>
<legend>password</legend>
<div class="heading_text_under_left"> If you wish to change your password, you can do that here </div>
<span class="form_info_header">Current Password (leave blank if you dont want to change it)</span><br />
<input name="opt_oldpass" type="password" class="textbox"size="25" />
<br>
<br>
<span class="form_info_header">New Password (leave blank if you dont want to change it)</span><br />
<input name="opt_password" type="password" class="textbox"size="25" />
<br>
<br>
<span class="form_info_header">New Password Again</span><br />
<input name="opt_password2" type="password" class="textbox"  size="25" />
<br>
<br>
<input type="submit" name="mysettings" class="submit_form_button" value="Update Password">
</fieldset>
<a name="referal"></a>
<fieldset>
<legend>Referrals</legend>
<div class="heading_text_under_left">Creating accounts yourself will result in you losing your point collecting privileges.</div>
<span class="form_info_header">Your referral URL is:</span><br />
<span style="color:#0099FF; font-size:15px; font-weight:bold">http://www.go4film.com?ref=45115</span>
<br>
<br>
</fieldset>
</form>
</div>