<!DOCTYPE HTML>

<html>
	<head>
		<title>Circles</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrollzer.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body>
		<div id="wrapper">

			<!-- Header -->
				<section id="header" class="skel-layers-fixed">
					<header>
						
						
						<h1 id="logo"><a href="#">Instagram Pictures</a></h1>
					</header>

					<!-- <nav id="nav">

						<ul>
							<li><a href="#one" class="active">Notes</a></li>
							<li><a href="#two">Discussion Forum</a></li>
							
						</ul>
					</nav>
					 --><div>
						
					</div>
					<footer>
						<ul class="icons">

							<li><a href="#" class="icon fa-sign-out "><span class="label">Signout</span></a><p>NEXT </p></li>

							
						</ul>
					</footer>

				</section>

			<!-- Main -->
				<section id="main">
            <div id="map_canvas" style="width: 100%; height: 736px;"></div>
            <div id="map_canvas-2" style="width: 100%; height: 736px;"></div>
        </section>

			<!-- Footer -->
				
			
		</div>
	</body>
	<?php
  //this should be found by this program    
$server     = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'realhack';
// USING POST FROM FORM WE GET RESPONSES LIKE

$h=$_POST['hospital'];
$s=$_POST['school'];
$p=$_POST['park'];
$t=$_POST['public'];
$m=$_POST['malls'];
$he=$_POST['help'];

$hospitals_option=0;
$schools_option=0;
$recreational_option=0;
$malls_option=0;
$transport_option=0;
$health_option=0;

if($h=="yes")
{
  $hospitals_option=1;
}
if($s=="yes")
{
  $schools_option=1;
}
if($p=="yes")
{
  $recreational_option=1;
}
if($t=="yes")
{
  $transport_option=1;
}
if($m=="yes")
{
  $malls_option=1;
}
if($he=="yes")
{
  $health_option=1;
}



$con=mysqli_connect("localhost","root","","realhack");
    if(mysqli_connect_errno()){
        echo "ERROR ".mysqli_connect_error();
    }
//NOW WE SHOULD USE THIS DATA TO GET SUGGSTED AREAS

//now for each of these factors, starting with hospitals, check number of these in every sector in database
//so first make database connection
$query = "SELECT sector_number,latitude,longitude,name,hospitals,schools,recreational,malls,transport,health FROM sectors";
$result2 = $con->query($query);


      
 $max=0;
 $max_sector_number=0;
while ($row = $result2->fetch_assoc() ) {
   $sector_sum=0;
    $latitude_sector=$row['latitude'];
   $longitude_sector=$row['longitude'];
   $name=$row['name'];
   $sector_number=$row['sector_number'];


   $hospitals=$row['hospitals'];
   $malls-$row['malls'];
   $schools=$row['schools'];
   $recreational=$row['recreational'];
   $transport=$row['transport'];
   $health=$row['health'];


   if($hospitals_option==1)
   {
    $sector_sum=$sector_sum+$hospitals;
   }
   if($malls_option==1)
   {
    $sector_sum=$sector_sum+$malls;
   }
   if($schools_option==1)
   {
    $sector_sum=$sector_sum+$schools;
   }
   if($recreational_option==1)
   {
    $sector_sum=$sector_sum+$recreational;
   }
   if($transport_option==1)
   {
    $sector_sum=$sector_sum+$transport;
   }
   if($health_option==1)
   {
    $sector_sum=$sector_sum+$health;
   }


   if($sector_sum>$max)
   {
    $max=$sector_sum;
    $max_sector_number=$sector_number;
   }

}



$sector=$max_sector_number;


//----------------------------------------------------------------------------
 

$query = "SELECT latitude,longitude FROM sectors WHERE sector_number='".$sector."'";
$result2 = $con->query($query);

