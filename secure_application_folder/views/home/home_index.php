<style type="text/css">
.yui-panel {
	display: block;
    background-color: #FFFFFF;
    border-collapse: separate;
    font: 1em Arial;
    position: relative;
    z-index: 1000;
}
.ptr-t {
    background: url("http://www.mybloglog.com/buzz/images/tooltip_ptr.jpg") no-repeat scroll 50% 0 transparent;
    height: 12px;
    left: 260px;
    position: absolute;
    top: -9px;
    width: 18px;
    z-index: 1;
}
.hd {
    background: none repeat scroll 0 0 #FFFFD6;
	font-size: 13px;
	border-color: #757573 #757573 #757573 #757573;
    border-style: solid;
    border-width: 1px;
	display: block;
	height:150px;
	padding:0px 10px;
	position:absolute;
	text-align:justify;
}
.container-close {
    cursor: pointer;
	font-size:15px;
	color:#000;
	font-weight:normal;
    margin: 0;
    padding: 0;
    position: absolute;
    right: 8px;
    top: 125px;
    visibility: inherit;
    width: 35px;
    z-index: 6;
}
.container-close:hover {
	text-decoration:underline;
}
</style>
<div style="margin:0px 5px 0px 0px;"></div>
<div class="index_container">
<div class="index_stage_navigation">
<?php echo $stage_nav; ?>
</div>
<div class="index_show_by2" id="index_show_by">
<table width="340" border="0" cellpadding="1" cellspacing="1">
<tr>
<td>
<table width="170" border="0" cellpadding="1" cellspacing="1">
<tr>
<td width="50"><?php if($sort_url!=''){ ?>Sort By:<?php } ?></td>
<td width="120">
<div class="menu">
<ul>
<?php echo $sort_url; ?>
</ul>
</div>
</td>
</tr>
</table>
</td>
<td>
<table width="170" border="0" cellpadding="1" cellspacing="1">
<tr>
<td width="50"><?php if($sort_url!=''){ ?>View By:<?php } ?></td>
<td width="120">
<div class="menu">
<ul>
<li><a href="#">Details</a>
<ul>
<li><a href="#"> - List</a></li>				
</ul>
</li>
</ul>
</div>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
<div class="clearer" style="height:20px">&nbsp;</div>
<ul class="result">
<?php
if(count($latest_post)>0){
foreach($latest_post as $row){ 
?>
<li><div class="results_content"><a class="archive-permalink" href="<?php echo base_url(); ?>watch/<?php echo $row['film_post_link']; ?>" title="Watch <?php echo $row['film_name']; ?>"><?php echo $row['film_name']." ".$row['YEAR']." Movie Watch Online"; ?></a></div></li>
<?php } ?>
</ul>
<div class=clearer></div>
<div class=clearer></div>
<?php echo $this->pagination->create_links(); }else{ ?>
<div class='info_message'>Sorry but I couldn't find anything like that.</div>
<div class=clearer></div>
<div class=clearer></div>
<?php } ?>
</div>
</div>