<?php if($user_name!=''){ ?>
<fieldset>
    <legend>Make A Post</legend>
    <div class="wall_form">
    <form method="post"><script>edToolbar('messagebox2'); </script>
    <textarea name="wall_text" cols="75" rows="6" class="textbox" id="messagebox2"></textarea><br>
    <input type="submit" name="submitwall" value="Post Message" class="submit_form_button">
    </form>
    </div>
</fieldset>
<?php }else{ ?>
<fieldset>
<legend>Post</legend>
<div class="wall_form">
<div class='info_message'>Please login to make a post</div>
</div>
</fieldset>
<?php } ?>
</div>
</div>
<script language="JavaScript" type="text/javascript" >
function smallPop(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=400, height=380,left = 450,top = 200');");
}
</script>