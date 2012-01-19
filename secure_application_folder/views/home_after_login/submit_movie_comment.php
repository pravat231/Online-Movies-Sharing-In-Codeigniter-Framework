<h1>Post a Comment<a name="postcomment"></a></h1>
<?php echo validation_errors('<div class="error_message">','</div>'); ?>
<?php echo $this->session->flashdata('flash_msg'); ?>
<div class="comment_form">
<form method="post" action="#postcomment">
<textarea name="comment_text" cols="60" rows="6" class="comment_form_textarea"></textarea>
<div class="comment_rules">
Before you post this ...
<ul>
<li>Do you have something useful or constructive to say about the movie?</li>
<li>Did you spell everything right, and made sure your post makes sense?</li>
</ul>
If you answered YES to the above questions... you may proceed.
</div>
<input type="submit" name="submitcomment" value="Post Comment"  class="submit_form_button" />
</form>
</div>
</div>
</div>