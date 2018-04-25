<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ECE and Primary Report</title>
	<script type="text/javascript">
		<?php
			$error = $_GET['error'];
			if ($error == 1) {
				echo "alert('Username or password incorrect')";
			}
			elseif($error == ""){
				echo "";
			}
			else{
				echo "alert('Ayo mau ngapain')";
			}
		?>
	</script>
</head>
<body>
	<form action="control/login.php" method="post">
		<table>
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
				<td colspan="3"><input type="submit" value="Submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>