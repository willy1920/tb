<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ECE and Primary Report</title>
    <script type="text/javascript">
		function ajax(ajaxRequest){
			try{
				var ajaxRequest = new XMLHttpRequest;
			}
			catch(e){
				try{
					var ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
				}
				catch(e){
					try{
						var ajaxRequest = new ActiveXObject("Msxm12.XMLHTTP");
					}
					catch(e){
						alert("Your browser is not supported by ajax");
					}
				}
			}
			return ajaxRequest;
		}

		function login() {
			var email = document.getElementById("email").value;
			var pass = document.getElementById("pass").value;
			var input = "email=" + email + "&pass=" + pass;

			var ajaxRequest = ajax(ajaxRequest);
			ajaxRequest.onreadystatechange = function(){
				if (ajaxRequest.status == 200 && ajaxRequest.readyState == 4) {
		      		var response = ajaxRequest.responseText;
					if (response == 1) {
						window.location = 'parent.php';
					}
					else {
						alert(response);
					}
		    	}
			}

			ajaxRequest.open("POST", "control/login.php", true);
		  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		  ajaxRequest.send(input);
		}
	</script>
</head>
<body>
    Email : <input type="email" id="email"><br>
	Password : <input type="Password" id="pass"><br>
	<button onclick="login()">Login</button>
</body>
</html>