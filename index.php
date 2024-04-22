<?php
		session_start();    
		$_SESSION["user"] = "";
		$_SESSION["usertype"] = "";
		$_SESSION['Message'] = "";
		$_SESSION['ERROR'] = "";


		date_default_timezone_set('Asia/Kolkata');

		$today = date('Y-m-d');
		$_SESSION['today'] = $today;
		require "php/connection.php";

		$query = "select * from doctor";
		$result= $database->query($query);
		$doctor = $result->num_rows;

		$query = "select * from patient";
		$result= $database->query($query);
		$patient = $result->num_rows;

		$query = "select * from schedule where sche_date = '$today'";
		$result= $database->query($query);
		$schedule = $result->num_rows;


		$query = "select * from specialist";
		$result= $database->query($query);
		$spec = $result->num_rows;
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
       <?php
			require "Import/Head.php";
			?>
			<link rel="stylesheet" href="style.css">
    </head>
    <body>
		
		
		<?php 
			require "Import/PreLoader.php";
			require "Import/navbar.php";
			require "Import/slidebar.php";
			require "Import/Menu.php";
		?>

		<section class="Feautes section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h2>We Are Always Ready to Help You & Your Family</h2>
							<img src="img/Other/section-img.png" alt="#">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-12">
						<div class="single-features">
							<div class="signle-icon">
								<i class="icofont icofont-ambulance-cross"></i>
							</div>
							<h3>Appointment Booking</h3>
							<p>Unlock Seamless Healthcare: Easily Schedule Your Next Appointment Online with Our User-Friendly Booking Platform!</p>
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="single-features">
							<div class="signle-icon">
								<i class="icofont icofont-medical-sign-alt"></i>
							</div>
							<h3>Free Sessions	</h3>
							<p>Exclusive Opportunity: Reserve Your Complimentary Sunday Session Now for a Limited Time!</p>
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="single-features last">
							<div class="signle-icon">
								<i class="icofont icofont-stethoscope"></i>
							</div>
							<h3>Medical Treatment</h3>
							<p>Discover Healing: Secure Your Session for Expert Medical Treatment Now!</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	
		<section>
			<div id="fun-facts" class="fun-facts section overlay">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-12">
							<!-- Start Single Fun -->
							<div class="single-fun">
								<i class="icofont icofont-doctor-alt"></i>
								<div class="content">
									<span class="counter"><?php echo $doctor; ?></span>
									<p>Available Doctors</p>
								</div>
							</div>
							<!-- End Single Fun -->
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<!-- Start Single Fun -->
							<div class="single-fun">
								<i class="icofont-simple-smile"></i>
								<div class="content">
									<span class="counter"><?php echo $patient; ?></span>
									<p>Total Patients</p>
								</div>
							</div>
							<!-- End Single Fun -->
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<!-- Start Single Fun -->
							<div class="single-fun">
								<i class="icofont icofont-table"></i>
								<div class="content">
									<span class="counter"><?php echo $schedule; ?></span>
									<p>Today's Total Session</p>
								</div>
							</div>
							<!-- End Single Fun -->
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<!-- Start Single Fun -->
							<div class="single-fun">
								<i class="icofont icofont-doctor"></i>
								<div class="content">
									<span class="counter"><?php echo $spec; ?></span>
									<p>Total Specialist</p>
								</div>
							</div>
							<!-- End Single Fun -->
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="why-choose section" >
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h2>We Offer Different Helth Article Of Specialist To Improve Your Health</h2>
							<img src="img/Other/section-img.png" alt="#">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="choose-left">
							<h3>The Importance of Holistic Health: Nurturing Body, Mind, and Spirit</h3>
							<br>
							<p>Embracing Holistic Health: Body, Mind, Spirit
								<br><br>
								In today's world, health is often narrowly defined by physical fitness. However, true well-being encompasses three essential aspects: physical, mental, and spiritual health.
								
								Physical Health: Exercise, nutrition, and sleep are foundational. Regular activity, a balanced diet, and sufficient rest promote vitality and prevent disease.
								
								Mental Health: Stress management is key. Practices like meditation and seeking support nurture mental clarity and emotional resilience.
								
								Spiritual Health: Finding purpose and connection is vital. Whether through religion, nature, or acts of kindness, nurturing the spirit enriches our lives.
								
								By embracing this holistic approach, we pave the way for a balanced and fulfilling existence, ensuring a healthier future.</p>
							<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
							
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="choose-right">
							<div class="video-image">
								<img src=""><i class="fa fa-play"></i></img>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="call-action overlay" data-stellar-background-ratio="0.5">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12">
						<div class="content">
							<h2>Do you need Medical Appointment?</h2>
							<p>For Medical Appointment Click Here.</p>
							<div class="button">
								<a href="session.php" class="btn">Appointment Now</a>
								<a href="doctor.php" class="btn second">More Docor<i class="fa fa-long-arrow-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="portfolio section" >
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h2>Here Are Some Article Of Specialist Doctor </h2>
							<img src="img/Other/section-img.png" alt="#">
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-12">
						<div class="owl-carousel portfolio-slider">
							<?php
								$query= $database->query("select * from doctor");
								for ($x=0; $x<$query->num_rows;$x++)
								{
									$row=$query->fetch_assoc();
									$did=$row['doc_id'];	
									$doc_img= $row['doc_img'];
									$spe=$row['spec_id'];
									$spcil_res= $database->query("select spec_type from specialist  where spec_id='$spe'");
									$spcil_array= $spcil_res->fetch_assoc();
									$spcil_name=$spcil_array["spec_type"];
								
							?>
							<div class="single-pf">
								<img src="img/Doctor/<?php echo $doc_img;?>" alt="#">
								<a href="doctordetail.php?action=view&id=<?php echo $did;?>" class="btn"><?php echo $spcil_name; ?></a>
							</div>
							<?php
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="services section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h2>We Offer Different Services To Improve Your Health</h2>
							<img src="img/Other/section-img.png" alt="#">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-prescription"></i>
							<h4><a href="doctor.php">General Treatment</a></h4>
							<p>Caring for Your Well-being: Experience Personalized Treatment with Our Doctor Appointment System. Book Today!</p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-tooth"></i>
							<h4><a href="doctor.php?action=view&id=3">Teeth Whitening</a></h4>
							<p>Revitalize Your Smile: Transformative Dental Care at Your Fingertips. Schedule Your Appointment Now! </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-heart-alt"></i>
							<h4><a href="doctor.php?action=view&id=6">Heart Surgery</a></h4>
							<p>Heartfelt Care, Lifesaving Solutions: Schedule Your Consultation for Heart Surgery Excellence Today! </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-listening"></i>
							<h4><a href="doctor.php?action=view&id=7">Ear Treatment</a></h4>
							<p>Ears to Your Health: Comprehensive Ear Treatment Tailored to Your Needs. Book Your Appointment for Expert Care Now!</p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-eye-alt"></i>
							<h4><a href="doctor.php?action=view&id=8">Vision Problems</a></h4>
							<p>See Clearly Again: Comprehensive Vision Solutions Tailored to Your Needs. Book Your Appointment for Expert Eye Care Now! </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-xray"></i>
							<h4><a href="doctor.php?action=view&id=4">XRAY</a></h4>
							<p>Crystal Clear Insights: Cutting-Edge X-ray Services for Accurate Diagnosis. Schedule Your Appointment for Imaging Excellence Today!</p>	
						</div>
					</div>
				</div>
			</div>
		</section>						

		<section class="blog section" id="blog">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h2>Keep up with Our Most Recent Medical News And Articles.</h2>
							<img src="img/Other/section-img.png" alt="#">
						</div>
					</div>
				</div>
				<div class="row">
					<?php
						$query= $database->query("select * from article");
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
						else
						{
					?>
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title">
					
							<?php echo '
							<div class="col-lg-4"></div>
							<div class="col-lg-4"><h2 style="text-align:center;">Article Not Available</h2></div>
							
							';
						}
					?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php 
			require "Import/Footer.php";
			require "Import/Javascript.php";
		?>
    </body>
</html>