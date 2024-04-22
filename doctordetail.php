<?php
session_start();    
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";
$_SESSION['Message'] = "";
$_SESSION['ERROR'] = "";
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
			$dob=$row["doc_dob"];
			$exp=$row["doc_experience"];
			$about=$row["doc_about"];
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
							
							<div class="image-slider" style="border-radius:0;">
									<img src="img/Doctor/<?php echo $img; ?>" alt="#" style="border-bottom-left-radius:0px;border-bottom-right-radius:0px;">
							</div>
							<div class="date" style="border-top-left-radius:0px;border-top-right-radius:0px;">
								<ul>
									<li><?php  echo $name; ?></li>
								</ul>
							</div>
						</div>
					</div>
					</center>
					<div class="col-lg-3 col-2"></div>
					<div class="col-6">
						<div class="inner-content">
							<div class="body-text" style="padding-top:100px; font-size:15px;">
							<table width="70%" >
								<tr>
									<td class="col-6 p-2" style="">Name</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $name; ?></td>	
								</tr>
								<tr>
									<td class="col-6 p-2" >Email</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $email; ?></td>	
								</tr>
								<tr>
									<td class="col-6 p-2" >Address</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $address; ?></td>	
								</tr>
								<tr>
									<td class="col-6 p-2" >Gender</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $gender; ?></td>	
								</tr>
								<tr>
									<td class="col-6 p-2" >Phone No</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $phoneno; ?></td>	
								</tr>
								<tr>
									<td class="col-6 p-2" >specialist</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $spcil_name; ?></td>	
								</tr>
								<tr>
									<td class="col-6 p-2" >Date Of Birth</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $dob; ?></td>	
								</tr>
								<tr>
									<td class="col-6 p-2" >Doctor's Experience</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $exp; ?> Year</td>	
								</tr>
								<tr>
									<td class="col-6 p-2" >About Doctor</td>	
									<td class="col-6" style="text-align:left; color:black;">: <?php echo $about; ?></td>	
								</tr>
								<tr>
									<td class="col-6 p-2" >Charge For Appointment</td>	
									<td class="col-6" style="text-align:left; color:black;">: ₹<?php echo $charge; ?></td>	
								</tr>
							</table>
							</div>
							
						</div>
						<center>
							<a href="session.php?action=view&id=<?php echo $id; ?>" class="col-10 btn" style="margin-top:50px; color:white;">View Session</a>
						</center>
					</div>
				</div>
			</div>
		</section>
		<section class="blog section" id="blog">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<?php
								$query= $database->query("select * from article where doc_id = $id");
								$end = $query->num_rows;
							?>
							<h2><?php if($end > 0 ){echo $name."'s Article";}?></h2>
						</div>
					</div>
				</div>
				<div class="row">
					<?php
						$query= $database->query("select * from article where doc_id = $id");
						$end = $query->num_rows;
						if($end)
						{
							for ($x=1; $x<=$end; $x++)
							{
								$row=$query->fetch_assoc();
								$aid=$row['article_id'];	
								$img= $row['article_img'];
								$title= $row['article_title'];
								$desc= $row['article_description'];
								$date= $row['article_date'];
								$desc = substr($desc,0,20);
								
					?>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-news">
							<div class="news-head">
								<img src="img/Article/<?php echo $img; ?>" alt="#" class="col-12">
							</div>
							<div class="news-body">
								<div class="news-content">
									<div class="date"><?php echo $date; ?></div>
									<h2><a href="singlearticle.php?action=view&id=<?php echo $aid;?>"><?php echo $title;?></a></h2>
									<p class="text"><?php echo $desc; ?></p>
								</div>
							</div>
						</div>
					</div>
					<?php
							}
						}
					?>
							</div>
						</div>
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