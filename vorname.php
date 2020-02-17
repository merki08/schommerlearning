<html>
<head>
<title>Formular Vorname Nachname</title>
</head>
<body>
<?php
	$servername = "localhost";
	$user = "root";
	$pw = "";
	$db = "datenbank1";
	$vorname = $_POST["vorname"];
	$nachname = $_POST["nachname"];
	$con = new mysqli($servername, $user, $pw, $db);

	
	if($con->connect_error){
		die("no connection" .$con->connect_error);
		}
	$sql = "INSERT INTO tabelle1 (vorname, nachname) VALUES ('$vorname', '$nachname')";
	if($con->query($sql) === TRUE){
		echo "erfolgreich";
	}	
	else{
		echo "nicht angemeldet";
	}
	$con-> close();
?>
</body>
</html>
