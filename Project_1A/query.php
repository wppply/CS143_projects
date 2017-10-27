<html>
 <head>
  <title>Project 1A Web Interface</title>
  <style type="text/css">
  	body{
  		text-align: center;
  	}
  	span{
  		font-family:monospace ;
  	}
  	table{
  		margin: auto;
  	}
  </style>
 </head>
 <body>
 <h1>
 	Project 1A Web Interface	
 </h1>
 <p1>
 	Type an SQL query in the following box:<br>
 	Example: <span>SELECT * FROM Actor WHERE id=10;</span>

 	<br>
 </p1>
<form method="GET">
	<textarea cols="100" rows="10" name="query" ></textarea>
	<br>
	<input type="submit" name="submit">
</form>

<?php 
	$dbc = mysql_connect("localhost","cs143","");
	
	mysql_select_db("TEST",$dbc);
	$query = $_GET["query"];
	$rs = mysql_query($query,$dbc);
	// $titleQuery = "select * from INFORMATION_SCHEMA.COLUMNS";
	// $title = mysql_query($titleQuery,$dbc);

	//show error 
	if (!$rs ) {
    echo 'Could not run query: '. mysql_error();
    exit;
	}

	echo "<h3> matching Actors".strval(strlen(1))."</h3>";
	echo "<table border=1 cellpadding=1>";

	//ADD title

	
	echo "<tr>";
	for($i=0; $i<mysql_num_fields($rs);$i++){

		$title = mysql_fetch_field($rs,$i);

		echo "<td>".$title->name."</td>";
	}
	echo "</tr>";



	//add content
	while($row = mysql_fetch_row($rs)){
		echo "<tr>";
		for ($i = 0; $i< mysql_num_fields($rs);$i++){
			if (empty($row[$i])){
				$row[$i] = "null";
			}

			echo "<td>".htmlspecialchars($row[$i])."</td>";
		}

    	echo "</tr>\n";
	}



	echo "</table>";

	mysql_close($dbc);
?>




 </body>
</html>