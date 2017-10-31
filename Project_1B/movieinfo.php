<!DOCTYPE html>
<html>
<head>
	<title>Movie Info</title>
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


//Add review
		// echo '<form action="comments.php?id='.$id.'">
		// 	<button type="submit" class="btn btn-primary" >
		// 		Add Comment
		// 	</button>
		// 	</form>';

		echo '<h2>'.change2link('Add Comment', $id,'comments.php').'</h2>';



//movie
		$movie_query = 'SELECT distinct title, year, rating, company, id
		FROM Movie
		 WHERE id ='.$id;
		$movie_rs = mysql_query($movie_query,$dbc);

		echo '<h4> moive info</h4>';

		tablewithoutlink($movie_rs,'movieinfo.php');


//Director
		$D_query = 'SELECT distinct Concat(Director.first, " " ,Director.last) as name , Director.id
		FROM Director JOIN MovieDirector ON MovieDirector.did = Director.id

		WHERE MovieDirector.mid = '. $id;

		$D_rs = mysql_query($D_query,$dbc);
		echo '<h4> Director info</h4>';
		tablewithoutlink($D_rs);

		if (!$D_rs ) {
					echo 'Could not run query: '. mysql_error();
					exit;
				}


//genre 
		$G_query = 'SELECT  genre
		FROM MovieGenre
		WHERE mid = '. $id;

		$G_rs = mysql_query($G_query,$dbc);
		echo '<h4> Genre</h4>';

		if (!$G_rs ) {
					echo 'Could not run query: '. mysql_error();
					exit;
				}
		tablewithoutlink($G_rs);

//cast
		$cast_query = 'SELECT distinct MovieActor.role as Role, Concat(Actor.first, " " ,Actor.last) as name , Actor.id
		FROM Actor JOIN MovieActor ON MovieActor.aid = Actor.id

		WHERE MovieActor.mid = '. $id;

		$cast_rs = mysql_query($cast_query,$dbc);
		echo '<h4> cast info</h4>';
		drawtable($cast_rs,'actorinfo.php');

		if (!$cast_rs ) {
					echo 'Could not run query: '. mysql_error();
					exit;
				}



//avg
		$avg_query = 'SELECT AVG(rating)
		FROM Review
		WHERE mid = '.$id;
		$avg_rs = mysql_query($avg_query,$dbc);
		echo '<h4> Rating:</h4>';
		tablewithoutlink($avg_rs);


//comments
		$comments_query = 'SELECT name, rating,comment
		FROM Review
		WHERE mid ='.$id;
		$comments_rs = mysql_query($comments_query,$dbc);

					if (!$comments_rs ) {
					echo 'Could not run query: '. mysql_error();
					exit;
			}

		echo '<h4> Review</h4>';
		tablewithoutlink($comments_rs);


		mysql_close($dbc);

		?>

	</div>




</body>
</html>