	<header class="header" >
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-12">
							<!-- Contact -->
							<ul class="top-link">
								<li><a href="doctor.php">Doctor</a></li>
								<li><a href="profile.php">Profile</a></li>
								<li><a href="session.php">Session</a></li>
							</ul>
							<!-- End Contact -->
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact">
								<li><i class="fa fa-phone"></i>+<?php echo $_SESSION['phoneno'];?></li>
								<li><i class="fa fa-envelope"></i><a href="#"><?php echo $_SESSION['email'];?></a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Topbar -->
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="index.html" style="font-size: large; color: rgb(42 176 226); font-weight: bold; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;"><img src="../../img/Other/logo.png" alt="#" width="50px">E-Health Care</a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
											<li><a href="index.php">Home</a></li>
											<li><a href="specialist.php">Specialist</a></li>
											<li><a href="doctor.php">Doctos </a></li>
											<li><a href="session.php">Session</a></li>
											<li><a href="mysession.php">My Appointments</a></li>
											<li><a href="article.php">Article </a></li>
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
							<div class="get-quote col-2">
								<a href="profile.php" class="btn"><i class="icofont icofont-doctor"></i>  <?php echo $_SESSION['name'];?></a>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>