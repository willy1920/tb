<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Rapot Tunas Bangsa Kubu Raya</title>
</head>
<body>
	<form action="control/login.php" method="post">
		<table>
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
				<td colspan="3"><input type="submit" value="Submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>
