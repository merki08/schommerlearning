<?php

	$sql = "DELETE FROM Mitglieder WHERE ID = id";

	if($con->query($sql) === TRUE){
		echo "erfolgreich registriert!". "<br/>";
	}else 
		echo "nicht erfolgreich registriert!";
	
?>