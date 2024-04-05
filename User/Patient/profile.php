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
							<h2>Profile</h2>
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
									<form class="form" method="post" action="php/updateprofile.php" enctype="multipart/form-data">
									<center>
									<img src="../../img/Patient/<?php echo $img; ?>" class="col-lg-2 col-4" style="border-radius:50%;">
									<br>
									<label for="file-upload" class="custom-file-upload">
									        Change Profile 
									    </label>
									<input id="file-upload" type="file" name="img" value="<?php echo $img;?>"/>
									</center>
									<br><br><br>
										<div class="row">
											<div class="form-group col-lg-6">
												Name<input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
											</div>
											<div class="form-group col-lg-6">
												Email<input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-lg-6">
												Gender<select name="gender">
													<option <?php if($gender == "Male") {echo "selected";}?> value="Male">Male</option>
													<option <?php if($gender == "Female") {echo "selected";}?> value="Female">Female</option>
												</select>
											</div>
											<div class="form-group col-lg-6">
												Address<input type="text" name="address" placeholder="address" value="<?php echo $address; ?>" required>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-lg-6">
												Date Of Birth 
												<input type="date" name="dob" value="<?php echo $dob; ?>">
											</div>
											<div class="form-group col-lg-6">
												Phone no
												<input type="text" name="phoneno" placeholder="address" value="<?php echo $phoneno; ?>" required>
											</div>
										</div>
										<br>
										<br>
										<div class="row">
											<div class="col-12">
												<div class="form-group button">	
												<center>
													<button type="submit" class="btn primary" name="profile">Update</button>
													<a href="password.php" type="submit" class="btn primary" name="update">Change Password</a>
												</center>
												</div>
											</div>
										</div>
										<center>
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