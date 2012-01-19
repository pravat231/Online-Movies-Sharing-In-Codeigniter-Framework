<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="google-site-verification" content="N3lmRlGFzVghh-yPmRVhJv3q9Eon951HClA9r1Hp6lY">
<meta name="y_key" content="8b1fa6e2cf211354">
<meta name="msvalidate.01" content="EAFF2B9B0A3BE62CB2125299136F11D1">
<title><?php echo $site_title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="alternate" type="application/rss+xml" title="Latest Movies RSS Feed" href="<?php echo base_url(); ?>rss.xml">
<meta name="robots" content="ALL,INDEX,FOLLOW">
<meta name="revisit-after" content="1 days">
<meta name="keywords" content="movies,online movies,online watch movies,movies online watch,watch free movie online,watch hindi movies,watch english movies,watch telugu movies,free movies online,hindi,hollywood movie,telugu,tamil,malayalam,punjabi,dubbed movies,english movie,kid,children movie,animation movie,drama,action,horror,adventure,war,fantasy,sci-fi,thriller,comedy,romance,english,watch online movies,free online movies watch,watch movie link,link movie,movies link,movie link,free link movies,movies watch links">
<meta name="description" content="Online Watch Movies, Movies Online Watch, Online Movie, Watch Movie Online, Free Movies Online, Hindi, Hollywood Movie, Telugu, Tamil, Malayalam, Punjabi, Dubbed Movies, English Movie, kid, Children Movie, Animation Movie, Drama, Action, Horror, Adventure, War, Fantasy, Sci-Fi, Thriller, Comedy, Romance, English, Watch Online Movies, Free Online Movies Watch, Watch Movie Link, Link Movie, Movies Link, Movie Link, Free Link Movies, Movies watch Links">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/go4film_style.css" type="text/css">
<link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon"> 
<script type="text/javascript">
function clearText(field){
    if (field.defaultValue == field.value) field.value = '';
}
function getCookie(c_name){
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	{
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if(x==c_name)
		{
			return unescape(y);
		}
	}
}
function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}
function checkCookie(){
	var tutorial_view=getCookie("tutorial_view");
	if(tutorial_view!=null && tutorial_view!="")
	{
		switch(tutorial_view){
			case '1':
				var data='<div style="left: 10px; top: 5px; overflow: visible; width: 400px" id="panel1" class="yui-panel"><div class="ptr-t">&nbsp;</div><div style="font-weight: normal; line-height: 2; color: black; cursor: move;" class="hd">Click here to get the movie results in either Details view (i.e 24 movies with images per page) Or List view (i.e 100 movies without images per page).</div><span class="container-close" onClick="change_cookie(2)">Next</span></div>';
				update_div(data,'index_show_by');
			break;
			case '2':
				var data='<div style="left: -160px; top: 5px; overflow: visible; width: 400px" id="panel2" class="yui-panel"><div class="ptr-t">&nbsp;</div><div style="font-weight: normal; line-height: 2; color: black; cursor: move;" class="hd">Click here to get the movie results in sorted list i.e in Latest, Posting Date, Release date, Albhatical and Featured. You can also use these sorting for year,country and genre search also. Use Details view or List view to get the proper result with less time.</div><span class="container-close" onClick="change_cookie(3)">Next</span></div>';
				update_div(data,'index_show_by');
			break;
			case '3':
				var data='<div style="left: 100px; top: 20px; overflow: visible; width: 400px" id="panel3" class="yui-panel"><div class="ptr-t">&nbsp;</div><div style="font-weight: normal; line-height: 2; color: black; cursor: move;" class="hd">Click these letters to get the movies whose starting letter is similar to the clicked letter. You can also use List/Details view or Sorting to get proper result with less time.</div><span class="container-close" onClick="change_cookie(4)">Next</span></div>';
				update_div(data,'atoz');
			break;
			case '4':
				var data='<div style="left: 340px; top: 20px; overflow: visible; width: 400px" id="panel4" class="yui-panel"><div class="ptr-t">&nbsp;</div><div style="font-weight: normal; line-height: 2; color: black; cursor: move;" class="hd">Click here to search the movie of different genre and also you can use the sorting to get the result with 100% accuracy.</div><span class="container-close" onClick="change_cookie(5)">Finish</span></div>';
				update_div(data,'atoz');
			break;
		}
	}
	else
	{
		setCookie("tutorial_view",'1',365);
		checkCookie();
	}
}
function change_cookie(data){
	var del_sy=parseInt(data)-1;
	document.getElementById('panel'+del_sy).style.display='none';
	setCookie("tutorial_view",data,365);
	checkCookie();
}
function update_div(data,div){
	var inner_content=document.getElementById(div).innerHTML;
	document.getElementById(div).innerHTML=inner_content+data;
}
</script>
</head>
<body onLoad="checkCookie()">
<div class="container">
<div class="header"><div class="header_image"><h1><a href="<?php echo base_url(); ?>" title="Online Watch Movies Free On Go4film.com">Online Watch Movies Free</a></h1></div>
<div class="nav_tabs">
<form action="http://www.google.com/translate" target="_blank"><table width="320" align="right"><tr><td>&nbsp;</td><td width="40"><script type="text/javascript">document.write ("<input name=u value="+location.href+" type=hidden>");</script><noscript><input name="u" value="<?php echo 'http://www.go4film.com'.$_SERVER['REQUEST_URI']; ?>" type="hidden"></noscript><input name="hl" value="en" type="hidden"><input name="ie" value="UTF8" type="hidden"><input name="langpair" value="" type="hidden"><input name="langpair" value="en|fr" title="Fran&#231;ais/French" src="http://photos1.blogger.com/img/43/1633/320/13539949_e76af75976.jpg" onclick="this.form.langpair.value=this.value" type="image"></td><td width="40"><input name="langpair" value="en|de" title="Deutsch/German" src="http://photos1.blogger.com/img/43/1633/320/13539933_041ca1eda2.jpg" onclick="this.form.langpair.value=this.value" type="image"></td><td width="40"><input name="langpair" value="en|it" title="Italiano/Italian" src="http://photos1.blogger.com/img/43/1633/320/13539953_0384ccecf9.jpg" onclick="this.form.langpair.value=this.value" type="image"></td>   <td width="40"><input name="langpair" value="en|pt" title="Portugu&#234;s/Portuguese" src="http://photos1.blogger.com/img/43/1633/320/13539966_0d09b410b5.jpg" onclick="this.form.langpair.value=this.value" type="image"> </td>   <td width="40"><input name="langpair" value="en|es" title="Espa&#241;ol/Spanish" src="http://photos1.blogger.com/img/43/1633/320/13539946_2fabed0dbf.jpg" onclick="this.form.langpair.value=this.value" type="image"></td><td width="40"><input name="langpair" value="en|ja" title="&#26085;&#26412;&#35486;/Japanese" src="http://photos1.blogger.com/img/43/1633/320/13539955_925e6683c8.jpg" onclick="this.form.langpair.value=this.value" type="image"> </td>   <td width="40"><input name="langpair" value="en|ko" title="&#54620;&#44397;&#50612;/Korean" src="http://photos1.blogger.com/img/43/1633/320/13539958_3c3b482c95.jpg" onclick="this.form.langpair.value=this.value" type="image"></td><td width="40"><input name="langpair" value="en|zh-CN" title="&#20013;&#25991;&#65288;&#31616;&#20307;&#65289;/Chinese Simplified" src="http://photos1.blogger.com/img/43/1633/320/14324441_5ca5ce3423.jpg" onclick="this.form.langpair.value=this.value" type="image"> </td></tr></table></form>
</div>
<div class="clearer"></div>
</div>
<div class="main_body">