<?php

	date_default_timezone_set('Asia/Kolkata');
        
	$today = date('Y-m-d');

	require "php/connection.php";
	$_SESSION['usertype'] = ""; 

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
			require "ImportFile/Head.php";
	   ?>
    </head>
    <body>
		
		
		<?php 
			require "Section/PreLoader.php";
			require "Section/navbar.php";
		?>
		<!-- Slider Area -->
		<section class="slider">
			<div class="hero-slider">
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('img/slider2.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>We Provide <span>Medical</span> Services That You Can <span>Trust!</span></h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl pellentesque, faucibus libero eu, gravida quam. </p>
									<div class="button">
										<a href="login.php " class="btn">Get Appointment</a>
										<a href="doctor.php" class="btn primary">View Doctor</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single Slider -->
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('img/slider.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>We Provide <span>Medical</span> Services That You Can <span>Trust!</span></h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl pellentesque, faucibus libero eu, gravida quam. </p>
									<div class="button">
										<a href="login.php " class="btn">Get Appointment</a>
										<a href="doctor.php" class="btn primary">View Doctor</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Start End Slider -->
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('img/slider3.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>We Provide <span>Medical</span> Services That You Can <span>Trust!</span></h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl pellentesque, faucibus libero eu, gravida quam. </p>
									<div class="button">
										<a href="login.php " class="btn">Get Appointment</a>
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
			require "Section/Menu.php";
		?>
		<!-- Start Feautes -->
		<section class="Feautes section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h2>We Are Always Ready to Help You & Your Family</h2>
							<img src="img/section-img.png" alt="#">
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
							<img src="img/section-img.png" alt="#">
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
								<a href="#" class="btn">Contact Now</a>
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
							<img src="img/section-img.png" alt="#">
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-12">
						<div class="owl-carousel portfolio-slider">
							<div class="single-pf">
								<img src="img/pf1.jpg" alt="#">
								<a href="blog-single.html" class="btn">View Details</a>
							</div>
							<div class="single-pf">
								<img src="img/pf2.jpg" alt="#">
								<a href="portfolio-details.html" class="btn">View Details</a>
							</div>
							<div class="single-pf">
								<img src="img/pf3.jpg" alt="#">
								<a href="portfolio-details.html" class="btn">View Details</a>
							</div>
							<div class="single-pf">
								<img src="img/pf4.jpg" alt="#">
								<a href="portfolio-details.html" class="btn">View Details</a>
							</div>
							<div class="single-pf">
								<img src="img/pf1.jpg" alt="#">
								<a href="portfolio-details.html" class="btn">View Details</a>
							</div>
							<div class="single-pf">
								<img src="img/pf2.jpg" alt="#">
								<a href="portfolio-details.html" class="btn">View Details</a>
							</div>
							<div class="single-pf">
								<img src="img/pf3.jpg" alt="#">
								<a href="portfolio-details.html" class="btn">View Details</a>
							</div>
							<div class="single-pf">
								<img src="img/pf4.jpg" alt="#">
								<a href="portfolio-details.html" class="btn">View Details</a>
							</div>
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
							<img src="img/section-img.png" alt="#">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-prescription"></i>
							<h4><a href="service-details.html">General Treatment</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-tooth"></i>
							<h4><a href="service-details.html">Teeth Whitening</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-heart-alt"></i>
							<h4><a href="service-details.html">Heart Surgery</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-listening"></i>
							<h4><a href="service-details.html">Ear Treatment</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-eye-alt"></i>
							<h4><a href="service-details.html">Vision Problems</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. </p>	
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="icofont icofont-blood"></i>
							<h4><a href="service-details.html">Blood Transfusion</a></h4>
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
							<img src="img/section-img.png" alt="#">
							<p>Lorem ipsum dolor sit amet consectetur adipiscing elit praesent aliquet. pretiumts</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-news">
							<div class="news-head">
								<img src="img/blog1.jpg" alt="#">
							</div>
							<div class="news-body">
								<div class="news-content">
									<div class="date">22 Aug, 2020</div>
									<h2><a href="blog-single.html">We have annnocuced our new product.</a></h2>
									<p class="text">Lorem ipsum dolor a sit ameti, consectetur adipisicing elit, sed do eiusmod tempor incididunt sed do incididunt sed.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-news">
							<div class="news-head">
								<img src="img/blog2.jpg" alt="#">
							</div>
							<div class="news-body">
								<div class="news-content">
									<div class="date">15 Jul, 2020</div>
									<h2><a href="blog-single.html">Top five way for solving teeth problems.</a></h2>
									<p class="text">Lorem ipsum dolor a sit ameti, consectetur adipisicing elit, sed do eiusmod tempor incididunt sed do incididunt sed.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-news">
							<div class="news-head">
								<img src="img/blog3.jpg" alt="#">
							</div>
							<div class="news-body">
								<div class="news-content">
									<div class="date">05 Jan, 2020</div>
									<h2><a href="blog-single.html">We provide highly business soliutions.</a></h2>
									<p class="text">Lorem ipsum dolor a sit ameti, consectetur adipisicing elit, sed do eiusmod tempor incididunt sed do incididunt sed.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php 
			require "Section/Footer.php";
			require "ImportFile/Javascript.php";
		?>
    </body>
</html>