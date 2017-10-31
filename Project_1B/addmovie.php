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
		 <h2>
		 	Add Movie
		 </h2>
		 <form method="GET">
			Title:<br> <textarea cols="50" rows="1" name="title" ></textarea><br>
			Year:<br>  <textarea cols="50" rows="1" name="year" ></textarea><br>
			Rating:<br>
			<select name="rating">
		  		<option value="G">G</option>
		 		<option value="PG">PG</option>
		 		<option value="PG-13">PG-13</option>
		 		<option value="R">R</option>
		 		<option value="NC-17">NC-17</option>
			</select><br>
			Company:<br><textarea cols="50" rows="1" name="company" ></textarea><br>
			Genre:(multiple choices)<br> 
		  		<input type="checkbox" name="a1" value="Acton">Acton</input>
		 		<input type="checkbox" name="a2" value="Adult">Adult</input>
		 		<input type="checkbox" name="a3" value="Adventure">Adventure</input>
		 		<input type="checkbox" name="a4" value="Animation">Animation</input>
		 		<input type="checkbox" name="a5" value="Comedy">Comedy</input>
		 		<input type="checkbox" name="a6" value="Crime">Crime</input><br>
		 		<input type="checkbox" name="a7" value="Documentary">Documentary</input>
		 		<input type="checkbox" name="a8" value="Drama">Drama</input>
		 		<input type="checkbox" name="a9" value="Family">Family</input>
		 		<input type="checkbox" name="a10" value="Fantasy">Fantasy</input>
		 		<input type="checkbox" name="a11" value="Horror">Horror</input>
		 		<input type="checkbox" name="a12" value="Musical">Musical</input><br>
		 		<input type="checkbox" name="a13" value="Mystery">Mystery</input>
		 		<input type="checkbox" name="a14" value="Romance">Romance</input>
		 		<input type="checkbox" name="a15" value="Sci-Fi">Sci-Fi</input>
		 		<input type="checkbox" name="a16" value="Short">Short</input>
		 		<input type="checkbox" name="a17" value="Thriller">Thriller</input>
		 		<input type="checkbox" name="a18" value="War">War</input>
		 		<input type="checkbox" name="a19" value="Western">Western</input><br>
			<input type="submit" name="submit">
		 </form>

		 <?php
		 	if(isset($_GET["submit"])){
			 	$dbc = mysql_connect("localhost","cs143","");
				mysql_select_db("CS143",$dbc);
				$type = $_GET["type"];
				$getid="SELECT * FROM MaxMovieID";
				$rs1=mysql_query($getid,$dbc);
				$row = mysql_fetch_row($rs1);
				if(empty($row[0])){
					echo "current id not reachable:".mysql_error();
					exit;
				}

				$id=$row[0]+1;

				$flag=0;
				if(empty($_GET["title"])){
					echo "Movie title should not be empty!<br>";
					$flag=1;
				}
				if(empty($_GET["year"])){
					echo "Movie year should not be empty!<br>";
					$flag=1;
				}
				#echo gettype($_GET["year"]);
				#if(gettype($_GET["year"])!="integer"){
					#echo "Year should be integer! <br>";
					#$flag=1;
				#}
				if(empty($_GET["company"])){
					echo "Company should not be empty!<br>";
					$flag=1;
				}
				if($flag){
					exit;
				}
				$title=str_replace("'","''",$_GET["title"]);
				$company=str_replace("'","''",$_GET["company"]);
				$query = "INSERT INTO Movie(id,title,year,rating,company) VALUES (".$id.",'".$title."',".$_GET["year"].",'".$_GET["rating"]."','".$company."')";
				$rs2 = mysql_query($query,$dbc);
				if (!$rs2 ) {
			    	echo 'Could not run query: '. mysql_error();
			    	exit;
				}
				else{
					echo 'Successful insertion!';
	
					$update="UPDATE MaxMovieID SET id=".$id;
					$rs4=mysql_query($update,$dbc);
					if(!$rs4){
						echo 'Could not update max id: '.mysql_error();
						exit;
					}
					for ($i=1;$i<20;$i++){
						if(!empty($_GET["a".$i])){
							$query = "INSERT INTO MovieGenre(mid, genre) VALUES(".$id.",'".$_GET["a".$i]."')";

							$rs3=mysql_query($query,$dbc);
							if(!$rs4){
								echo 'Could not insert genre: '.mysql_error();
								exit;
							}
						}
					}
				}
				mysql_close($dbc);
			}
		 ?>
	</div>
 </body>
</html>