<!doctype html>
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
	
	date_default_timezone_set('Asia/Kolkata');
	
	$time = date("H:i:s");
	$today = date('Y-m-d');
	if($_GET){
		$aid=$_GET["id"];
		$action=$_GET["action"];
		if($action=='feedback')
		{
			require "../../php/connection.php";
			$query= $database->query("select * from appointment where appo_id='$aid'");
			$ans= $query->fetch_assoc();
			$scheid=$ans["sche_id"];

			$query= $database->query("select * from patient where patient_email='$useremail'");
			$ans= $query->fetch_assoc();
			$p_name=$ans["patient_name"];
			$p_no=$ans["patient_phoneno"];
		}
		else
		{
			?>
				<script>window.location.href='mysession.php';</script>
			<?php
		}
	}
	else
	{
		?>
			<script>window.location.href='mysession.php';</script>
		<?php
	}

?>
<html class="no-js" lang="zxx">
    <head>
        <!-- Meta Tags -->
		<?php  
			require "Import/Head.php";
		?>
		<link rel="stylesheet" href="../../css/star.css">
    </head>
    <body>
	
		<!-- Preloader -->
        <?php 
			// require "Import/PreLoader.php";
			require "Import/navbar.php";
		?>
		<!-- End Header Area -->
	
		<!-- Breadcrumbs -->
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Contact Us</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Start Contact Us -->
		<section class="contact-us section">
			<div class="container">
				<div class="inner">
					<div class="row"> 
						
						<div class="col-lg-2"></div>
						<div class="col-lg-8">
							<div class="contact-us-form">
								<h2>Feedback</h2>
								<p>Share Your Feedback About Your Previous Session.</p>
								<!-- Form -->
								<form class="form" method="post" action="php/addfeedback.php">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<input type="text" name="name" placeholder="Name" value="<?php echo $p_name;?>" required disabled>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<input type="email" name="email" placeholder="Email" value="<?php echo $useremail;?>" required disabled>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<input type="text" name="phone" placeholder="Phone" value="<?php echo $p_no;?>" required disabled>
												<input type="hidden" name="appoid" placeholder="appoid" value="<?php echo $aid;?>" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
											<select name="sche_id" style="border-radius: 5px;width: 100%;height: 60px;border:1px solid #eee" >
                                                        <?php
                                                                $list = $database->query("select  * from  schedule where sche_id = $scheid;");
                                                                for ($y=0;$y<$list->num_rows;$y++)
                                                                {
                                                                    $row=$list->fetch_assoc();
                                                                    $sn=$row["sche_title"];
                                                                    $id=$row["sche_id"];?>
                                                        <option value="<?php echo $id; ?>" style="text-align:center;" ><?php echo $sn; ?></option><br/>
                                                        <?php
                                                                }
                                                        ?>
                                            </select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<textarea name="message" placeholder="Your Message" required></textarea>
											</div>
										</div>
										<div class="col-lg-12" style="font-size:30px;">
											<div class="stars" data-rating="0">
												<span class="star" data-value="1"><input type="hidden" name="rating" value="1">&#9733;</span>
												<span class="star" data-value="2"><input type="hidden" name="rating" value="2">&#9733;</span>
												<span class="star" data-value="3"><input type="hidden" name="rating" value="3">&#9733;</span>
												<span class="star" data-value="4"><input type="hidden" name="rating" value="4">&#9733;</span>
												<span class="star" data-value="5"><input type="hidden" name="rating" value="5">&#9733;</span>
											</div>
											<div id="rating-message"></div>
											<script src="../../js/star.js"></script>
										</div>
										<div class="col-12" style="margin-top:50px;">
											<div class="form-group login-btn">
												<button class="btn" type="submit" value="Add Feedback">Add Feedback<button>
											</div>
										</div>
									</div>
								</form>
								<!--/ End Form -->
							</div>
						</div>
					</div>
				</div>
		</section>
		<!--/ End Contact Us -->
		
		<!-- Footer Area -->
		<?php 
			require "Import/Footer.php";
			require "Import/Javascript.php";
		?>
    </body>
</html>