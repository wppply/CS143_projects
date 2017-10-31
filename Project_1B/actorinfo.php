<!DOCTYPE html>
<html>
<head>
	<title>Actor Info</title>
	<link rel="stylesheet" href="./bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./index.css">
</head>
<body>
	<nav class="navbar navbar-dark bg-dark ">
		<div class="container-fluid">
			<a class="navbar-brand " href="index.php">CS143</a>
			<form class="form-inline" method="GET" action ="search.php">
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
		include( 'useful_functions.php');
		$id = $_GET['id'] ? $_GET['id'] : '-1';
		$dbc = mysql_connect("localhost","cs143","");
		mysql_select_db("CS143",$dbc);


		$actor_query  = 'SELECT distinct CONCAT(first, " ",last) as name, dob as DateofBirth, dod as DateofDeath,id
		FROM Actor
		WHERE id = '. $id;

		$actor_rs = mysql_query($actor_query,$dbc);
				if (!$actor_rs ) {
					echo 'Could not run query: '. mysql_error();
					exit;
				}
		echo '<h4> Actor info</h4>';

		tablewithoutlink($actor_rs,'actorinfo.php');

//cast
		$cast_query = 'SELECT distinct Movie.title as MovieTitle, MovieActor.role as Role,  MovieActor.mid as MID
		FROM Actor JOIN MovieActor ON MovieActor.aid = Actor.id,Movie

		WHERE Movie.id = MovieActor.mid and MovieActor.aid = '. $id;

		$cast_rs = mysql_query($cast_query,$dbc);
		
		drawtable($cast_rs,'movieinfo.php');

		if (!$cast_rs ) {
					echo 'Could not run query: '. mysql_error();
					exit;
				}




		mysql_close($dbc);

		?>

	</div>




</body>
</html>