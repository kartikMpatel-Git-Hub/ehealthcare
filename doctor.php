<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <!-- Meta Tags -->
		<?php
			require "ImportFile/Head.php";
		?>
    </head>
    <body>
		<?php
		 	require "Section/PreLoader.php";
			require "Section/Header.php";
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
		<!-- End Breadcrumbs -->
		<?php
			require "php/connection.php";

			$query = "select * from doctor";
			$result= $database->query($query);
		?>
		<!-- Start Portfolio Details Area -->
			<section class="blog section">
				<div class="row" style="width:90%; padding-left:15%;">
				
					<?php
						for ($x=0; $x<$result->num_rows;$x++)
						{
							$row=$result->fetch_assoc();
							$docid=$row["doc_id"];
							$name=$row["doc_name"];
							$img=$row['doc_img'];
							$spe=$row['spec_id'];
							$spcil_res= $database->query("select spec_type from specialist  where spec_id='$spe'");
							$spcil_array= $spcil_res->fetch_assoc();
							$spcil_name=$spcil_array["spec_type"];
							$address=$row['doc_address'];
					?>
					<div class="col-lg-4 col-md-6 col-12" style="margin-top:30px;">
						<div class="single-news">
							<div class="news-head">
								<img src="User/Doctor/img/<?php echo $img; ?>" alt="#" height="10%">
							</div>
							<a href="">
							<div class="news-body">
								<div class="news-content">
									<center>
										<div class="date"><?php echo $name; ?></div>
										<h2><?php echo $spcil_name; ?></h2>
										<p class="text"><?php echo $address; ?></p>
									</center>
								</div>
							</div>
						</a>
						</div>
					</div>
					<?php } ?>
				</div>
			</section>
		<!-- End Portfolio Details Area -->
		
		<?php  
			require "Section/Footer.php";
			require "ImportFile/Javascript.php";
		?>
    </body>
</html>