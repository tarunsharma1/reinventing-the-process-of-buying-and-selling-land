<?php
include "connect.php";

$pid = $_GET["pid"];
$mother_d_v;
$sale_d_v;
$khatha_a_v;
$khatha_b_v;
$bc_v;
$tax_v;
$ec_v;
$ldi_val;


$sql = "SELECT mother_d,sale_d,khatha_a,khatha_b,bc,tax,ec,ldi_value from ldi where pid = $pid";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $mother_d_v = $row["mother_d"];
        $sale_d_v =  $row["sale_d"];
        $khatha_a_v = $row["khatha_a"];
        $khatha_b_v =  $row["khatha_b"];
        $bc_v = $row["bc"];
        $tax_v = $row["tax"];
        $ec_v =  $row["ec"];
        $ldi_val = $row["ldi_value"];
        //echo $row["mother_d"]. " | " . $row["sale_d"]. "|" . $row["khatha_a"]. " |".$row["khatha_b"]." | ".$row["bc"]." | ".$row["tax"]." | ".$row["ec"]." | ".$row["ldi_value"]."<br>";
    }
} else {
    echo "0 results";
}

$mother_value = split ("#", $mother_d_v)[0]; 
$sale_value = split ("#", $sale_d_v)[0]; 
$khatha_a_value = split ("#", $khatha_a_v)[0]; 
$khatha_b_value = split ("#", $khatha_b_v)[0]; 
$bc_value = split ("#", $bc_v)[0]; 
$tax_value = split ("#", $tax_v)[0]; 
$ec_value = split ("#", $ec_v)[0];

$tax_no = split ("#", $tax_v)[1]; 

$ec_no = split ("#", $ec_v)[1]; 


$mother_location = split ("#", $mother_d_v)[2]; 
$sale_location = split ("#", $sale_d_v)[2]; 
$khatha_a_location = split ("#", $khatha_a_v)[2]; 
$khatha_b_location = split ("#", $khatha_b_v)[2]; 
$bc_location = split ("#", $bc_v)[2]; 
$tax_location = split ("#", $tax_v)[2]; 
$ec_location = split ("#", $ec_v)[2]; 


$ldi_v = $mother_value+ $sale_value+$khatha_a_value+$khatha_b_value+$bc_value+($tax_value*$tax_no)+($ec_value*$ec_no);

