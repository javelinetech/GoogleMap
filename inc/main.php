<?php
	session_start();
	
	// db connection
	$hostname = "localhost";
	$user = "root";
	$password = "";
	$database = "zooom";
	$mysql_con = mysql_connect($hostname, $user, $password) or die("Opps some thing went wrong");
	mysql_select_db($database, $mysql_con) or die("Opps some thing went wrong");
		
	function is_login(){
		if(isset($_SESSION['username'])){
			return true;
		}
	}
	
	function country(){
		$countries = mysql_query("SELECT * FROM country") or die("country table:".mysql_error());
		$str = '<select name="country" id="country" class="righttip" title="Event Country" required>
				<option value="" >Select Country</option>';
		while($country = mysql_fetch_object($countries)): 
			$str .= '<option value="'.$country->iso_code.'">'.$country->country_name.'</option>';
		endwhile;
        $str .= '</select>';
		return $str;
	}
	
	function getEvents($cat = ''){
		$cond = isset($cat) ? "WHERE category='$cat'" : '';
		$cond = $cond != '' ? " AND status<>3 " : " WHERE status<>3";
		$events = mysql_query("SELECT * FROM events ") or die("events table query failed:".mysql_error());
		$rows = array();
		while ($row = mysql_fetch_assoc($events)) {
			$rows[] = $row;
		}
		return $rows;
	}
?>
