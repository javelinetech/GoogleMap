<?php
	error_reporting(0);
    require_once ("inc/main.php");
	
	// Get Events as per passed query string
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
		while($row = mysql_fetch_object($res)){			
			$markers []= $row;
		}
	}
	header('Content-type: application/json');
	echo json_encode($markers);
?>