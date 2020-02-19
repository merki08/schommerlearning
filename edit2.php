<!DOCTYPE html>
<html>

<head>
    <title>Neuen Datensatz erstellen</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php
$servername = "localhost"; 
	$user = "root";
	$pw = "";
	$db = "datenbank1";
    $con = new mysqli($servername, $user, $pw, $db);
    if($con->connect_error) 
    die("no connection" . $con->connect_error);
?>
    <form method="post" action="formedit.php">  
        Beruf Id<br>
<?php        
        echo $_POST['job_id'];"<br><br>"
?>        
        <input type="hidden" name="job_id" value="<?php echo $_POST['job_id'] ?>">
  
        Beruf<br>
<?php        
        echo $_POST['job_title'];"<br><br>"
?>
        Beruf bearbeiten<br>
        
        <input type="text" name="job" value="<?php echo $_POST['job_title'] ?>" required><br><br>

        vorausgesetztes Studium<br>
        Ja<input type="radio" name="studium" value="Ja" required>
        Nein<input type="radio" name="studium" value="Nein" required><br><br>
        
        Gehalt in Euro<br>
        <input type="text" name="salary" value="<?php echo $_POST['job_salary'] ?>" required><br>

        <input type="submit" name="name" value="Daten absenden" ;>
        </form>
        <br><a href='Jobs.php' >zurück zur Jobseite!<br></a>

</body>
</html>