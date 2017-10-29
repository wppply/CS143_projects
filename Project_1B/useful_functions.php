<?php
function drawtable($a_rs,$url){
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
			$id = $row[mysql_num_fields($a_rs)-1];
			$name = htmlspecialchars($row[$i]);
			echo "<td>".change2link($name,$id,$url)."</td>";
		}
		echo "</tr>\n";
	}

	echo "</table>";

}

function change2link($name, $id,$url){
	$link = '<a href="' . "$url?id=$id" . '">'.$name.'</a>';
	return $link;

}

function tablewithoutlink($rs){
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
}

?>