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
    <table>
        <tr>
            <th>
                Beruf Id
            </th>
            <th>
                Beruf
            </th>
            <th>
                Beruf bearbeiten
            </th>
            <th>
                vorausgesetztes Studium
            </th>
            <th>
                Gehalt in Euro
            </th>

        </tr>
        <tr>
            <form method="post" action="formedit.php">
                <td>
<?php
                echo $_POST['job_id']; 
?>                
                <input type="hidden" name="job_id" value="<?php echo $_POST['job_id'] ?>">          
                </td>
                <td>
<?php
                echo $_POST['job_title'];              
?>
                </td>
                <td>
                    <input type="text" name="job" value="<?php echo $_POST['job_title'] ?>" required><br>
                </td>
                <td>
                    Ja<input type="radio" name="studium" value="Ja" required>
                    Nein<input type="radio" name="studium" value="Nein" required><br>
                </td>
                <td>
                    <input type="text" name="salary" value="<?php echo $_POST['job_salary'] ?>" required><br>
                </td>
        </tr>
        <input type="submit" name="name" value="Daten absenden" ;>
        </form>
        <br><a href='Jobs.php' >zurück zur Jobseite!<br></a>

</body>
</html>