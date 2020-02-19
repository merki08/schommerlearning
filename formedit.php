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

    if ($con -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

        

    //mysqli_query($con, "UPDATE job SET title = $_POST[job], studium = $_POST[studium], salary = $_POST[salary] WHERE id = $_POST[job_id]");
    if ($result = mysqli_query($con, "UPDATE job SET title = '$_POST[job]', studium = '$_POST[studium]', salary = '$_POST[salary]' WHERE id = $_POST[job_id]")){

        echo "Sie haben den Datensatz:<br><br> Beruf: " . $_POST['job'] . "<br> vorrausgesetztes Studium: " .  $_POST['studium'] . " <br> Gehalt: " . $_POST['salary'] . "€<br><br> erfolgreich bearbeitet!<br>";
        echo "<br><a href='Jobs.php' >zurück zur Jobseite!<br></a>";
    
        $categoryId = $_POST['category'];
        $maxId_sql = "SELECT MAX(id) FROM job";
        $result = mysqli_query($con, $maxId_sql);
        $row = mysqli_fetch_row($result); 
        $maxId = $row[0];
        
        if($categoryId > 0){
            mysqli_query($con, "DELETE FROM job2category WHERE jobId = $_POST[job_id]");

            foreach ($categoryId as $value){
                $result = mysqli_query($con, "INSERT INTO job2category (jobId, categoryId) VALUES ($_POST[job_id], $value)");
            }
        }
    }
?>
</body>
</html>