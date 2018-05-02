<!DOCTYPE html>
<html>
<head>
	<title>Rapot Tunas Bangsa Kubu Raya</title>
	<link rel="stylesheet" href="style/general.css">
	<script type='text/javascript'>
		<?php
			$error = $_GET['error'];
			if ($error == 1) {
				echo "alert('Username or password incorrect');";
			}
			elseif($error == ""){
				echo "";
			}
			else{
				echo "alert('Ayo mau ngapain');";
			}
		?>
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
		<form action="control/login.php" method="post">
			<table>
				<tr>
					<td colspan="3"><h1>Admin and Guru</h1></td>
				</tr>
				<tr>
					<td>Username</td>
					<td>:</td>
					<td><input type="text" name="user"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td>:</td>
					<td><input type="password" name="pass"></td>
				</tr>
				<tr>
					<td colspan="2"><div onclick="changeToExternal()">Parent Form</div></td>
					<td><input type="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
	</section>
	<section id="external">
		<form action="control/loginExternal.php" method="post">
			<table>
				<tr>
					<td colspan="3"><h1>Parent</h1></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><input type="email" name="email"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td>:</td>
					<td><input type="password" name="pass"></td>
				</tr>
				<tr>
					<td colspan="2"><div onclick="changeToInternal()">Parent Form</div></td>
					<td><input type="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
	</section>
</body>
</html>
