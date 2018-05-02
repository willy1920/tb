<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Rapot Tunas Bangsa Kubu Raya</title>
	<link rel="stylesheet" href="style/general.css">
	<script src="js/ajax.js"></script>
	<script type='text/javascript'>
		function loginInternal() {
			var user = document.getElementById('user').value;
			var pass = document.getElementById('internalPass').value;
			var input = "user=" + user + "&pass=" + pass;

			var ajaxRequest = ajax(ajaxRequest);
			ajaxRequest.onreadystatechange = function () {
				if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
					var respon = ajaxRequest.responseText;
					if (respon == 0) {
						window.location = "admin.php";
					}
					else if (respon == 1) {
						window.location = "guru.php";
					}
					else {
						alert(respon);
					}
				}
			}

			ajaxRequest.open("POST", "control/login.php", true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajaxRequest.send(input);
		}
		function loginExternal() {
			var email = document.getElementById('email').value;
			var pass = document.getElementById('externalPass').value;
			var input = "email=" + email + "&pass=" + pass;

			var ajaxRequest = ajax(ajaxRequest);
			ajaxRequest.onreadystatechange = function () {
				if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
					var respon = ajaxRequest.responseText;
					if (respon == 1) {
						window.location = "parent.php";
					}
					else {
						alert(respon);
					}
				}
			}

			ajaxRequest.open("POST", "control/loginExternal.php", true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajaxRequest.send(input);
		}
		function changeToInternal() {
			document.getElementById('internal').style.display = 'block';
			document.getElementById('external').style.display = 'none';
		}

		function changeToExternal() {
			document.getElementById('internal').style.display = 'none';
			document.getElementById('external').style.display = 'block';
		}

	</script>
</head>

<body>
	<section id="internal">
		<table>
			<tr>
				<td colspan="3">
					<h1>Admin and Guru</h1>
				</td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>
					<input type="text" name="user" id="user">
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="password" name="pass" id="internalPass">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div onclick="changeToExternal()">Parent Form</div>
				</td>
				<td>
					<input type="submit" value="Submit" onclick="loginInternal()">
				</td>
			</tr>
		</table>
	</section>
	<section id="external">
		<table>
			<tr>
				<td colspan="3">
					<h1>Parent</h1>
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td>
					<input type="email" name="email" id="email">
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="password" name="pass" id="externalPass">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div onclick="changeToInternal()">Parent Form</div>
				</td>
				<td>
					<input type="submit" value="Submit" onclick="loginExternal()">
				</td>
			</tr>
		</table>
	</section>
</body>

</html>