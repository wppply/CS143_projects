<html>
<head>
<title>Search Result</title>
<link rel="stylesheet" href="./bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./index.css">
</head>
<body>


<nav class="navbar navbar-dark bg-dark ">
	<div class="container-fluid">
		<a class="navbar-brand " href="index.php">CS143</a>
		<form class="form-inline" method="GET">
			<input name = "searchbox" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			<input name = "submit" class="btn btn-outline-success my-2 my-sm-0" type="submit" >
		</form>
	</div>
</nav>

			<div class = "side-bar" >
				<div class="nav" >
					<span class = "side-title">Add New Content</span>
					<br>
					<a href="addperson.php" class = "item">Actor/Director</a>
					<br>
					<a href="addmovie.php" class = "item">Moive Info</a>
					<br>
					<a href="movieactor.php" class = "item">Movie/Actor Relation</a>

					<a href="moviedirector.php" class = "item">Movie/Director Relation</a>
					<br>
					<span class = "side-title">Browsering Content</span>
					<br>
			<a href="actorinfo.php" class = "item">Actor Info</a>
			<br>
			<a href="movieinfo.php" class = "item">Movie Info</a>
					<br>
				</div>
			</div>



			<div id = "main" class="container" style="float:right; width:70%;margin-top: 20px;">
				<?php 
				include 'useful_functions.php';


				$dbc = mysql_connect("localhost","cs143","");
				mysql_select_db("CS143",$dbc);
//Get input box

				if ($_GET["searchbox"] != ""){
					$a_raw = split(' ',str_replace("'"," ",$_GET["searchbox"] ),2);

					$a_query = 
					"SELECT first, last,dob as DateofBirth, id FROM Actor WHERE first like 
					'%"
					.$a_raw[0].
					"%' 
					AND last like '%".$a_raw[1]."%' union ".

					"SELECT first, last, dob as DateofBirth, id  FROM Actor WHERE first like 
					'%"
					.$a_raw[1].
					"%' 
					AND last like '%".$a_raw[0]."%'"; 

				}

				// if ($_GET["searchbox"] != ""){
				// 	$a_raw = split(' ',str_replace("'"," ",$_GET["searchbox"] ),10);


				// 	$a_query = "SELECT distinct first, last, id FROM Actor WHERE ";

				// 	for($i = 0; $i<count($a_raw);$i++){
				// 		$a_query .= "first like '%".$a_raw[$i]."%' or last like '%".$a_raw[$i]."%'";
						
				// 		if ($i != count($a_raw)-1){
				// 		$a_query .= "and ";
				// 		}

				// 	}

				// 	$a_query .="";


				// }


				if ($_GET["searchbox"] != ""){
					$m_raw = split(' ',str_replace("'"," ",$_GET["searchbox"] ),10);


					$m_query = "SELECT title, year,id FROM Movie WHERE title like '%";

					for($i = 0; $i<count($m_raw);$i++){
						$m_query .= $m_raw[$i]."%' ";
						
						if ($i != count($m_raw)-1){
						$m_query .= "and title like '%";
						}

					}

					$m_query .="";


				}
				

//draw table for actor
				echo "<h3> matching Actors"."</h3>";
				$a_rs = mysql_query($a_query,$dbc);
				if (!$a_rs ) {
					echo 'Could not run query: '. mysql_error();
					exit;
				}
				drawtable($a_rs,'actorinfo.php');
//draw table for movie
				echo "<h3> matching Movies</h3>";


				$m_rs = mysql_query($m_query,$dbc);
				if (!$m_rs ) {
					echo 'Could not run query: '. mysql_error();
					exit;
				}
				drawtable($m_rs,'movieinfo.php');
				mysql_close($dbc);
				?>
			</div>
	</body>
	</html>