//fetch tha data from the database 
while ($row = $result2->fetch_assoc() ) {
   
   $latitude_area=$row['latitude'];
   $longitude_area=$row['longitude'];

}

    //first get lat long of user in focus
    //INSTEAD OF 1 ENTER USER ID
        
        $ULatitude=12.9667;
        $ULongitude=77.5667;
        echo " <script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?sensor=false\"></script>";
        echo "<script src=\"https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places\"></script>";
        echo "<script type=\"text/javascript\">

            //<![CDATA[
         
        var map;
         var center_area = new google.maps.LatLng($latitude_area, $longitude_area);
         var plot1=new google.maps.LatLng(12.937,77.638);
         var plot2 =new google.maps.LatLng(12.969,77.537);
         var plot3 =new google.maps.LatLng(12.975,77.539);

         var Ucenter = new google.maps.LatLng($ULatitude, $ULongitude);
        var cityCircle;
        function init1() {
         
            

             
            var mapOptions = {
                zoom: 12,
                center: Ucenter,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
             
            map = new google.maps.Map(document.getElementById(\"map_canvas\"), mapOptions);

             var request = {
                location: center_area,
                radius: 3000,
                types: ['hospital']
              };
            var pinColor = \"22c481\";
        
            infowindow = new google.maps.InfoWindow();
            var content1 = '<div class=\"infoWindow\">'+
                       '<a href=\"../ldi.php?pid=1\">plot 1</a>'+
                     '</div>';
             var content2 = '<div class=\"infoWindow\">'+
                       '<a href=\"../ldi.php?pid=2\">plot 2</a>'+
                     '</div>';     
               var content3 = '<div class=\"infoWindow\">'+
                       '<a href=\"../ldi.php?pid=3\">plot 3</a>'+
                     '</div>';              
         
    var pinImage = new google.maps.MarkerImage(\"http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|\" + pinColor,
        new google.maps.Size(21, 34),
        new google.maps.Point(0,0),
        new google.maps.Point(10, 34));
             var marker3 = new google.maps.Marker({
                    map: map, 
                    position: plot1,
                    icon : pinImage
                });

            var marker4 = new google.maps.Marker({
                    map: map, 
                    position: plot2,
                    icon : pinImage
                });
            var marker5 = new google.maps.Marker({
                    map: map, 
                    position: plot3,
                    icon : pinImage
                });
  google.maps.event.addListener(marker3, 'click', function() {
            
             infowindow.setContent(content1);
            infowindow.open(map,marker3);
            
        });
  google.maps.event.addListener(marker4, 'click', function() {
            
             infowindow.setContent(content2);
            infowindow.open(map,marker4);
            
        });
  google.maps.event.addListener(marker5, 'click', function() {
            
             infowindow.setContent(content3);
            infowindow.open(map,marker5);
            
        });



            var populationOptions = {
                    strokeColor: 'blue',
                    strokeOpacity: 0.8,
                    strokeWeight: 1,
                    fillColor: 'blue',
                    fillOpacity: 0.35,
                    map: map,
                    center: center_area,
                    radius:3000
                };
                cityCircle = new google.maps.Circle(populationOptions);
                
                infowindow = new google.maps.InfoWindow();
 
                 var service = new google.maps.places.PlacesService(map);
                 service.nearbySearch(request, callback);

        
          
          }
          init1();
          function callback(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {
              createMarker(results[i]);
            }
         }
      }
      function createMarker(place) {
              var placeLoc = place.geometry.location;
              var marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location
              });

              google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
              });
            }

        ";
        $result2 = mysqli_query($con,"SELECT image,comments,latitude,longitude from locations");
       
   
        while($row = mysqli_fetch_array($result2)) {
        $Latitude=$row['latitude'];
        $Longitude=$row['longitude'];
        $comments=$row['comments'];
        $image = $row['image'];
        

        //if($Latitude<$ULatitude+5&&$Latitude>$ULatitude-5&&$Longitude<$ULongitude+5&&$Longitude>$ULongitude-5)
        //{
            //in the range
            //plot this on the graph
            //echo $User_name;
            

            echo "init($Latitude,$Longitude,'$comments','$image');";
       // }

    }


        echo"function init(x,y,x1,y1){
            
          
            var infowindow = new google.maps.InfoWindow();

            var content = '<div class=\"infoWindow\">'+
                       '<h>'+x1+'</h>'+'<br>'+
                       '<img src=\"'+y1+'\"  width=\"128\" height=\"128\">'+
                     '</div>';
            
        
        var center2 = new google.maps.LatLng(x, y);
        
        var pinColor = \"3399FF\";
        

         
    var pinImage = new google.maps.MarkerImage(\"http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|\" + pinColor,
        new google.maps.Size(21, 34),
        new google.maps.Point(0,0),
        new google.maps.Point(10, 34));
             
            var marker2 = new google.maps.Marker({
                map: map, 
                position: center2,
                icon:pinImage,
            });
  google.maps.event.addListener(marker2, 'click', function() {
            
             infowindow.setContent(content);
            infowindow.open(map,marker2);
            
        });
          
        }
        //]]>
        </script>
            ";
           






//this is for all other users
        


?>

</html>