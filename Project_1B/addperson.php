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
		<h2> Add Actor/Director </h2>
 		<form method="GET">
 			Type:<br>
			<select name="type">
  				<option value="Actor">Actor</option>
 				<option value="Director">Director</option>
			</select><br>
			First Name:<br> <textarea cols="50" rows="1" name="first" ></textarea><br>
			Last Name:<br>  <textarea cols="50" rows="1" name="last" ></textarea><br>
			Gender:<br>
			<select name="sex">
  				<option value="Male">Male</option>
 				<option value="Female">Female</option>
			</select><br>
			Date of Birth:<br><textarea cols="50" rows="1" name="dob" ></textarea><br>
			eg:19940508<br>
			Date of Death:<br> <textarea cols="50" rows="1" name="dod" ></textarea><br>
			eg:leave blank for alive ones<br>
			<input type="submit" name="submit">
 		</form>

 		<?php
 			if(isset($_GET["submit"])){
	 			$dbc = mysql_connect("localhost","cs143","");
				mysql_select_db("CS143",$dbc);
				$type = $_GET["type"];
				$getid="SELECT * FROM MaxPersonID";
				$rs1=mysql_query($getid,$dbc);
				$row = mysql_fetch_row($rs1);
				if(empty($row[0])){
					echo "current id not reachable:".mysql_error();
					exit;
				}


				$id=$row[0]+1;
				$flag=0;
				if(empty($_GET["first"])){
					echo "First Name should not be empty!<br>";
					$flag=1;
				}
				if(empty($_GET["last"])){
					echo "Last Name should not be empty!<br>";
					$flag=1;
				}
				if(empty($_GET["dob"])){
					echo "Date of Birth should not be empty!<br>";
					$flag=1;
				}
				if($flag){
					exit;
				}

				$first=str_replace("'","''",$_GET["first"]);
				$last=str_replace("'","''",$_GET["last"]);
				if($_GET["type"]=="Actor"){
					if(!empty($_GET['dod'])){
						$query = "INSERT INTO Actor(id,last,first,sex,dob,dod) VALUES (".$id.",'".$last."','".$first."','".$_GET["sex"]."','".$_GET["dob"]."','".$_GET["dod"]."')";
					}
					else{
						$query = "INSERT INTO Actor(id,last,first,sex,dob,dod) VALUES (".$id.",'".$last."','".$first."','".$_GET["sex"]."','".$_GET["dob"]."',\N)";
					}
				}
				else{
					if(!empty($_GET['dod'])){
						$query = "INSERT INTO Director(id,last,first,dob,dod) VALUES (".$id.",'".$last."','".$first."','".$_GET["dob"]."','".$_GET["dod"]."')";
					}
					else{
						$query = "INSERT INTO Director(id,last,first,dob,dod) VALUES (".$id.",'".$last."','".$first."','".$_GET["dob"]."',\N)";
					}

				}
				$rs2 = mysql_query($query,$dbc);
				if (!$rs2 ) {
	    			echo 'Could not run query: '. mysql_error();
	    			exit;
				}
				else{
					echo 'Successful insertion!';

					$update="UPDATE MaxPersonID SET id=".$id;
					$rs3=mysql_query($update,$dbc);
					if(!$rs3){
						echo 'Could not update max id: '.mysql_error();
						exit;
					}
				}
				mysql_close($dbc);
			}
 		?>

 	</div>
 </body>
</html>