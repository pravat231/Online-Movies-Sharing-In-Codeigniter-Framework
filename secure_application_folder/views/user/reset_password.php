<script language="javascript" type="text/javascript">
var RecaptchaOptions = {
	theme : 'clean'
};
</script>
<div style="margin:0px 5px 0px 0px;"></div>
<div class="register_container">
<div class="heading_text"><h1>Reset Password</h1></div>
<?php echo @$error; ?>
<?php echo validation_errors('<div class="error_message">','</div>'); ?>
<p style="width:98%; margin-left:10px">You are here to reset your password so plz enter your new password.</p>
<form name="reset_pass" method="post" action="<?php echo base_url().'reset_password/'.$this->uri->segment(3); ?>">
<table width="90%" align="center" border="0" cellspacing="3" cellpadding="3">
<tr>
<td width="120" align="left" valign="top" class="edit_form_heading">New password</td>
<td><input id="password" name="password" size="60" type="password" value="" /></td>
</tr>
<tr>
<td align="left" valign="top" class="edit_form_heading">Re-enter password</td>
<td><input id="password_conf" name="password_conf" size="60" type="password" value="" /></td>
</tr>
<tr>
  <td align="left" valign="top" class="edit_form_heading"></td>
  <td>&nbsp;</td>
</tr>
<tr>
<td align="left" valign="top" class="edit_form_heading"></td>
<td><input name="reset_submit" type="submit" value="Reset My Password" class="submit_form_button"></td>
</tr>
</table>
</form>