$ldi_val = $ldi_v/10.0;
$sql  = "UPDATE `ldi` SET `ldi_value`= '$ldi_val' WHERE `pid` = '$pid'";
//echo $sql;
if (mysqli_query($conn, $sql)) {
    //echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}



echo "<!DOCTYPE HTML>

<html>
	<head>
		<title>Circles</title>
		<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
		<meta name=\"description\" content=\"\" />
		<meta name=\"keywords\" content=\"\" />
		<!--[if lte IE 8]><script src=\"css/ie/html5shiv.js\"></script><![endif]-->
		<script src=\"js/jquery.min.js\"></script>
		<script src=\"js/jquery.scrollzer.min.js\"></script>
		<script src=\"js/jquery.scrolly.min.js\"></script>
		<script src=\"js/skel.min.js\"></script>
		<script src=\"js/skel-layers.min.js\"></script>
		<script src=\"js/init.js\"></script>
		<noscript>
			<link rel=\"stylesheet\" href=\"css/skel.css\" />
			<link rel=\"stylesheet\" href=\"css/style.css\" />
			<link rel=\"stylesheet\" href=\"css/style-xlarge.css\" />

 
		</noscript>
		<!--[if lte IE 8]><link rel=\"stylesheet\" href=\"css/ie/v8.css\" /><![endif]-->
	</head>
	<body>
		<div id=\"wrapper\">

			<!-- Header -->
				<section id=\"header\" class=\"skel-layers-fixed\">
					<header>
						
						<h1 id=\"logo\"><a href=\"#\">DOCUMENTS</a></h1>
					</header>

					<nav id=\"nav\">

						<ul>
							
							<li><a href=\"#one\" >LDI</a></li>
							<li><a href=\"#two\">Title Deed</a></li>
							<li><a href=\"#three\" >Sale Deed</a></li>
							<li><a href=\"#four\">A Katha Certificate</a></li>
							<li><a href=\"#five\" >B Katha Certificate</a></li>
							<li><a href=\"#six\">Betterment charge certificate</a></li>
							<li><a href=\"#seven\" >Tax Payed recipt</a></li>
							<li><a href=\"#eight\" >Encumbrance Certificate</a></li>
							
						</ul>
					</nav>
					<div>
						
						<button type=\"submit\" class=\"button button-block\"/>Chat With Lawyer</button>
						<button type=\"submit\" class=\"button button-block\"/>Chat With Owner</button>
					</div>



				</section>

			<!-- Main -->
				<div id=\"main\">

					

					<!-- One -->
						<section id=\"one\">
							
							<div class=\"container\">

							                            
								<header class=\"major\">
									
									<progress value=$ldi_val max=\"10\"></progress>
									<p> $ldi_val out of 10</p>
									

									
									
								</header>
								<div class=\"top-row\">
                                   <div class=\"field-wrap\">
                                        
                                    </div>
							</div>
							
						</section>
						
					<!-- Two -->
						<section id=\"two\">
							<div class=\"container\">
							   <header class=\"major\">
								<h3>Title Deed</h3>
								<div class=\"top-row\">
                                   <div class=\"field-wrap\">
                                        <img src=$mother_location alt=\"Smiley face\" height=\"600\" width=\"400\"> 
                                    </div>
							
							</div>
							
						</section>
						
					<section id=\"three\">
							<div class=\"container\">
								<header class=\"major\">
									<h3>Sale Deed</h3>
									
								</header>
								<div class=\"top-row\">
                                   <div class=\"field-wrap\">
                                        <img src=$sale_location alt=\"Smiley face\" height=\"412.5\" width=\"300\">
                                           
                                    </div>
							</div>
							
						</section>

					<section id=\"four\">
							<div class=\"container\">
								<header class=\"major\">
									<h3>A Katha Certificate</h3>
									
								</header>
								<div class=\"top-row\">
                                   <div class=\"field-wrap\">
                                        <img src=$khatha_a_location alt=\"Smiley face\" height=\"412.5\" width=\"300\">

                                    </div>
							</div>
							
						</section>

					<section id=\"five\">
							<div class=\"container\">
								<header class=\"major\">
									<h3>B Katha Certificate</h3>
									
								</header>
								<div class=\"top-row\">
                                   <div class=\"field-wrap\">
                                      <img src=$khatha_b_location alt=\"Smiley face\" height=\"412.5\" width=\"300\">

                                    </div>
							</div>
							
						</section>
					<section id=\"six\">
							<div class=\"container\">
								<header class=\"major\">
									<h3>Betterment charge certificate</h3>
									
								</header>
								<div class=\"top-row\">
                                   <div class=\"field-wrap\">
                                        <img src=$bc_location alt=\"Smiley face\" height=\"412.5\" width=\"300\">

                                    </div>
							</div>
						
						</section>
						
						<section id=\"seven\">
							<div class=\"container\">
								<header class=\"major\">
									<h3>Tax Payed Recipt</h3>
									
								</header>
								<div class=\"top-row\">
                                   <div class=\"field-wrap\">
                                        <img src=$tax_location/tax-$pid.jpg alt=\"Smiley face\" height=\"455.5\" width=\"800\">

                                    </div>
							</div>
							
						</section>

						<section id=\"eight\">
							<div class=\"container\">
								<header class=\"major\">
									<h3>Encumbrance Certificate</h3>
									
								</header>
								<div class=\"top-row\">
                                   <div class=\"field-wrap\">
                                          <img src=$ec_location/encumbrance-$pid.jpg alt=\"Smiley face\" height=\"412.5\" width=\"300\">

                                    </div>
							</div>
							
						</section>
						
					
				
				</div>

			<!-- Footer -->
				
			
		</div>
	</body>
</html>";   

?>