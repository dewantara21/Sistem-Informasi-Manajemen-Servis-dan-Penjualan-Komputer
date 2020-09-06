$(function() {
	$('#textb').click(function() {
		document.newMessage.textb.value = "";
	});
	
	$('#johnlei').click(function(){
		var username = $('#texta').val();
		var message = $('#textb').val();
		var recipient = $('#recipient').val();
		
		if (message == "" || message == "Enter your message here" || recipient == "" || recipient == "--Send Chat To--") {
			return false;
		}
		
		var dataString = 'username=' + username + '&message=' + message + '&recipient=' + recipient;
		
		$.ajax({
			type: "POST",
			url: "send_save_chat.php",
			data: dataString,
			success: function() {
				document.newMessage.textb.value = "";
			}
		});
	});
});