<!DOCTYPE html>
<html>
<head>
<title>Berufsliste</title>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td { padding: 5px; }
</style>
</head>
<body>
<a href="/Jobs.php">Startseite<br></a>

<?php
	//gets the current page number if set or assigns 1 
	if (isset($_GET['pageno'])) 
		$pageno = $_GET['pageno'];
	else 
		$pageno = 1;
	
	//gets the selected category Id if set or assigns 0 
	if (isset($_GET['categoryId'])) 
		$categoryId = $_GET['categoryId'];
	else 
		$categoryId = 0;
	
	//defines the number of records per page and offset
	$no_of_records_per_page = 10;
	$offset = ($pageno-1) * $no_of_records_per_page;
	
	//db connection data
	$servername = "localhost"; 
	$user = "root";
	$pw = "";
	$db = "datenbank1";

	//open db connection 
	$con = new mysqli($servername, $user, $pw, $db);

		if($con->connect_error) 
		die("no connection" . $con->connect_error);

	//count rows from selected table where id in jobs = jobId AND id in category = categoryId in job2category 
	$total_pages_sql = "SELECT COUNT(*) FROM job, category, job2category 
						WHERE job.id = job2category.jobId
						AND job2category.categoryId = category.id";

		//if set get only jobs from given category 
		if(isset($_GET['categoryId'])) 
			$total_pages_sql .= " AND category.id = ".$_GET['categoryId']." ";

		//stores number of pages in $total_pages 	
		$result = mysqli_query($con,$total_pages_sql);
		$total_rows = mysqli_fetch_array($result)[0];
		$total_pages = ceil($total_rows / $no_of_records_per_page);

		//select job.title and category.title from selected table where id in jobs = jobId AND id in category = categoryId in job2category 
		$sql = "SELECT job.title AS jobTitle, category.title AS categoryTitle, job.id AS jobId, job.studium AS jobStudium, job.salary AS jobSalary
				FROM job, category, job2category 
				WHERE job.id = job2category.jobId AND job2category.categoryId = category.id";

		//if set filter by category
		if(isset($_GET['categoryId']))
			$sql .= " AND category.id = ".$_GET['categoryId']." ";
	
	$sql .= " ORDER BY `jobTitle` ASC  LIMIT $no_of_records_per_page OFFSET $offset"; 
	//get data from db and store it in $result
	$result = mysqli_query($con, $sql);
		//if data in $result is > 0 display it in a table 
		if (mysqli_num_rows($result) > 0){
		
		// output data of each row
		echo "<table>
				<tr>
					<th>Kategorie</th>
					<th>Beruf</th>
					<th>Job Id</th>
					<th>vorausgesetztes Studium</th>
					<th>Verdienst</th>
					<th><a href='create.php' >Neuen Datensatz erstellen<br></a></th>
				</tr>";
		while($row = mysqli_fetch_assoc($result)) {
			echo"<tr>";
			echo "<td>" . $row['categoryTitle'] . "</td>";
?>
			<form action="edit.php" method="post">
		
			<td><?php echo $row['jobTitle'] ?></td>
				<input type="hidden" name="job_title" value="<?php echo $row['jobTitle'] ?>">

			<td><?php echo $row['jobId'] ?>	</td>		
				<input type="hidden" name="job_id" value="<?php echo $row['jobId'] ?>">
			
			<td><?php echo $row['jobStudium'] ?>	</td>		
				<input type="hidden" name="job_studium" value="<?php echo $row['jobStudium'] ?>">
			
			<td><?php echo $row['jobSalary'] ?>	</td>		
				<input type="hidden" name="job_salary" value="<?php echo $row['jobSalary'] ?>">
			
			<td>  <input type="submit" value="bearbeiten">  </td>
			</form>
<?php			
			echo"</tr>";
		} } else 
		echo "Kein Ergebnis";
?>


<form method="get" action="Jobs.php">
<select name="categoryId">
<?php
	//SELECT all FROM category order by id ascending and store in $result 
	$sql = "SELECT * FROM category ORDER BY id ASC";
	//connect to db and get data
	$result = mysqli_query($con, $sql);
	//if rows in $result > 0 loop rows in option 
	if (mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_assoc($result)) {
?> 
<option value="<?php echo $row ['id']; ?>"><?php echo $row['title']; ?></option>
<?php	
	}}
?>
</select>
<input type="submit" name="submit" value="Find">
</form>


<div class="pagination">
<?php
	//if cagetory is selected link to first page of selected category or link to first page  
	//if link directs to current page dont link again
	if($categoryId > 0){
 ?>
<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?categoryId=".$categoryId."&pageno=1"; } ?>">&laquo;</a>
<?php
 	} else {
 ?>
<a href=<?php if($pageno <= 1){ echo '#'; } else {echo "?pageno=1";} ?>>&laquo;</a>
<?php 
 	}
 ?>
<?php
	//if cagetory is selected link to next page of selected category or link to next page 
	//if link directs to current page dont link again
	if($categoryId > 0){
 ?>
<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?categoryId=".$categoryId."&pageno=".($pageno - 1); } ?>"><</a>
<?php
	} else {
?>
<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><</a>
<?php 
	}
?>


<?php
	//loop creates a link for all page numbers and highlights the link to current page number
	for($i=1;$i<=$total_pages;$i++){	
?>

<?php
	//if category is selected link to page number of table filtered by selected category else link to page number of table
	if($categoryId > 0){
?>
<a href= <?php echo "?categoryId=".$categoryId."&pageno=".$i?> style="<?php if($i == $pageno)echo "font-size:20px";?>"><?php echo $i ?></a>
<?php
	}
	else{
?>
<a href="?pageno=<?php echo $i?>" style="<?php if($i == $pageno)echo "font-size:20px";?>"><?php echo $i ?></a>
<?php
	}
?>
<?php 
	}
?>


<?php
	//if category is selected link to next page of table filtered by selected category else link to next page of table
	//if link directs to current page dont link again
	if($categoryId > 0){
?>
<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?categoryId=".$categoryId."&pageno=".($pageno + 1); } ?>">></a>
<?php
	} else {
?>
<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">></a>
<?php
	}
?>

<?php
	//if category is selected link to last page of table filtered by selected category else link to last page of table
	//if link directs to current page dont link again 
	if($categoryId > 0){
?>
<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?categoryId=".$categoryId."&pageno=".($total_pages); } ?>">&raquo;</a>
<?php
	}
	else{
?>
	<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($total_pages) ;} ?>">&raquo;</a></li>
<?php 
	}
?>
</div>
</body>
</html>