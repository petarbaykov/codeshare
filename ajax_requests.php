<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js">
</script>
<script type="text/javascript" >
	$(function() {
	$("#submit").click(function() {
	var text = $("#text").val();
	
	var dataString = 'text='+ text;



		$.ajax({
		type: "POST",
		url: "includes/send_messages.php",
		data: dataString,
		success: function(){
			$('#msg').html(text);
			
			}
		});

		return false;
});
});
</script>
</head>
<body>
	<form method="post" id="form"  action="">
		<textarea name="text" id="text"></textarea>
		<input type="submit" name="submit" id="submit">
	</form>
	<p id="msg"></p>
</body>
</html>