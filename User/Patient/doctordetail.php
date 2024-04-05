<?php
session_start();

if(isset($_SESSION["email"])){
    if(($_SESSION["email"])=="" or $_SESSION['usertype']!='P'){
        header("location: ../../login.php");
    }else{
        $useremail=$_SESSION["email"];
    }
}else{
    header("location: ../../login.php");
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
		<?php
			require "Import/Head.php";
		?>
    </head>
    <body>
	
		<?php
		 	require "Import/PreLoader.php";
			require "Import/navbar.php";

			require "php/connection.php";
			if($_GET){
				$id=$_GET["id"];
				$action=$_GET["action"];
				if($action=='view')
				{
					$query = "select * from doctor where doc_id = '$id'";
					$result= $database->query($query);
					$row=$result->fetch_assoc();
					$docid=$row["doc_id"];
					$name=$row["doc_name"];
				}
				else
				{ 	
					?>
						<script>window.location.href='doctor.php';</script>
					<?php
				}
			}

		?>
		<!-- Breadcrumbs -->
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2> Details</h2>
							<ul class="bread-list">
								<li><a href="index.html">Home</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active">Doctor's Details</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
	
		<?php

			
			$email=$row["doc_email"];
			$address=$row['doc_address'];
			$phoneno=$row['doc_phoneno'];
			$gender=$row['doc_gender'];
			$charge=$row['doc_charge'];
			$img=$row['doc_img'];
			$spe=$row['spec_id'];
			$spcil_res= $database->query("select spec_type from specialist  where spec_id='$spe'");
			$spcil_array= $spcil_res->fetch_assoc();
			$spcil_name=$spcil_array["spec_type"];
		?>
		<!-- Start Portfolio Details Area -->
		<section class="pf-details section">
			<div class="container">
				<div class="row">
					<center>
					<div  style="width:50%;">
						<div class="inner-content">
							
							<div class="image-slider">
									<img src="../Doctor/img/<?php echo $img; ?>" alt="#">
							</div>
							<div class="date">
								<ul>
									<li><?php  echo $name; ?></li>
								</ul>
							</div>
						</div>
					</div>
					</center>
					<div  class="col-12">
						<div class="inner-content">
							<div class="body-text" style="padding-top:100px; font-size:15px;">
							<table width="100%" >
								<tr>
									<td class="col-6" style="padding-left:30%;">Name</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $name; ?></td>	
								</tr>
								<tr>
									<td class="col-6" style="padding-left:30%;">Email</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $email; ?></td>	
								</tr>
								<tr>
									<td class="col-6" style="padding-left:30%;">Address</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $address; ?></td>	
								</tr>
								<tr>
									<td class="col-6" style="padding-left:30%;">Gender</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $gender; ?></td>	
								</tr>
								<tr>
									<td class="col-6" style="padding-left:30%;">Phone No</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $phoneno; ?></td>	
								</tr>
								<tr>
									<td class="col-6" style="padding-left:30%;">specialist</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $spcil_name; ?></td>	
								</tr>
								<tr>
									<td class="col-6" style="padding-left:30%;">Charge For Appointment</td>	
									<td class="col-6" style="text-align:left; color:black;">: ₹<?php echo $charge; ?></td>	
								</tr>
							</table>
							</div>
							
						</div>
						<center>
						<a href="session.php?action=view&id=<?php echo $id; ?>">
						<div class="btn-appo" style="width:20%;padding-top:100px;">
							<div class="inner-content">
								<div class="date" style="border-radius:10px;"> 
									<ul>
										<li>View Schedule</li>
									</ul>
								</div>
							</div>
						</div>
						</a>
						</center>
					</div>
				</div>
			</div>
		</section>
		<!-- End Portfolio Details Area -->
		<?php  
			require "Import/Footer.php";
			require "Import/Javascript.php";
		?>
    </body>
</html>