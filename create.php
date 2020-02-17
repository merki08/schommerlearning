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
                Beruf
            </th>
            <th>
                vorausgesetztes Studium
            </th>
            <th>
                Gehalt in Euro
            </th>

        </tr>
        <tr>
            <form method="post" action="form.php">
                <td>
                    <input type="text" name="job" required><br>
                </td>
                <td>
                    Ja<input type="radio" name="studium" value="Ja" required>
                    Nein<input type="radio" name="studium" value="Nein" required><br>
                </td>
                <td>
                    <input type="text" name="salary" required><br>
                </td>
        </tr>

        <fieldset>
            <h4>Kategorien</h4>
            Wähle die Kategorien aus in die der Beruf passt.<br><br>
            <?php    
                $sql = "SELECT * FROM category ORDER BY id ASC";
                //connect to db and get data
                $result = mysqli_query($con, $sql);
                //if rows in $result > 0 loop rows in option 
                if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
?>
            <label>
                <input type="checkbox" name="category[]" value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?> 
            </label>
            <?php       
            }}
?>
        </fieldset>
        <input type="submit" name="name" value="Daten absenden" ;>
        </form>

</body>

</html>