<?php
    require_once ("inc/main.php");   
    if(!is_login()){
        header("location: sign-in.php");
        die;
    }	
	
?>
<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US"><!--<![endif]-->
<head>
	<title>Site Admin | Zooom Productions</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Seo Meta -->
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/icons.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/animate.css" media="screen" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="js/rs-plugin/css/settings.css" media="screen" /><!-- Revolution Slider -->
	<link rel="stylesheet" type="text/css" href="styles/responsive.css" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'>
	

	<!-- Favicon -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/ico">
	

	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script>
	<![endif]-->
</head>
<body>
	<div id="frame_">
	<div id="layout" class="full shop_page">
		<?php include_once("header.php") ?>
		
		<div class="page-content">
			<div class="row mbs clearfix">
				<div class="grid_12" id="action-box" id="sortable">
				    <?php 
					$events = getEvents();
					if(count($events) > 0){
						foreach($events as $event){
					?>
					<div class="action clearfix" id="event<?php echo $event['id']?>">
						<div class="inner">
							<a class="tbutton flr small" href="javascript:;" onclick="showHideDel(<?php echo $event['id']?>, 'delete');"><span>Delete</span></a>
							<?php $button = $event['status'] == 1? "Hide": "Show";?>														
							<a class="tbutton flr small" href="javascript:;" onclick="showHideDel(<?php echo $event['id']?>, '<?php echo $button?>');" id="btn<?php echo $event['id']?>"><span><?php echo $button?></span></a>							
							<a class="tbutton flr small" href="#manageevent" onclick="populateEvenet(<?php echo $event['id']?>);" id="link"><span>Edit</span></a>							
							<div class="matn">
								<p><strong><?php echo $event['title'] .' / '.$event['country']?></strong> <?php echo $event['lat'] .' - '. $event['lng']?></p>								
							</div>
						</div>
					</div>
					<?php }
					}else{
						echo "<span id='noevents'><strong>No events available currently!</strong></span>";
					} ?>
				</div>
			</div><!-- row --><a name="manageevent"/>
			<div class="row mbs clearfix">
				<div class="grid_3">&nbsp;</div>
				<div class="grid_6">
					
				    <div id="add-edit" style="display:none;">
					<h3 class="col-title" id="col-title"> Add Event </h3><span class="liner mbt"></span>
					
					<form method="post" id="register_form_official" action="#" onsubmit="return saveEvent();">
						<div class="clearfix">
							<input type="hidden" name="event_id" id="event_id" value="">
							<input type="text" name="title" id="title" placeholder="Title" class="righttip" title="Event Title" required><br/>
							<textarea name="description" id="description" placeholder="Description *" class="requiredField" rows="2" required></textarea><br>
							<input type="text" name="address" id="address" placeholder="Address" class="righttip" title="Event address" required>
							<input type="text" name="zipcode" id="zipcode" placeholder="Zipcode" class="righttip" title="Event zipcode" required><br>
							<?php echo country(); ?><br>
							<input type="date" name="startdate" id="startdate" placeholder="Startdate" class="righttip" min="<?php echo date("d/m/Y");?>" title="Event startdate" required>
							<input type="date" name="enddate" id="enddate" placeholder="Enddate" class="righttip" min="<?php echo date("d/m/Y");?>" title="Event enddate" required><br>
							<select name="category" id="category" class="righttip" title="Category" required>								
								<option value="CAT1">CAT1</option>
								<option value="CAT2">CAT2</option>
							</select>
							<input type="text" name="searchterm" id="searchTextField" placeholder="Address search" class="righttip" title="Address search" required>
							<input type="hidden" id="cityLat" name="lat">
							<input type="hidden" id="cityLng" name="lng">
							
						</div>
						<input type="submit" id="register_button" value="Save">
						<input type="button" id="register_button" value="Cancel" class="cancelbtn">
					</form>
					</div>
					<a href="#manageevent" class="tbutton medium" id="addevent"><span>Add New Event<i class="mii icon-angle-right"></i></span></a>
				</div>
				<div class="grid_3">&nbsp;</div>
			</div><!-- row -->
		</div><!-- end page content -->
        <br/><br/><br/><br/>
        <br/><br/><br/>
		<?php include_once("footer.php") ?>

	</div><!-- end layout -->
	</div><!-- end frame -->

