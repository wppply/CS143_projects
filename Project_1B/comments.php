<html>
 <head>
<title>Add Actor/Director</title>
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
		 		include 'useful_functions.php';
 		$mid = $_GET['id'] ;
 		$dbc = mysql_connect("localhost","cs143","");
		mysql_select_db("CS143",$dbc);
		$name_query = "SELECT title FROM Movie where id = $mid";
		$name_rs = mysql_query($name_query,$dbc);
		if (!$name_rs ) {
	    			echo 'Could not run query: '. mysql_error();
	    			exit;
				}else{
					$movieName = mysql_fetch_row($name_rs)[0];
				}

 		?>




		<h2> Add Comments to <br>
		 <?php 
		echo change2link($movieName, $mid,'movieinfo.php');
		?>
		</h2>
 		<form method="post">
			Your Name:<br> <textarea cols="20" rows="1" name="name" ></textarea><br>
			Rating:
			<select name="rating">
  				<option value=1>1</option>
  				<option value=2>2</option>
  				<option value=3>3</option>
  				<option value=4>4</option>
 				<option value=5>5</option>
			</select><br>

			Comments:<br> <textarea cols="50" rows="5" name="comment" ></textarea><br>

			<input type="submit" name="submit">
 		</form>

 		<?php 
 		$mid = $_GET['id'] ;
 		?>

 		<?php
 			if(isset($_POST["submit"]) && isset($_POST["comment"])){

				$name = $_POST["name"];
				$rating = $_POST["rating"];
				$comment = $_POST["comment"];
				$time = time();

				$comment_query = "INSERT INTO Review(name, time, mid, rating, comment) VALUES('"."$name', $time,$mid,$rating, '$comment')";

				//echo $comment_query;

				$comment_sql = mysql_query($comment_query,$dbc);
				if (!$comment_sql) {
	    			echo 'Could not run query: '. mysql_error();
	    			exit;
				}else{
					echo "Successful add your comment to movie";
				}

				mysql_close($dbc);
			}
 		?>

 	</div>
 </body>
</html>