<?php
    require_once ("inc/main.php");
    
?>
<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US"><!--<![endif]-->
<head>
	<title>Zooom Home | Zooom Productions</title>
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
			<div class="row official-shop checkout clearfix mbs">
				<div class="grid_12">
					<div id="very-big-map" class="official-map"></div>
					
				</div>
			</div><!-- row -->
			<div class="row clearfix mbs">
			    <div class="grid_12" style="background: 0 0 #f7f7f7;">
					<div class="action clearfix" id="eventhead">
						<div class="inner">
							<a class="tbutton flr small" href="javascript:;" onclick="catWiseMap('CAT2');"><span>CAT 2</span></a>
							<a class="tbutton flr small" href="javascript:;" onclick="catWiseMap('CAT1');"><span>CAT 1</span></a>
																				
							<div class="matn">
								<input type="text" name="searchterm" id="searchTextField" placeholder="Address search" class="righttip" title="Address search">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row clearfix mbs">
			    <div class="grid_8">
					<div class="services mbs clearfix" id="cat1">
						<h3 class="col-title"> CAT 1 </h3><span class="liner mb"></span>
						
					</div>
				</div>
				<div class="grid_4">
					<div class="services mbs clearfix" id="cat2">
						<h3 class="col-title"> CAT 2 </h3><span class="liner mb"></span>
						
					</div>
				</div>
			</div>
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
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places"></script>
	<script type="text/javascript" src="js/gmap3.js"></script>
	<script type="text/javascript" src="js/twitter/jquery.tweet.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	<script>
		function initialize() {
			var map = $('#very-big-map').gmap3("get");//new google.maps.Map(document.getElementById('very-big-map'));
			var input = document.getElementById('searchTextField');
			var types = document.getElementById('type-selector');
			//map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
			//map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
			var autocomplete = new google.maps.places.Autocomplete(input);
			autocomplete.bindTo('bounds', map);
			var infowindow = new google.maps.InfoWindow();
		    var marker = new google.maps.Marker({
				map: map,
				anchorPoint: new google.maps.Point(0, -29)
		    });

			google.maps.event.addListener(autocomplete, 'place_changed', function () {
				//var place = autocomplete.getPlace();				
				infowindow.close();
				marker.setVisible(false);
				var place = autocomplete.getPlace();alert(place);
				if (!place.geometry) {
				  window.alert("Autocomplete's returned place contains no geometry");
				  return;
				}

				// If the place has a geometry, then present it on a map.
				if (place.geometry.viewport) {
				  map.fitBounds(place.geometry.viewport);
				} else {
				  map.setCenter(place.geometry.location);
				  map.setZoom(2);  // Why 17? Because it looks good.
				}
				marker.setIcon(/** @type {google.maps.Icon} */({
				  url: place.icon,
				  size: new google.maps.Size(71, 71),
				  origin: new google.maps.Point(0, 0),
				  anchor: new google.maps.Point(17, 34),
				  scaledSize: new google.maps.Size(35, 35)
				}));
				marker.setPosition(place.geometry.location);
				marker.setVisible(true);
				
				var address = '';
				if (place.address_components) {
				  address = [
					(place.address_components[0] && place.address_components[0].short_name || ''),
					(place.address_components[1] && place.address_components[1].short_name || ''),
					(place.address_components[2] && place.address_components[2].short_name || '')
				  ].join(' ');
				}

				infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
				infowindow.open(map, marker);
			});
			
		}
		google.maps.event.addDomListener(window, 'load', initialize); 
		$.getJSON( "events.php?cat=CAT1", function( data ) {
          var i=0;			
		  $.each(data, function(index, element) {			  
			   var html = '<div class="grid_4" ><div class="stitle mb clearfix"><br><small>'+ element.lat +' - '+ element.lng +'</small><h5> '+ element.title +'</h5><h5> '+ element.address +'</h5></div><a href="#" class="tbutton small" onclick="myClick(\'event'+element.id+'\');"><span>Show on Map<i class="mii icon-angle-right"></i></span></a></div>'
			   $('#cat1').append( html);
			   i++;
		  });
		});
		$.getJSON( "events.php?cat=CAT2", function( data ) {
		  var i=0;
		  $.each(data, function(index, element) {			  
			   var html = '<div class="grid_4"><div class="stitle mb clearfix"><br><small>'+ element.lat +' - '+ element.lng +'</small><h5> '+ element.title +'</h5><h5> '+ element.address +'</h5></div><a href="#" class="tbutton small" onclick="myClick(\'event'+element.id+'\');"><span>Show on Map<i class="mii icon-angle-right"></i></span></a></div>'
			   $('#cat2').append( html);
			   i++;
		  });
		});
		function myClick(id){//alert(markers[id]);
		   var marker = $("#very-big-map").gmap3({ get: { id: id } });
		   google.maps.event.trigger(marker, 'click');
        }
		
		// Reload Map with category wise markers
		function catWiseMap(cat){alert(cat);
			
			// Loop through markers and set map to null for each
			for (var i=0; i<markers.length; i++) {
                var marker = $("#very-big-map").gmap3({ get: { id: markers[i].id } });				
				marker.setMap(null);
			}
			
			// Reset the markers array
			markers = [];

			jQuery.ajax({
				url: 'markers.php?cat='+cat
			}).done(function(data) {
				// Re-initialise the map with loaded marker data
				markers = data || [];
				// Very Big Map
				if ($("#very-big-map")[0]) {
					jQuery("#very-big-map").gmap3({
					  
					  marker:{
						values: markers ,
						options:{
						  draggable: false
						},
						events:{
						  click: function(marker, event, context){
							var map = $(this).gmap3("get"),
							infowindow = $(this).gmap3({get:{name:"infowindow"}});
							if (infowindow){
							  infowindow.open(map, marker);
							  infowindow.setContent(context.data);
							} else {
							  $(this).gmap3({
								infowindow:{
								  anchor:marker, 
								  options:{content: context.data}
								}
							  });
							}
						  },
						  /*mouseout: function(){
							var infowindow = $(this).gmap3({get:{name:"infowindow"}});
							if (infowindow){
							  infowindow.close();
							}
						  }*/
						}
					  }
					}).height('400');
					
					
				}
			});
		}
	</script>
</body>
</html>