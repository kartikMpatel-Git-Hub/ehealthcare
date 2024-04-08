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
        <!-- Meta Tags -->
		<?php
			require "Import/Head.php";
		?>
    </head>
    <body>
		<?php
		 	require "Import/PreLoader.php";
			require "Import/navbar.php";
		?>
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Doctor</h2>
							<ul class="bread-list">
								<li><a href="index.html">Home</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active">All Doctors</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			require "php/connection.php";
			if($_GET){
				$id=$_GET["id"];
				$action=$_GET["action"];
				if($action=='view')
				{
					$query = "select * from doctor where spec_id = '$id'";
					$result= $database->query($query);
				}
				else
				{
					?>
						<script>window.location.href='specialist.php';</script>
					<?php
				}
			}
			else
			{
				$query = "select * from doctor";
				$result= $database->query($query);	
			}
			
		?>
		<!-- Start Portfolio Details Area -->
			<section class="blog section">
				<div class="row" style="width:90%; padding-left:15%;">
				
					<?php
						if($result->num_rows)
						{
							for ($x=0; $x<$result->num_rows;$x++)
							{
								$row=$result->fetch_assoc();
								$docid=$row["doc_id"];
								$name=$row["doc_name"];
								$img=$row['doc_img'];
								$spe=$row['spec_id'];
								$charge=$row['doc_charge'];
								$spcil_res= $database->query("select spec_type from specialist  where spec_id='$spe'");
								$spcil_array= $spcil_res->fetch_assoc();
								$spcil_name=$spcil_array["spec_type"];
								$address=$row['doc_address'];
					?>
					<div class="col-lg-4 col-md-6 col-12" style="margin-top:30px;">
						<div class="single-news">
							<div class="news-head">
								<img src="../../img/Doctor/<?php echo $img; ?>" alt="#" height="10%">
							</div>
							<a href="doctordetail.php?action=view&id=<?php echo $docid; ?>">
							<div class="news-body">
								<div class="news-content">
									<center>
										<div class="date"><?php echo $name; ?></div>
										<h2><?php echo $spcil_name; ?></h2>
										<p class="text"><?php echo $address; ?></p>
										<p class="text">Charge - <b>₹<?php echo $charge; ?></b></p>
									</center>
								</div>
							</div>
						</a>
						</div>
					</div>
					<?php 
							}
						}
						else
						{
							$spcil_res= $database->query("select spec_type from specialist  where spec_id='$id'");
							$spcil_array= $spcil_res->fetch_assoc();
							$spcil_name=$spcil_array["spec_type"];
							echo '<div style="font-size:50px; margin-left:300px;">'.$spcil_name.' Not Available !</div>';
						} 
					?>
				</div>
			</section>
		<!-- End Portfolio Details Area -->
		
		<?php  
			require "Import/Footer.php";
			require "Import/Javascript.php";
		?>
    </body>
</html>