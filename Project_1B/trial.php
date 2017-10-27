<html>
 <head>
	<title>CS143 Project 1b</title>
	<link rel="stylesheet" href="./bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./index.css">
 </head>
 <body>


 	<nav class="navbar navbar-dark bg-dark ">
 		<div class="container-fluid">
		<a class="navbar-brand " href="trial.php">CS143</a>
		<form class="form-inline" method="GET">
			<input name = "searchbox" class="form-control mr-sm-2" type="search" placeholder="Search Actors" aria-label="Search">
			<input name = "submit" class="btn btn-outline-success my-2 my-sm-0" type="submit" >

		</form>
		</div>

	</nav>







<div class = container-fluid>

	<div class="side-bar">

		<div class="tag-list">
			<span class = "side-title">Add New Content</span>
			<br>

			<a href="#" class = "item">Actor/Director</a>
			<br>
			<a href="#" class = "item">Moive Info</a>
			<br>
			<a href="#" class = "item">Movie/Actor Relation</a>
			<br>
			<a href="#" class = "item">Movie/Director Relation</a>
			<br>
			<span class = "side-title">Browsering Content</span>
			<br>
			<a href="#" class = "item">Actor Info</a>
			<br>
			<a href="#" class = "item">Moive Info</a>
			<br>
		</div>
	</div>
<div id = "main" class="container"> 




		<?php 
	$dbc = mysql_connect("localhost","cs143","");
	
	mysql_select_db("TEST",$dbc);

	// find actor

	if ($_GET["searchbox"] != ""){
		$a_raw = split(' ',$_GET["searchbox"] ,2);

		$a_query = 
		"SELECT first, last, dob FROM Actor WHERE first like 
		'%"
		.$a_raw[0].
		"%' 
		AND last like '%".$a_raw[1]."%' union ".

		"SELECT first, last, dob  FROM Actor WHERE first like 
		'%"
		.$a_raw[1].
		"%' 
		AND last like '%".$a_raw[0]."%'"; 

	}

	if ($_GET["searchbox"] != ""){
		$m_raw = split(' ',$_GET["searchbox"] ,10);

		$m_query = "SELECT title FROM Movie WHERE title like '%";

		for($i = 0; $i<count($m_raw);$i++){
			$m_query .= $m_raw[$i]."%";
		}

		$m_query .="'";

	}

	//$_GET["searchbox"];

	echo "<h3> matching Actors"."</h3>";

	$a_rs = mysql_query($a_query,$dbc);
	//show error 
	if (!$a_rs ) {
    echo 'Could not run query: '. mysql_error();
    exit;
	}



	drawtable($a_rs);
//--------------------------------
	echo "<h3> matching Movies</h3>";
	$m_rs = mysql_query($m_query,$dbc);
	//show error 
	if (!$m_rs ) {
    echo 'Could not run query: '. mysql_error();
    exit;
	}

	drawtable($m_rs);








function drawtable($a_rs){
	echo "<table border=1 cellpadding=1>";

	//ADD title

	
	echo "<tr>";
	for($i=0; $i<mysql_num_fields($a_rs);$i++){

		$title = mysql_fetch_field($a_rs,$i);

		echo "<td>".$title->name."</td>";
	}
	echo "</tr>";



	//add content
	while($row = mysql_fetch_row($a_rs)){
		echo "<tr>";
		for ($i = 0; $i< mysql_num_fields($a_rs);$i++){
			if (empty($row[$i])){
				$row[$i] = "null";
			}

			echo "<td>".htmlspecialchars($row[$i])."</td>";
		}

    	echo "</tr>\n";
	}


	echo "</table>";
	
}


mysql_close($dbc);
?>






	</div>
</div>

 </body>
</html>