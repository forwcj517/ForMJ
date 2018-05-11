$(document).ready(function() {
    $(".phonevalidation").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
function updatesessioncity(id,url)
{
	var UrlToPass = 'action=changecity&id='+id+'&url='+url;
	$.ajax({ 
	type : 'POST',
	data : UrlToPass, 
	url  : 'process/process.php',
	success: function(data){
		var data=$.trim(data);
		if(data=='1')
		{
			window.location.href=url; 
		}
		else
		{
			window.location.href='index.php';
		}
	}

	}); 
}
function leststarchat()
{
   
    var name=$("#name").val();
    var email=$("#email").val();
    var UrlToPass = 'action=leststarchat&email='+email+'&name='+name;
	
    $.ajax({ 
	type : 'POST',	
        url: "<?php echo site_url('user/get_times'); ?>",
        dataType: 'json',
        data: {name: name, email: email},
	success: function(results){
		$("#chatfrom2").show();
		$("#chatfrom1").hide();
	//	return false;
	}
    }); 
	
    //return false;
}
function SendLivechatMsg()
{
	var message=$("#status_message").val();
	if(message=='')
	{
		$("#status_message").focus();
		return false;
	}
	else
	{
		
		var UrlToPass = 'action=SendLivechatMsg&message='+message;
		$.ajax({ 
		type : 'POST',
		data : UrlToPass, 
		url  : 'process/process.php',
		success: function(data){
			$("#status_message").focus();
			$("#status_message").val('');
			$("#LiveChatdiv").html(data);
			 $('.direct-chat-messages').animate({ scrollTop: $(document).height()}, 308); 
			return false;
		}
		});
		return false;
	}
	return false;
}
function FectLivechat()
{
	$.ajax({ 
		type : 'POST',
		url  : 'process/process.php?action=FectLivechat',
		success: function(data){
			
			$("#LiveChatdiv").html(data);
			$('.direct-chat-messages').animate({ scrollTop: $(document).height()}, 308); 
			setTimeout(function() {FectLivechat();}, 5000);
		}
		});
}
function Checkregion()
{
	$("#Loginwaring").hide();
	var Regionid=$("#Regionid").val();
	if(Regionid=='')
	{
		$("#regionbtn").focus();
	}
	else
	{
		$('html,body').animate({
            scrollTop: $(".shadow-new").offset().top},
            'slow');
		$("#LoginEmail").focus();
		$("#Loginwaring").show();
	}
}
function DoSignup()
{
	
	$("#cerror").hide();
	$("#eerror").hide();
	$("#perror").hide();
	var password=$("#password").val();
	var cpassword=$("#cpassword").val();
	if($("#password").val().length <= 5)
	{
		$("#password").focus();
		$("#password").val('');
		$("#perror").show();
		return false;
	}
	if(cpassword!=password)
	{
		$("#cpassword").focus();
		$("#cpassword").val('');
		$("#cerror").show();
		return false;
	}
	else 
	{
		$("#loader").show();
		$('#btn_submit').prop("disabled", true);
		var form=$("#signupform");
		$.ajax({ 
		type : 'POST',
		data:form.serialize(),
		url  : 'process/process.php?action=DoSignup',
		success: function(data){
			$("#loader").hide();
			$('#btn_submit').prop("disabled", false);
			var data=$.trim(data);
			if(data=='1') 
			{
				window.location.href="home.php";
				return false;
			}
			else
			{
				$("#email").focus();
				$("#email").val('');
				$("#eerror").show();
				return false;
			}
			return false;
		}
		});
		return false;
	}
	return false;
}

function DoLogin()
{
	
	$("#Loginerror").hide();
	$("#loader").show();
	$('#loginbtn').prop("disabled", true);
		var form=$("#LoginForm");
		$.ajax({ 
		type : 'POST',
		data:form.serialize(),
		url  : 'process/process.php?action=DoLogin',
		success: function(data){
			$("#loader").hide();
			$('#loginbtn').prop("disabled", false);
			var data=$.trim(data);
			if(data=='1') 
			{
				window.location.href="home.php";
				return false;
			}
			else
			{
				$("#Loginerror").show();
				return false;
			}
			return false;
		}
		});
		return false;
}
function OpenForgot()
{
	$("#Forgormodal").modal('show');
	$("#fsuccess").hide();
	$("#ferror").hide();
}

function DoForgot()
{
	
	$("#fsuccess").hide();
	$("#ferror").hide();
	$("#loader").show();
	$('#ForBtn').prop("disabled", true);
		var form=$("#Forgotform");
		$.ajax({ 
		type : 'POST',
		data:form.serialize(),
		url  : 'process/process.php?action=DoForgot',
		success: function(data){
			$("#loader").hide();
			$('#ForBtn').prop("disabled", false);
			var data=$.trim(data);
			if(data=='1') 
			{
				$("#fsuccess").show();
				$("#femail").val('');
				$("#femail").focus();
				return false;
			}
			else
			{
				$("#ferror").show();
				$("#femail").val('');
				return false;
			}
			return false;
		}
		});
		return false;
}