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
		?>
		<!-- Slider Area -->
		<section class="slider">
			<div class="hero-slider">
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('img/Other/slider2.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>We Provide <span>Medical</span> Services That You Can <span>Trust!</span></h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl pellentesque, faucibus libero eu, gravida quam. </p>
									<div class="button">
										<a href="session.php " class="btn">Get Appointment</a>
										<a href="doctor.php" class="btn primary">View Doctor</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single Slider -->
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('img/Other/slider.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>We Provide <span>Medical</span> Services That You Can <span>Trust!</span></h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl pellentesque, faucibus libero eu, gravida quam. </p>
									<div class="button">
										<a href="session.php " class="btn">Get Appointment</a>
										<a href="doctor.php" class="btn primary">View Doctor</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Start End Slider -->
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('img/Other/slider3.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>We Provide <span>Medical</span> Services That You Can <span>Trust!</span></h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl pellentesque, faucibus libero eu, gravida quam. </p>
									<div class="button">
										<a href="session.php " class="btn">Get Appointment</a>
										<a href="doctor.php" class="btn primary">View Doctor</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single Slider -->
			</div>
		</section>
		<!--/ End Slider Area -->
		
		<!-- Start Schedule Area -->
		
		<!--/End Start schedule Area -->
		<?php 
			require "Import/Menu.php";
		?>
		<!-- Start Feautes -->
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
						<!-- Start Single features -->
						<div class="single-features">
							<div class="signle-icon">
								<i class="icofont icofont-ambulance-cross"></i>
							</div>
							<h3>Appointment Booking</h3>
							<p>Lorem ipsum sit, consectetur adipiscing elit. Maecenas mi quam vulputate.</p>
						</div>
						<!-- End Single features -->
					</div>
					<div class="col-lg-4 col-12">
						<!-- Start Single features -->
						<div class="single-features">
							<div class="signle-icon">
								<i class="icofont icofont-medical-sign-alt"></i>
							</div>
							<h3>Free Sessions	</h3>
							<p>Lorem ipsum sit, consectetur adipiscing elit. Maecenas mi quam vulputate.</p>
						</div>
						<!-- End Single features -->
					</div>
					<div class="col-lg-4 col-12">
						<!-- Start Single features -->
						<div class="single-features last">
							<div class="signle-icon">
								<i class="icofont icofont-stethoscope"></i>
							</div>
							<h3>Medical Treatment</h3>
							<p>Lorem ipsum sit, consectetur adipiscing elit. Maecenas mi quam vulputate.</p>
						</div>
						<!-- End Single features -->
					</div>
				</div>
			</div>
		</section>
		<!--/ End Feautes -->
		
		<!-- Start Fun-facts -->
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
		<!--/ End Fun-facts -->
		
		<!-- Start Why choose -->
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
						<!-- Start Choose Left -->
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
							<h2>Do you need Emergency Medical Care?</h2>
							<p>For Emergency Medical Care Contact us With Mail.</p>
							<div class="button">
								<a href="contact.php" class="btn">Contact Now</a>
								<a href="#" class="btn second">Learn More<i class="fa fa-long-arrow-right"></i></a>
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
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-tooth"></i>
							<h4><a href="doctor.php?action=view&id=3">Teeth Whitening</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-heart-alt"></i>
							<h4><a href="doctor.php?action=view&id=6">Heart Surgery</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-listening"></i>
							<h4><a href="doctor.php?action=view&id=7">Ear Treatment</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-eye-alt"></i>
							<h4><a href="doctor.php?action=view&id=8">Vision Problems</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-xray"></i>
							<h4><a href="doctor.php?action=view&id=4">XRAY</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
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
							<p>Lorem ipsum dolor sit amet consectetur adipiscing elit praesent aliquet. pretiumts</p>
						</div>
					</div>
				</div>
				<div class="row">
					<?php
						$query= $database->query("select * from article");
						$start = $query->num_rows;
						if($start)
						{
							$end = $start - 3;
							for ($x=$start; $x>$end; $x--)
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
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title">
					<?php
							}
						}
						else
						{
							echo '
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