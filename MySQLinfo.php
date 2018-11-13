<!doctype html>
<!--
Exercise-02_08_01
Author: Mario Sandoval
Date: 11.2.2018
MySQLinfo.php
-->
<html>
	<head>
		<title>MySQLInfo</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<script src="modernizr.custom.65897.js"></script>
	</head>
	<body>
        <h2>MySQl Database Server Information</h2>
        <?php
        $hostName = "localhost";
        $userName = "root";
        $password = "";
        $DBConnect = mysqli_connect($hostName, $userName, $password);
        if (!$DBConnect) {
            echo "<p>Connection failed.</p>\n";
        }
        else {
          echo "<p>Connection successful.</p>\n";
            mysql_close($DBConnect);
        }
        ?>
	</body>
</html>