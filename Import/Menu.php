<section class="schedule">
			<div class="container">
				<div class="schedule-inner">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-12 ">
							<!-- single-schedule -->
							<div class="single-schedule first">
								<div class="inner">
									<div class="icon">
										<i class="fa fa-ambulance"></i>
									</div>
									<div class="single-content">
										<h4>Available Specialist</h4>
										<p>Click TO Check All Specialist list</p>
										<a href="specialist.php">Click Here<i class="fa fa-long-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-12">
							<!-- single-schedule -->
							<div class="single-schedule middle">
								<div class="inner">
									<div class="icon">
										<i class="icofont-prescription"></i>
									</div>
									<div class="single-content">
										<span>Doctor's Details</span>	
										<h4>View All Doctor Details</h4>
										<p>Click Here TO Check All Doctor Available In System..</p>
										<a href="doctor.php">View Doctor<i class="fa fa-long-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div><?php
							$sunday = date("Y-m-d" , strtotime("sunday this week"));
						?>
						<div class="col-lg-4 col-md-12 col-12">
							<!-- single-schedule -->
							<div class="single-schedule last">
								<div class="inner">
									<div class="icon">
										<i class="icofont-ui-clock"></i>
									</div>
									<div class="single-content">
										<span>Free Session</span>
										<h4>On Every Sunday</h4>
										<ul class="time-sidual">
											<li class="day">Next Free Session on :<span><?php echo $sunday; ?></span></li>
										</ul>
										<a href="session.php?action=date&id=<?php echo $sunday; ?>">Click Here to View All Session<i class="fa fa-long-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>