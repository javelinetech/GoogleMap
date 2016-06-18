<?php
    error_reporting(0);
    require_once ("inc/main.php");
    
    if(!is_login()){
        header("location: sign-in.php");
        die;
    }
	
	// Edit Event if event_id not blank else save
	// Status 1 = showing, 2 = hidden, 3 = deleted
    if(isset($_POST['event_id']) && $_POST['action'] == 'Show'){
        $sql = "UPDATE events SET status=1 WHERE id='".$_POST['event_id']."'";
		actOnEvent($sql);
    }elseif(!isset($_POST['event_id']) || $_POST['action'] == 'Hide'){
		$sql = "UPDATE events SET status=2 WHERE id='".$_POST['event_id']."'";
		actOnEvent($sql);
    }elseif(!isset($_POST['event_id']) || $_POST['action'] == 'delete'){
		$sql = "UPDATE events SET status=3 WHERE id='".$_POST['event_id']."'";
		actOnEvent($sql);
    }else{
		echo 'Something went wrong during saving your event!Please try again.';			
	}
    
	function actOnEvent($sql){
		$res = mysql_query($sql);
		if(mysql_error() != ''){
			echo "fail:".mysql_error();
		}else{
			echo "success";
		}
			
	}
?>
