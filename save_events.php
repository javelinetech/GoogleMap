<?php
    error_reporting(0);
    require_once ("inc/main.php");
    
    if(!is_login()){
        header("location: sign-in.php");
        die;
    }
	
	// Edit Event if event_id not blank else save
    if(isset($_POST['event_id']) && $_POST['event_id'] != ''){
        saveEvent($_POST, 'edit');
    }elseif(!isset($_POST['event_id']) || $_POST['event_id'] == ''){
		saveEvent($_POST, 'save');
    }else{
		echo 'Something went wrong during saving your event!Please try again.';			
	}
    
	function saveEvent($data, $action){
		$title = $data['title'];
		$address = $data['address'];
		$description = $data['description'];
		$zipcode = $data['zipcode'];
		$country = $data['country'];
		$startdate = date("Y-m-d", strtotime($data['startdate']));
		$enddate = date("Y-m-d", strtotime($data['enddate']));
		$category = $data['category'];	
		$lng = $data['lng'];	
		$lat = $data['lat'];
		$searchterm = $data['searchterm'];
		$event_id = $data['event_id'];
		$rank = getNextRank();
		if($action =='edit'){
			$sql = "UPDATE events 
			           SET title = '".$title."',
			               address = '".$address."',
			               description = '".$description."',
			               zipcode = '".$zipcode."',
			               country = '".$country."',
			               startdate = '".$startdate."',
			               enddate = '".$enddate."',
			               category = '".$category."',
			               lng = '".$lng."',
			               lat = '".$lat."',
			               searchterm = '".$searchterm."'
			         WHERE id='".$event_id."' ";
			$res = mysql_query($sql);
			$event = $event_id;
		}else{
			$sql = "INSERT INTO events 
			           SET title = '".$title."',
			               address = '".$address."',
			               description = '".$description."',
			               zipcode = '".$zipcode."',
			               country = '".$country."',
			               startdate = '".$startdate."',
			               enddate = '".$enddate."',
			               category = '".$category."',
			               lng = '".$lng."',
			               lat = '".$lat."',
			               searchterm = '".$searchterm."',
			               rank = '".$rank."'
			         ";
			$res = mysql_query($sql);
			$event = mysql_insert_id();
		}
		if(mysql_error() != ''){
			echo "fail:".mysql_error();
		}else{
			echo "success:$event";
		}
			
	}
	
	function getNextRank(){
		$sql = "SELECT max( rank ) as rank FROM events ";
		$res = mysql_fetch_row(mysql_query($sql));
		return $res[0] + 1;
	}
?>
