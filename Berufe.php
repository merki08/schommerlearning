<!DOCTYPE html>
<html>
<head>
<title>Berufsliste</title>
	<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
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
	if($con->connect_error){
		die("no connection" . $con->connect_error);
	}

$sql = "SELECT * FROM berufe"; 
	$ergebnis = $con->query($sql);
		if($ergebnis->num_rows > 0){
			
			echo "<table><tr>Berufe<br/></tr>";
			
			while($row = $ergebnis->fetch_assoc()){
			
			
				echo $row['Kaufmann'] . "<br/>";
				echo $row['Musik'] . "<br/>";
				echo $row['Kunst'] . "<br/>";
				echo $row['Sozial'] . "<br/>";
				echo $row['Gesundheit'] . "<br/>";
				echo $row['Technik'] . "<br/>";
				
			echo "</table>";
		
		}}
		else{
			echo "Kein Ergebnis";
		}
	
		
	$con-> close();
?>

</body>
</html>