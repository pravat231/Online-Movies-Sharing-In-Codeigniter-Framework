// When DOM is ready
$(document).ready(function(){
// Launch MODAL BOX if the Login Link is clicked
$("a.login_link").click(function(e){
e.preventDefault();
$('#login_form').modal();
});
// When the form is submitted
$("#status > form").submit(function(){
// Hide 'Submit' Button
$('#submit').hide();
// Show Gif Spinning Rotator
$('#ajax_loading').show();
// 'this' refers to the current submitted form  
var str = $(this).serialize();  
// -- Start AJAX Call --
$.ajax({ 
    type: "POST",
    url: "http://www.go4film.com/do_login/yes",  // Send the login info to this page
    data: str,
    success: function(msg){  
$("#status").ajaxComplete(function(event, request, settings){  
// Show 'Submit' Button
$('#submit').show();
// Hide Gif Spinning Rotator
$('#ajax_loading').hide();  
if(msg == 'OK'){  
var login_response = '<div id="logged_in">'+'<center><img align="absmiddle" src="http://www.go4film.com/images/ajax-loader.gif"></center>' + '<div class="clearer"></div>'+ "You are successfully logged in! <br /> Please wait while you're redirected...</div>";
$('a.modalCloseImg').hide();  
$('#simplemodal-container').css("width","300px");
$('#simplemodal-container').css("height","120px");
$(this).html(login_response); // Refers to 'status'
// After 3 seconds redirect the 
setTimeout('go_to_private_page()', 3000); 
}else{  
 var login_response = msg;
 document.getElementById('login_response').style.display='';
 $('#login_response').html(login_response);
 $('#login_response').fadeOut(4000);
}      
});  
}  
});  
// -- End AJAX Call --
return false;
}); // end submit event
});
function go_to_private_page(){
window.location = ''; // Members Area
}