<script language="javascript" type="text/javascript">
var RecaptchaOptions = {
	theme : 'clean'
};
var url1 = "<?php echo base_url(); ?>check_username/yes?ucheck=";
var url2 = "<?php echo base_url(); ?>check_email/yes?echeck=";
function checkusername() {
document.getElementById('checked1').innerHTML = "Checking...";
var name = document.getElementById("username2").value;
http.open("GET", url1 + escape(name), true);
http.onreadystatechange = handleHttpResponse1;
http.send(null);
}
function handleHttpResponse1() {
if (http.readyState == 4) {
results = http.responseText;
var name = document.getElementById("username2").value;
if(results == "") results = "<font color=\"green\"><b>"+name+"</b> Is Available!</font>";
document.getElementById('checked1').innerHTML = results;
}
}
function checkemail() {
document.getElementById('checked2').innerHTML = "Checking...";
var name = document.getElementById("email").value;
http.open("GET", url2 + escape(name), true);
http.onreadystatechange = handleHttpResponse2;
http.send(null);
}
function handleHttpResponse2() {
if (http.readyState == 4) {
results = http.responseText;
var name = document.getElementById("email").value;
if(results == "") results = "<font color=\"green\"><b>"+name+"</b> is ok!</font>";
document.getElementById('checked2').innerHTML = results;
}
}
function getHTTPObject() {
var xmlhttp;
if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
try {
xmlhttp = new XMLHttpRequest();
} catch (e) {
xmlhttp = false;
}
}
return xmlhttp;
}
var http = getHTTPObject();
</script>
<div style="margin:0px 5px 0px 0px;"></div>
<div class="register_container">
<div class="heading_text"><h1>Get an account</h1></div>
<?php echo @$error; ?>
<form name="register_form" action="<?php echo base_url().'register/yes'; ?>" method="post">
<table width="90%" border="0" cellspacing="3" cellpadding="3" align="center">
<tr>
<td width="130" align="left" valign="top" class="edit_form_heading">Username</td>
<td><input name="username" type="text" class="textbox" id="username2" onblur="checkusername();"  value="<?php echo $this->input->post('username'); ?>" size="60" maxlength="17"  /><br> <span name="checked1" id="checked1"></span></td>
</tr>
<tr>
<td width="130" align="left" valign="top" class="edit_form_heading">Email</td>
<td><input name="email" type="text" class="textbox" size="60"  value="<?php echo $this->input->post('email'); ?>" id="email" onblur="checkemail();" /><br> <span name="checked2" id="checked2"></span></td>
</tr>
<tr>
<td width="130" valign="top" class="edit_form_heading">Password</td>
<td><input name="password" type="password" class="textbox" value="" size="60" /></td>
</tr>
<tr>
<td width="130" valign="top" class="edit_form_heading">Password Again</td>
<td><input name="password2" type="password" class="textbox"  value="" size="60" />&nbsp;</td>
</tr>
<tr>
<td width="130" valign="top" class="edit_form_heading">Gender </td>
<td><input name="gender" type="radio" class="textbox" value="Male" <?php if($this->input->post('gender')=='Male'){ ?>checked="checked"<?php } ?> />
Male&nbsp;&nbsp;<input name="gender" type="radio" class="textbox" value="Female" <?php if($this->input->post('gender')=='Female'){ ?>checked="checked"<?php } ?> />Female</td>
</tr>
<tr>
<td width="130" valign="top" class="edit_form_heading">Birthday</td>
<td><select name="birth_day_sel"><option value="">Day</option><?php for($i=1; $i<=31; $i++){ $k=(strlen($i)>1)?"":"0"; ?>
<option value="<?php echo $k.$i; ?>" <?php if($i==$this->input->post('birth_day_sel')){ ?>selected="selected"<?php } ?>><?php echo $i; ?></option><?php } ?></select>
<select name="birth_month_sel">
<option value="">Month</option>
<option value="01" <?php if($this->input->post('birth_month_sel')=="01"){ ?>selected="selected"<?php } ?>>January</option>
<option value="02" <?php if($this->input->post('birth_month_sel')=="02"){ ?>selected="selected"<?php } ?>>February</option>
<option value="03" <?php if($this->input->post('birth_month_sel')=="03"){ ?>selected="selected"<?php } ?>>March</option>
<option value="04" <?php if($this->input->post('birth_month_sel')=="04"){ ?>selected="selected"<?php } ?>>April</option>
<option value="05" <?php if($this->input->post('birth_month_sel')=="05"){ ?>selected="selected"<?php } ?>>May</option>
<option value="06" <?php if($this->input->post('birth_month_sel')=="06"){ ?>selected="selected"<?php } ?>>June</option>
<option value="07" <?php if($this->input->post('birth_month_sel')=="07"){ ?>selected="selected"<?php } ?>>July</option>
<option value="08" <?php if($this->input->post('birth_month_sel')=="08"){ ?>selected="selected"<?php } ?>>August</option>
<option value="09" <?php if($this->input->post('birth_month_sel')=="09"){ ?>selected="selected"<?php } ?>>September</option>
<option value="10" <?php if($this->input->post('birth_month_sel')==10){ ?>selected="selected"<?php } ?>>October</option>
<option value="11" <?php if($this->input->post('birth_month_sel')==11){ ?>selected="selected"<?php } ?>>November</option>
<option value="12" <?php if($this->input->post('birth_month_sel')==12){ ?>selected="selected"<?php } ?>>December</option>
</select> 
<select name="birth_year_sel"><option value="">Year</option><?php for($j=1900; $j<=2012; $j++){ ?><option value="<?php echo $j; ?>" <?php if($j==$this->input->post('birth_year_sel')){ ?>selected="selected"<?php } ?>><?php echo $j; ?></option><?php } ?></select></td>
</tr>
<tr>
<td width="130" valign="top" class="edit_form_heading">Heard about us from</td>
<td><input type="text" name="heard_about" value="<?php echo $this->input->post('heard_about'); ?>" size="60"></td>
</tr>
<!--<tr>
<td width="130" valign="top" class="edit_form_heading">Look at this</td>
<td><?php //echo recaptcha_get_html('6LcpXr0SAAAAAHfPSsYBD959RndnmbmOp1cSwewd'); ?></td>
</tr>-->
<tr>
  <td valign="top" class="edit_form_heading">Agree to terms</td>
  <td><input type="checkbox" name="agree_1" value="1"><span style="color:#666; font-size:">This is my first account (you will be instantly banned if you create more)</span></td>
</tr>
<tr>
  <td valign="top" class="edit_form_heading">&nbsp;</td>
  <td><input type="checkbox" name="agree_3" value="1">
       <span style="color:#666;">I have read the legal terms, and I agree to them.</span></td>
</tr>
<tr>
<td width="130" valign="top" class="edit_form_heading">&nbsp;</td>
<td><input name="submit" type="submit" class="submit_form_button" value="Register" /></td>
</tr>
</table>
</form>