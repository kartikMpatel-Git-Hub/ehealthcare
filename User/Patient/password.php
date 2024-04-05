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
        <?php 
			require "Import/Head.php";
			?>
    </head>
    <body>
		
		<?php 
			// require "Import/PreLoader.php";
			require "Import/navbar.php";

			require "php/connection.php";
			$query= $database->query("select * from patient  where patient_email='$useremail'");
			$ans= $query->fetch_assoc();
			$id=$ans["patient_id"];
			$name=$ans["patient_name"];
			$email=$ans["patient_email"];
			$gender=$ans["patient_gender"];
			$address=$ans["patient_address"];
			$dob=$ans["patient_dob"];
			$phoneno=$ans["patient_phoneno"];
			$img=$ans["patient_img"];
		?>
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Change Password</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			require "php/connection.php";
		?>
		<section class="news-single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-12">
						<div class="row">
							<div class="col-12">
								<div class="comments-form">
									<form class="form" method="post" action="php/updateprofile.php">
                                        <br><br>
                                        <div class="row">
                                            <div class="form-group col-lg-3">
											</div>
											<div class="form-group col-lg-6">
												<input type="text" name="old" placeholder="Old Password" required>
											</div>
                                            <div class="form-group col-lg-3">
											</div>
										</div>
                                        <br><br>
                                        <div class="row">
                                            <div class="form-group col-lg-3">
											</div>
											<div class="form-group col-lg-6">
												<input type="password" name="new" placeholder="New Password" required>
											</div>
                                            <div class="form-group col-lg-3">
											</div>
										</div>
                                        <br><br>
										<div class="row">
                                            <div class="form-group col-lg-3">
											</div>
											<div class="form-group col-lg-6">
												<input type="password" name="renew" placeholder="Re-Enter Password" required>
											</div>
                                            <div class="form-group col-lg-3">
											</div>
										</div>
                                        <br><br>
										<div class="row">
											<div class="col-12">
												<div class="form-group button">	
												<center>
													<button type="submit" class="btn primary" name="password">Update</button>
													<a href="profile.php" type="submit" class="btn primary" name="update">Back To Profile</a>
												</center>
												</div>
											</div>
										</div>
										<center>
                                        <br>
										<div style="color:red;">
											<?php
												 echo $_SESSION['ERROR'];
												 $_SESSION['ERROR'] = "";
											?>
										</div>
										</center>
									</form>
								</div>
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