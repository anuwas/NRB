$(document).ready(function(){
	$("#login_form").submit(function(){
		var email=$("#dbuser-email").val();
		var password=$("#dbuser-password").val();
		if(email==''){
			$("#email_msg").html('Please insert email');
			$("#email_msg").show();
			$("#dbuser-email").focus();
			return false;
		}
		if(password==''){
			$("#passwprd_msg").html('Please insert email');
			$("#passwprd_msg").show();
			$("#dbuser-password").focus();
			return false;
		}
		
	})
})