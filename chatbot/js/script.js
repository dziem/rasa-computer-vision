function generateID(){
	if(Cookies.get('rasa_logged_id') === undefined){
		return Math.floor(new Date().valueOf() * Math.random());
	}else{
		return Cookies.get('rasa_logged_id');
	}
}
function showMessage(rors, type, text){
	if(type == 'message'){
		var newElm = "<div class='message "+rors+"'><p>"+
		text+
		"</p></div>";
	}else if(type == 'image'){
		var newElm = "<div class='image "+rors+"'>"+
		"<img src='chatbot/img/"+text+"'>"+
		"</div>";
	}
	$('#cb .container').append(newElm);
	$("html, body").animate({ scrollTop: $(document).height() }, 1000);
}
function requestServer(sender,message){
	mint = false;
	$.ajax({
		url: "http://localhost:5002/webhooks/rest/webhook",
		type: "POST",
		data: JSON.stringify({
			"sender": sender,
			"message": message
		}),
		headers: {
			"accept": "application/json",
			"Access-Control-Allow-Origin":"*"
		},
		contentType: "application/json",
		dataType: 'json',
		processData: false,
		success : function(msg) {
			for(var i = 0;i < msg.length;i++){
				if( msg[i].text !== undefined ) {
					showMessage('receive', 'message', msg[i].text);
				}else if( msg[i].attachment !== undefined ) {
					showMessage('receive', 'image', msg[i].attachment);
				}	
			}
		},
		fail : function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
		}
	});
}
function sendMessage(sender){
	var message = $('#message-box').val();
	$('#message-box').val('');
	if(message != ''){
		showMessage('sender', 'message', message)
		requestServer(sender,message);
	}
}
var mint;
$(document).ready(function (e) {
	var senderID = generateID();
	if(Cookies.get('rasa_logged_id') === undefined){
		$('#login').show();
		mint = true;
	}else{
		$('#logout').show();
		mint = false;
	}
	$(document).mouseup(function (e)
	{
		var container = $("#login-form");
		if (!container.is(e.target) &&
			container.has(e.target).length === 0)
		{
			$('#loader').hide();
		}
	});
	$('#image-upload').change(function () {
		var file_data = $(this).prop('files')[0];
		var form_data = new FormData();
		form_data.append('file', file_data);
		$.ajax({
			url: 'http://localhost/upload-image/index12.php',
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function (response) {
				console.log(response)
				showMessage('sender', 'image', response);
				setTimeout(function() {
					showMessage('receive', 'message', "Oke, tunggu sebentar, gambar sedang diproses");
                    requestServer(senderID,response);
                }, 1000);
			},
			error: function (response) {
				console.log(response);
			}
		});
	});
	$('#submit-message').click(function(){
		sendMessage(senderID);
	});
	$('#message-box').on('keypress', function (e) {
        if(e.which === 13){
            $(this).attr("disabled", "disabled");
			sendMessage(senderID);
			$(this).removeAttr("disabled");
        }
	});
	$('#login').click(function(){
		$('#login-form').show();
		$('#loader').show();
	});
	$('#close-button').click(function(){$('#loader').hide();});
	$('#submit').click(function(e){
		$('#login-form').hide();
		e.preventDefault();
		$.ajax({
			url: "http://localhost/login-api/login.php",
			type: "POST",
			data: JSON.stringify({
				"username": $('input[name="username"]').val(),
				"password": $('input[name="password"]').val(),
				"sender_id": senderID,
				"mint": mint
			}),
			contentType: "application/json",
			dataType: 'json',
			processData: false,
			success : function(msg) {
				if(msg['status'] != 'fail'){
					Cookies.set('rasa_logged_id', msg['content']);
					senderID = msg['content'];
					$('#login').hide();
					$('#logout').show();
					$('#loader').hide();
				}else{
					alert(msg['content']);
					$('#login-form').show();
				}
			},
			fail : function(jqXHR, textStatus) {
				alert( "Request failed: " + textStatus );
			}
		});
	});
	$('#logout').click(function(){
		Cookies.remove('rasa_logged_id');
		alert('done')
		$('#login').show();
		$('#logout').hide();
	});
});