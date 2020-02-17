<!DOCTYPE html>
<html>
<head>
<title>Bearbeiten der Tabelle</title>
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

<?php


    $job = ($_POST["job"]);
    $studium = ($_POST["studium"]);
    $salary = ($_POST["salary"]);

if ($con -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

    

    
if ($result = mysqli_query($con, "INSERT INTO job (title, studium, salary) VALUES ('$_POST[job]', '$_POST[studium]', '$_POST[salary]')")){
    $categoryId = $_POST['category'];
        //var_dump($categoryId);
    $maxId_sql = "SELECT MAX(id) FROM job";
    $result = mysqli_query($con, $maxId_sql);
    $row = mysqli_fetch_row($result); 
    $maxId = $row[0];
    //var_dump($maxId);
        foreach ($categoryId as $value){
            $result = mysqli_query($con, "INSERT INTO job2category (jobId, categoryId) VALUES ($maxId, $value)");
        }
    echo "Sie haben den Datensatz:<br><br> Beruf: $job<br> vorrausgesetztes Studium: $studium<br> Gehalt: $salary"."€<br><br> erfolgreich eingesetzt!<br>";
    echo "<br><a href='Jobs.php' >zurück zur Jobseite!<br></a>";
}

   




?>




</body>
</html>