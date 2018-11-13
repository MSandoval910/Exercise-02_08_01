<!doctype html>

<html>
	<head>
		<title>Create Subscriber Table</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<script src="modernizr.custom.65897.js"></script>
	</head>
	<body>
        <h2>Create Subscriber Table</h2>
        <?php
        $hostName = "localhost";
        $userName = "adminer";
        $password = "vowel-speak-40";
        $DBName = "newsletter2";
        $tableName = "subscribers";
        $DBConnect = mysqli_connect($hostName, $userName, $password);
        if (!$DBConnect) {
            echo "<p>Connection failed.</p>\n";
        }
        else {
            
            if (mysqli_select_db($DBConnect, $DBName)) {
                echo "<p>Successfully selected the \"$DBName\"database.</p>\n";
                $sql = "SHOW TABLES LIKE '$tableName'";
                $result = mysqli_query($DBConnect, $sql);
                if (mysqli_num_rows($result) === 0) {
                    echo "The <strong>$tableName</strong>" . "table does not exist, creating it.<br>\n";  
                    $sql = "CREATE TABLE $tableName " . "(subscriberID SMALLINT NOT NULL " . " AUTO_INCREMENT PRIMARY KEY," . " name VARCHAR(80), email VARCHAR(100)," . " subscribeDate DATE, confirmedDate DATE)";
                    $result = mysqli_query($DBConnect, $sql);
                    if (!$result) {
                        echo "<p>Unable to create the <strong>" . " $tableName</strong> table.</p>";
                        echo "<p>Error code: " . mysqli_errno($DBConnect) . "</p>";
                    }
                    else {
                        echo "<p>Successfully created the <strong>" . "$tableName</strong> table.</p>";
                    }
                }
                else {
                 echo "The <strong>$tableName</strong>" . " table already exists.<br>\n";    

                }
            }
            else{
              echo "<p>Could not create the \"$DBName\"database: " . mysqli_error($DBConnect) . "</p>\n";
            }  
            mysqli_close($DBConnect);
        }
        ?>
	</body>
</html>