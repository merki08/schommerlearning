<!DOCTYPE html>
<html>

<head>
    <title>Datensatz bearbeiten</title>
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
    <h4>Hier kannst du den Datensatz bearbeiten!</h4>
    
    <form method="post" action="formedit.php">  
        <fieldset>
        
        Beruf Id:
<?php        
        echo " " . $_POST['job_id'];
?>        
        <input type="hidden" name="job_id" value="<?php echo $_POST['job_id'] ?>">
  
         
<?php        
        //echo " " . $_POST['job_title'] . "<br><br>";
?>
        <h5>Beruf bearbeiten:</h5>
<?php        
            $sql = "SELECT title FROM job WHERE id = $_POST[job_id]";
            $result = mysqli_query($con, $sql);
            $jobName = mysqli_fetch_array($result)[0];
            //var_dump($jobName);
?>       
            <input type="text" name="job" value="<?php echo $jobName ?>" required>

        
        <h5>vorausgesetztes Studium:</h5>
<?php        
            $sql = "SELECT studium FROM job WHERE id = $_POST[job_id]";
            $result = mysqli_query($con, $sql);
            $jobStudium = mysqli_fetch_array($result)[0];
            $checkedNo = "";    
            $checkedYes = "";

                if($jobStudium == "N"){
                    $checkedNo = "checked";
                }
                if($jobStudium == "J"){
                    $checkedYes = "checked";
                }
                if($jobStudium == "Y"){
                    $checkedYes = "checked";
                }
                
?>
            Ja<input type="radio" name="studium" value="Ja" <?php echo $checkedYes ?> required>
            Nein<input type="radio" name="studium" value="Nein" <?php echo $checkedNo ?> required>
        

        <h5>Gehalt in Euro:</h5>
<?php        
            $sql = "SELECT salary FROM job WHERE id = $_POST[job_id]";
            $result = mysqli_query($con, $sql);
            $jobSalary = mysqli_fetch_array($result)[0];
            
?>        
            <input type="text" name="salary" value="<?php echo $jobSalary ?>" required>

        
        <h5>Kategorien</h5>

            Wähle die Kategorien aus in die der Beruf passt.<br><br>
<?php             

                $sql = "SELECT categoryId FROM job2category WHERE jobId =  $_POST[job_id]";  
                $result = mysqli_query($con, $sql);
                $x = [];
                
                while($row = $result->fetch_assoc()) {
                    $x[] = $row['categoryId'];
                }
                $sql = "SELECT category.id AS category_Id, category.title AS category_Title 
                        FROM category 
                        ORDER BY id ASC";
                //$x = mysqli_fetch_assoc($result);
                //var_dump($result);
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    
                        $checked = "";
                        foreach ($x as $value){
                            if($row['category_Id'] == $value){
                                $checked = " checked ";
                            }  
                        }                
                    ?>
                    <label>
                        <input type="checkbox" name="category[]" value="<?php echo $row['category_Id']; ?>" <?php echo $checked ?>><?php echo $row['category_Title']; ?>               
                    </label><br>
                    <?php              
                
                    }
                }
                ?>
        <br><input type="submit" name="name" value="Daten absenden" ;>
        </form>
        <br><a href='Jobs.php' style="float: right;">zurück zur Jobseite!<br></a>
        </fieldset>
</body>
</html>