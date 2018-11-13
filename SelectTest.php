<!doctype html>
<!--
Exercise-02_08_01
Author: Mario Sandoval
Date: 11.2.2018
SelectTest.php
-->
<html>
	<head>
		<title>Select Test</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<script src="modernizr.custom.65897.js"></script>
	</head>
	<body>
        <h2>Select Test</h2>
        <?php
        $hostName = "localhost";
        $userName = "adminer";
        $password = "vowel-speak-40";
        $DBName = "newsletter2";
        $DBConnect = mysqli_connect($hostName, $userName, $password);
        if (!$DBConnect) {
            echo "<p>Connection failed.</p>\n";
        }
        else {
            
            if (mysqli_select_db($DBConnect, $DBName)) {
                echo "<p>Successfully selected the \"$DBName\"database.</p>\n";
            }
            else{
              echo "<p>Could not create the \"$DBName\"database: " . mysqli_error($DBConnect) . "</p>\n";
            }  
            mysqli_close($DBConnect);
        }
        ?>
	</body>
</html>