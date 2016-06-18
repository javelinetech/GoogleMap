<?php
    error_reporting(0);
    require_once ("inc/main.php");   
    
	$where_cond = "";
	if(trim($_GET['cat']) != ''){
		$where_cond = "WHERE category = '".$_GET['cat']."'";
	}elseif(trim($_GET['id']) != ''){
		$where_cond = "WHERE id = '".$_GET['id']."'";
	}
    $limit = $_GET['limit'] != ''? "LIMIT {$_GET['limit']} " : '';
    $where_cond .= $where_cond != '' ? " AND (status<>2 OR status<>3) " : " WHERE (status<>2 OR status<>3)";
	$sql = "SELECT * FROM events $where_cond $limit";
	$res = mysql_query($sql);
	$markers = array();
	if(mysql_error() == ''){
		while($row = mysql_fetch_array($res)){
			$latlng = array($row['lat'], $row['lng']);
			$markers []= array(
				"latLng" => $latlng, 
				"address" => $row['searchterm'], 
				"data" =>  $row['title'].'<br>'.$row['address'] .", ".$row['country'],
				"id" => 'event'.$row['id'],
			);
		}
	}
	header('Content-type: application/json');
	echo json_encode($markers);
?>