<html>
 <head>
	<title>Add Actor/Movie Relation</title>
	<link rel="stylesheet" href="./bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./index.css">
</head>
<body>
	<nav class="navbar navbar-dark bg-dark ">
		<div class="container-fluid">
			<a class="navbar-brand " href="search.php">CS143</a>
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
			<a href="addmovie.php" class = "item">Movie Info</a>
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
		<h2>Add Movie-Actor Relation</h2>
		 <form method="GET">
		 	Movie:<br>
			<select name="mid" style="max-width:90%;">
				<option value=''></option>
				<?php
					$db= mysql_connect("localhost","cs143","");
					mysql_select_db("CS143",$db);
					$sql="select * from Movie Order by id desc";
					$res=mysql_query($sql,$db);
					while($row=mysql_fetch_array($res)){
						echo "<option value=".$row[id].">".$row[title]."(".$row[year].")</option>";
					}
					mysql_free_result($res);
					mysql_close($db);
				?>
			</select><br>
			Actor:<br>
			<select name="aid" style="max-width:90%;">
				<option value=''></option>
				<?php
					$db= mysql_connect("localhost","cs143","");
					mysql_select_db("CS143",$db);
					$sql="select * from Actor order by id desc ";
					$res=mysql_query($sql,$db);
					while($row=mysql_fetch_array($res)){
						echo "<option value=".$row[id].">".$row[first]." ".$row[last]."(".$row[dob].")</option>";
					}
					mysql_free_result($res);
					mysql_close($db);
				?>
			</select><br>
			Role:<br> <textarea cols="50" rows="1" name="role" ></textarea><br>
			<input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0">
		 </form>

		 <?php
		 	if(isset($_GET["submit"])){
			 	$dbc = mysql_connect("localhost","cs143","");
				mysql_select_db("CS143",$dbc);
				$flag=0;
				if($_GET["mid"]==''){
					echo "Movie not selected!<br>";
					$flag=1;
				}
				if($_GET["aid"]==''){
					echo "Actor not selected!<br>";
					$flag=1;
				}
				if(empty($_GET["role"])){
					echo "Actor role should not be empty!<br>";
					$flag=1;
				}
				if($flag){
					exit;
				}
				$query = "INSERT INTO MovieActor VALUES (".$_GET["mid"].",".$_GET["aid"].",'".$_GET["role"]."')";
				$rs2 = mysql_query($query,$dbc);
				if (!$rs2 ) {
			    	echo 'Could not run query: '. mysql_error();
			    	exit;
				}
				else{
					echo 'Relation Added!';
				}
				mysql_close($dbc);
			}	
		 ?>
	</div>
 </body>
</html>