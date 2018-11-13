<!doctype html>
<!--
    Exercise-02_08_01
    Author: Mario Sandoval
    Date: 11.05.2018
    IntPositions.php
-->
<html>

<head>
    <title>Interview Positions</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
<h1>Interview Positions</h1>
<?php
    function connectToDB($hostname, $username, $password) {
        $DBConnect = mysqli_connect($hostname, $username, $password);
        if (!$DBConnect) {
            echo "<p>Connection error: " .mysqli_connect_error() . "</p>\n";
        }
        return $DBConnect;
    }
    function selectDB($DBConnect, $DBName) {
        $success = mysqli_select_db($DBConnect, $DBName);
        if ($success) {
            //echo "<p>Successfully selected the \"$DBName\"database.</p>\n";
        }
        else {
            //echo "<p>Could not select the \"$DBName\" database: " .
              //  mysqli_error($DBConnect) . ", creating it.</p>\n";
          //  $sql = "CREATE DATABASE $DBName";
            if (mysqli_query($DBConnect, $sql)) {
             //   echo "<p>Succcessfully created the \"$DBName\" database.</p>\n";
               // $success = mysqli_select_db($DBConnect, $DBName);
                if ($success) {
               //     echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
                }
            }
            else {
               // echo "<p>Could not create the \"$DBName\"database: " . 
                 //   mysqli_error($DBConnect) . "</p>\n";
            }
        }
        return $success;
    }
    function createTable($DBConnect, $tablename) {
        $success = false;
        $sql = "SHOW TABLES LIKE '$tablename'";
        $result = mysqli_query($DBConnect, $sql);
        if (mysqli_num_rows($result) === 0) {
            echo "The <strong>$tablename</strong> table does not exist, creating table.<br>\n";
            $sql = "CREATE TABLE $tablename (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, interviewerName VARCHAR(40), interviewerPosition VARCHAR(40), candidateName VARCHAR(50), communicationAbilities VARCHAR(40), professionalAppearance VARCHAR(40), computerskills VARCHAR(40), BusinessKnowledge VARCHAR(40), )";
            $result = mysqli_query($DBConnect, $sql);
            if ($result === false) {
                $success = false;
                echo "<p>Unable to create the $tablename table.</p>";
                echo "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
            }
            else {
                $success = true;
                echo "<p>Successfully created the $tablename table.</p>";
            }
        }
        else {
            $success = true;
              //  echo "the $tablename table already exists.<br>\n";
        }
        return $success;
    }
        $hostname = "localhost";
        $username = "adminer";
        $password = "vowel-speak-40";
        $DBName = "guestbook";
        $tablename = "guest";
        $interviewerName = "";
        $interviewerPosition = "";
        $candidateName = "";
        $commAblities = "";
        $proAppearance = "";
        $comSkills = "";
        $businessKnow = "";
        $intComm = "";
        $formErrorCount = 0;
    if (isset($_POST['submit'])){
        $interviewerName = stripslashes($_POST['interviewerName']);
        $interviewerName = trim($interviewerName);
        $interviewerPosition = stripslashes($_POST['interviewerPosition']);
        $interviewerPosition = trim($interviewerPosition);
        $candidateName = stripslashes($_POST['candidateName']);
        $candidateName = trim($candidateName);
        $commAblities = stripslashes($_POST['communicationAbilities']);
        $commAblities = trim($commAblities);
        $proAppearance = stripslashes($_POST['professionalAppearance']);
        $proAppearance = trim($proAppearance);
        $comSkills = stripslashes($_POST['professionalAppearance']);
        $comSkills = trim($comSkills);
        $businessKnow = stripslashes($_POST['businessKnowledge']);
        $businessKnow = trim($businessKnow);
        //$intComm = stripslashes($_POST['inteviewercomments']);
        //$intComm = trim($intComm);
        if (empty($interviewerName) === 0 || empty($interviewerPosition)) {
            echo "<p>You must enter your name and your <strong>position</strong>.</p>\n";
            ++$formErrorCount;
        }
        if ($formErrorCount === 0) {
            $DBConnect = connectToDB($hostname, $username, $password);
            if ($DBConnect) {
                if (selectDB($DBConnect, $DBName)){
                    if(createTable($DBConnect, $tablename)){
                echo "<p>Connection successful!</p>\n";
                        $sql = "INSERT INTO $tablename
                        VALUES(NULL, '$interviewerName', 
                        '$interviewerPosition', '$candidateName', '$commAblities', '$proAppearance', '$comSkills', '$businessKnow')";
                        $result = mysqli_query($DBConnect, $sql);
                        if ($result === false) {
                            echo "<p>Unable to execute the query.</p>";
                            echo "<p>Error code " . 
                                mysqli_errno($DBConnect) . ": " .
                                mysqli_error($DBConnect) . "</p>";
                        }
                        else {
                            echo "<h3>Thank you for signing our guest book!</h3>";
                            $interviewerName = "";
                            $interviewerPosition = "";
                            $candidateName = "";
                            $commAblities = "";
                            $proAppearance = "";
                            $comSkills = "";
                            $businessKnow = "";
                            $intComm = "";
                        }
                    }
                }
                mysqli_close($DBConnect);
            }
        }
    }
    ?>
    <form action="IntPositions.php" method="post">
        <p><strong>Interviewer Name: </strong><br>
            <input type="text" name="interviewerName" value="<?php echo $interviewerName; ?>"></p>
            <p><strong>InterviewerPosition: </strong><br>
                <input type="text" name="interviewerPosition" value="<?php echo $interviewerPosition; ?>"></p>
                
            <p><strong>Candidate's Name: </strong><br>
               <input type="text" name="candidateName" value="<?php echo $candidateName; ?>"></p>
               <p><strong>Communication Abilities: </strong><br>
               <input type="text" name="communicationAbilities" value="<?php echo $commAblities; ?>"></p>
               
                <p><strong>Professional Appearance: </strong><br>
               <input type="text" name="professionalAppearance" value="<?php echo $proAppearance; ?>"></p>
               
               <p><strong>Computer Skills: </strong><br>
               <input type="text" name="computerskills" value="<?php echo $comSkills; ?>"></p>
               
               <p><strong>Business Knowledge: </strong><br>
               <input type="text" name="businessKnowledge" value="<?php echo $businessKnow; ?>"></p>
               
               <p><strong>Interviewer Comments: </strong><br>
                  <textarea type="text" rows="6" cols="50" name"inteviewercomments" value="<?php echo $intComm; ?>"></textarea>
               
                <p><input type="submit" name="submit" value="Submit">
        </p>
    </form>
    <?php 
    $DBConnect = connectToDB($hostname, $username, $password);
    if ($DBConnect) {
        if (selectDB($DBConnect, $DBName)) {
            if (createTable($DBConnect, $tablename)) {
                echo "<p>Connection successful!</p>\n";
                echo "<h2>Candidates Names</h2>";
                $sql = "SELECT * FROM $tablename";
                $result = mysqli_query($DBConnect, $sql);
                if (mysqli_num_rows($result) == 0) {
                    echo "<p>There are no entries in the quest book!</p>";
                }
                else {
                    echo "<table width='100%' border='1'>";
                    echo "<tr>";
                    echo "<th>Visitor</th>";
                    echo "<th>Interviewer Name</th>";
                    echo "<th>Interviewer Position</th>";
                    echo "<th>Candidates Name</th>";
                    echo "<th>Communication Abilities</th>";
                    echo "<th>Professional Appearance</th>";
                    echo "<th>Computer Skills</th>";
                    echo "<th>Business Knowledge</th>";
                 //   echo "<th>Interviewer Comments</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_row($result)) {
                        echo "<tr>";
                        echo "<td width='10%' style='text-align: center'>$row[0]</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td>$row[2]</td>";
                        echo "<td>$row[3]</td>";
                        echo "<td>$row[4]</td>";
                        echo "<td>$row[5]</td>";
                        echo "<td>$row[6]</td>";
                        echo "<td>$row[7]</td>";
                      //  echo "<td>$row[8]</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    mysqli_free_result($result);
                }
            }
        }
        mysqli_close($DBConnect);
    }
    ?>
</body>

</html>