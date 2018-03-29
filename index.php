<!DOCTYPE html>
<html>
<head>
	<title>Rapot Tunas Bangsa Kubu Raya</title>
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
			var user = document.getElementById("user").value;
			var pass = document.getElementById("pass").value;
			var input = "user=" + user + "&pass=" + pass;

			var ajaxRequest = ajax(ajaxRequest);
			ajaxRequest.onreadystatechange = function(){
				if (ajaxRequest.status == 200 && ajaxRequest.readyState == 4) {
		      var response = ajaxRequest.responseText;
					if (response == 0) {
						window.location = 'admin.php';
					}
					else if (response == 1) {
						window.location = 'guru.php';
					}
					else if (response == 2) {
						window.location = 'user.php';
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
	Username : <input type="text" id="user"><br>
	Password : <input type="Password" id="pass"><br>
	<button onclick="login()">Login</button>
</body>
</html>
