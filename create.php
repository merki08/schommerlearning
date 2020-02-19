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
   <form method="post" action="form.php">
    <fieldset>
    
        <h4>Beruf:</h4>
        <input type="text" name="job" required>
    
        <h4>vorausgesetztes Studium:</h4>
        Ja<input type="radio" name="studium" value="Ja" required>
        Nein<input type="radio" name="studium" value="Nein" required><br>
        
        <h4>Gehalt in Euro:</h4>
        <input type="text" name="salary" required><br>

        <h4>Kategorien</h4>
                    
        Wähle die Kategorien aus in die der Beruf passt.<br><br>
<?php    
                $sql = "SELECT * FROM category ORDER BY id ASC";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
?>                    
            <label>
                <input type="checkbox" name="category[]" value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?> 
            </label><br>
<?php       
            }}
?>
            <br><input type="submit" name="name" value="Daten absenden" ;>
            <br><a href='Jobs.php' style="float: right;">zurück zur Jobseite!<br></a>
        </fieldset>    
        </form>
           
  
</body>

</html>