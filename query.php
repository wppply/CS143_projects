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
	<textarea cols="50" rows="10" name="query" ></textarea>
	<br>
	<input type="submit" name="submit">
</form>

<?php 
	$dbc = mysql_connect("localhost","cs143","");
	
	mysql_select_db("TEST",$dbc);
	$query = $_GET["query"];
	$rs = mysql_query($query,$dbc);
	if (!$rs) {
    echo 'Could not run query: ' . mysql_error();
    exit;
	}

	echo "<table border=1 cellpadding=2>";

	//ADD title later 
	while($row = mysql_fetch_row($rs)){
		echo "<tr>";
		for ($i = 0; $i< count($row)-1;$i++){

			echo "<td>".$row[$i]."</td>";
		}

    	echo "</tr>\n";
	}
	
	echo "</tr>";

	echo "</table>";

	mysql_close($dbc);
?>




 </body>
</html>