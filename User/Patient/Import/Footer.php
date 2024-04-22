<?php
	$time = date("H:i:s");
	$today = date('Y-m-d');
	?>
	
	<footer id="footer" class="footer ">
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Social Media</h2>
								<ul class="social">
									<li><a href="#"><i class="icofont-facebook"></i></a></li>
									<li><a href="#"><i class="icofont-google-plus"></i></a></li>
									<li><a href="#"><i class="icofont-twitter"></i></a></li>
									<li><a href="#"><i class="icofont-vimeo"></i></a></li>
									<li><a href="#"><i class="icofont-pinterest"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer f-link">
								<h2>Quick Links</h2>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="index.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
											<li><a href="doctor.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Doctor</a></li>
											<li><a href="specialist.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Specialist</a></li>
											<li><a href="session.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Sessions</a></li>
											<li><a href="article.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Article</a></li>	
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
							$query = "select * from schedule inner join doctor on schedule.doc_id=doctor.doc_id where schedule.sche_date >= '$today' and schedule.sche_id not in(select sche_id from schedule where sche_date = '$today' and sche_end < '$time')";
							$result= $database->query($query);	
						?>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Session</h2>
								<p>Here Are Next Schedule</p>
								<?php  
									for($x=0; $x<$result->num_rows;$x++)
									{
										$row=$result->fetch_assoc();
										$title=$row["sche_title"];
										$date=$row['sche_date'];
										$start=$row['sche_start'];
										$end=$row['sche_end'];
								?>
								<ul class="time-sidual">
									<li class="day"><?php echo $title; ?><span><?php echo $start." - ".$end;?></span></li>
								</ul>
								<?php }?>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Article</h2>
								<p>Check Out Our New Article For Better Health Care Advice On Health Topic </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="copyright-content">
								<p>© Copyright 2024  |  All Rights Reserved</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>