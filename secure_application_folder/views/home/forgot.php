<script language="javascript" type="text/javascript">
var RecaptchaOptions = {
	theme : 'clean'
};
</script>
<div style="margin:0px 5px 0px 0px;"></div>
<div class="register_container">
<div class="heading_text"><h1>Forgot Password</h1></div>
<?php echo @$error; ?>
<p style="width:98%; margin-left:10px">It seems you have forgot your password,to activate it enter your email you used to register, and the instructions to reset your password will be sent to you!</p>
<form name="forgot_pass" method="post" action="<?php echo base_url().'forgot/yes'; ?>">
<table width="90%" align="center" border="0" cellspacing="3" cellpadding="3">
<tr>
<td width="120" align="left" valign="top" class="edit_form_heading">Email</td>
<td><input name="forgot_email" type="text" size="60" id="forgot_email" value="<?php echo $this->input->post('forgot_email'); ?>"></td>
</tr>
<tr>
<td align="left" valign="top" class="edit_form_heading">Confirm Email</td>
<td><input name="conf_email" type="text" size="60" id="conf_email" value="<?php echo $this->input->post('conf_email'); ?>" ></td>
</tr>
<!--<tr>
  <td align="left" valign="top" class="edit_form_heading">Look at this</td>
  <td><?php //echo recaptcha_get_html('6LcpXr0SAAAAAHfPSsYBD959RndnmbmOp1cSwewd'); ?></td>
</tr>-->
<tr>
  <td align="left" valign="top" class="edit_form_heading"></td>
  <td>&nbsp;</td>
</tr>
<tr>
<td align="left" valign="top" class="edit_form_heading"></td>
<td><input name="forgot_submit" type="submit" value="Get My Password" class="submit_form_button"></td>
</tr>
</table>
</form>