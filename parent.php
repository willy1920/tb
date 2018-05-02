<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <script src="js/parent.js"></script>
    <script src="js/ajax.js"></script>
</head>
<body>
    <button onclick="dashboard()">Dashboard</button>
    <button onclick="changePasswordDashboard()">Change Password</button>
    <a href="control/logout.php">Logout</a>
    <main id="respon">
    
    </main>
</body>
</html>