<div id="toTop"><i class="icon-angle-up"></i></div><!-- Back to top -->
<!-- Scripts -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/theme20.js"></script>
	<script type="text/javascript" src="js/rs-plugin/pluginsources/jquery.themepunch.plugins.min.js"></script>	
	<script type="text/javascript" src="js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="js/jquery.knob.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
	<script type="text/javascript" src="js/gmap3.js"></script>
	<script type="text/javascript" src="js/twitter/jquery.tweet.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	<script type="text/javascript">
		function initialize() {
			var input = document.getElementById('searchTextField');
			var autocomplete = new google.maps.places.Autocomplete(input);
			google.maps.event.addListener(autocomplete, 'place_changed', function () {
				var place = autocomplete.getPlace();				
				document.getElementById('cityLat').value = place.geometry.location.lat();
				document.getElementById('cityLng').value = place.geometry.location.lng();
			});
		}
		google.maps.event.addDomListener(window, 'load', initialize); 
		$(document).ready(function(e) {
			$('#addevent').click(function(){
				$('#col-title').html('Add Event');
				$('#add-edit').show();
				$('#register_form_official')[0].reset();
				$(this).hide();
			});
			$('.cancelbtn').click(function(){
				$('#add-edit').hide();
				$('#addevent').show();
			});
			$("#link").click(function() {
			   scrollToAnchor('manageevent');
			});
			$(function() {
				$( "#sortable" ).sortable();
				$( "#sortable" ).disableSelection();
			});
		});
		
		function saveEvent(){
			// Save events into database
            var title = $('#title').val();		
            var country = $('#country').val();	
			var citylng = $('#cityLng').val();
            var citylat = $('#cityLat').val();	
            var postData = $('#register_form_official').serialize();
			//alert(postData);
			
			$.ajax({
				url:'save_events.php',
				type:'POST',
				data: postData,
				success:function(result){
					var res = result.split(":");
					var event_id = $('#event_id').val();
					if(res[0] != 'success'){
						alert('Something went wrong during saving event!');
					}else{
						if(event_id == ''){
							var html = '<div class="action clearfix" id="event'+res[1]+'"><div class="inner"><a class="tbutton flr small" href="#"><span>Delete</span></a><a class="tbutton flr small" href="#"><span>Hide</span></a><a class="tbutton flr small" href="#manageevent" onclick="populateEvenet('+ res[1] +');" id="link"><span>Edit</span></a><div class="matn"><p><strong>'+ title +' / '+ country +'</strong> '+ citylng + ' - '+ citylat +'</p></div></div></div>';
							$("#action-box").append(html).show('slow');
							$('#noevents').hide();
							$('#register_form_official')[0].reset();
							$('#add-edit').hide();
							$('#addevent').show();
						}else if(event_id != ''){
							var html = '<div class="inner"><a class="tbutton flr small" href="#"><span>Delete</span></a><a class="tbutton flr small" href="#"><span>Hide</span></a><a class="tbutton flr small" href="#manageevent" onclick="populateEvenet('+ event_id +');" id="link"><span>Edit</span></a><div class="matn"><p><strong>'+ title +' / '+ country +'</strong> '+ citylng + ' - '+ citylat +'</p></div></div>';
							$("#event"+event_id).html(html).focus();
							$('#noevents').hide();
							$('#register_form_official')[0].reset();
							$('#add-edit').hide();
							$('#addevent').show();
							$(window).scrollTop($("#event"+event_id).offset().top);
							//alert("You have successfully edited a record!");
						}
					}
					
				}
			});
			return false;
		}
		
		function populateEvenet(eventid){
			$.getJSON( "events.php?id="+eventid, function( data ) {
			  
			  $('#col-title').html('Edit Event');
			  $('#add-edit').show();
			  $('#addevent').hide();
			  $.each(data, function(index, element) {			  
				$('#title').val(element.title);
				$('#country').val(element.country);	
				$('#description').val(element.description);	
				$('#cityLng').val(element.lng);
				$('#cityLat').val(element.lat);
				$('#category').val(element.category);
				$('#event_id').val(element.id);
				$('#zipcode').val(element.zipcode);
				$('#address').val(element.address);
				$('#startdate').val(element.startdate);
				$('#enddate').val(element.enddate);
				$('#searchTextField').val(element.searchterm);
			  });
			});
		}
		function scrollToAnchor(aid){
			var aTag = $("a[name='"+ aid +"']");
			$('html,body').animate({scrollTop: aTag.offset().top},'slow');
		}
        function showHideDel(id, act){
            $.ajax({			
				url:'actions.php',
				type:'POST',
				data: {action: act, event_id: id},
				success:function(result){	alert(act);				
					if(result != 'success'){
						alert('Something went wrong during saving event!');
					}else{
						if(act == 'Show'){		
							$('#btn'+id).html('<span>Hide</span>');
							$('#btn'+id).attr('onclick', "showHideDel(" + id + ", 'Hide');");
						}
						if(act == 'Hide'){
							$('#btn'+id).html('<span>Show</span>');
							$('#btn'+id).attr('onclick', "showHideDel(" + id + ", 'Show');");
						}
						if(act == 'delete' && confirm("Are you sure to delete this event?") == true){			
							$('#event'+id).hide();
						}
					}
					
				}
			});
		}
		
	</script>
</body>
</html>