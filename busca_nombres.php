<?php
    $name_cat="";
	$result = mysqli_query($mysqli, "SELECT * FROM category WHERE id=$category");
	while($res = mysqli_fetch_array($result)){
		$name_cat = $res['name'];
	}	

    $name_tag="";
	$result1 = mysqli_query($mysqli, "SELECT * FROM tag WHERE id=$tags");
	while($res1 = mysqli_fetch_array($result1)){
		$name_tag = $res1['name'];
	}	

	$nom_status="";
	$result2 = mysqli_query($mysqli, "SELECT * FROM status WHERE id=$status");
	while($res2 = mysqli_fetch_array($result2)){
		$nom_status = $res2['name'];
	}	


?>