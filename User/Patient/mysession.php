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

?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <!-- Meta Tags -->
		<?php
			require "Import/Head.php";
		?>
    </head>
    <body>
		<?php
		 	// require "Import/PreLoader.php";
			require "Import/navbar.php";
		?>
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>My Appointment</h2>
							<ul class="bread-list">
								<li><a href="index.html">Home</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active">Doctors session</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			require "../../php/connection.php";
			$query= $database->query("select * from patient  where patient_email='$useremail'");
			$ans= $query->fetch_assoc();
			$pid=$ans["patient_id"];
			if($_GET){
				$id=$_GET["id"];
				$action=$_GET["action"];
				if($action=='view')
				{
					$query = "select * from appointment where appo_status != 0 and patient_id = $pid and sche_id = $id and sche_id not in(select sche_id from schedule where sche_date = '$today' and sche_end < '$time')";
					$result= $database->query($query);
					$queryy = "select * from appointment where appo_status != 0 and patient_id = $pid and sche_id in(select sche_id from schedule where sche_date <= '$today' and  sche_id not in(select sche_id from schedule where sche_date = '$today' and sche_end > '$time'))";
					$resultt= $database->query($queryy);
				}
				else
				{
					?>
						<script>window.location.href='session.php?action=view&id=<?php echo $id;?>';</script>
					<?php
				}
			}
			else
			{
				$query = "select * from appointment where appo_status != 0 and patient_id = $pid and sche_id in(select sche_id from schedule where sche_date >= '$today' and sche_id not in(select sche_id from schedule where sche_date = '$today' and sche_end < '$time'))";
				$result= $database->query($query);	
				
				$queryy = "select * from appointment where appo_status != 0 and patient_id = $pid and sche_id in(select sche_id from schedule where sche_date <= '$today' and  sche_id not in(select sche_id from schedule where sche_date = '$today' and sche_end > '$time'))";
				$resultt= $database->query($queryy);	
			}
			
		?>
		<!-- Start Portfolio Details Area -->
			<section class="blog section">
				<div class="row" style="width:90%; padding-left:15%;">
					<?php
						if($result->num_rows)
						{
							for ($x=0; $x<$result->num_rows;$x++)
							{
								$row=$result->fetch_assoc();
								$scheid=$row['sche_id'];
								$appoid=$row['appo_id'];
								$appo_no=$row['appo_no'];
								$appo_date=$row['appo_date'];

								$query = "select * from schedule where sche_id = $scheid";
								$result1= $database->query($query);	
								$row1=$result1->fetch_assoc();



								$docid=$row1["doc_id"];
								$title=$row1["sche_title"];
								$date=$row1['sche_date'];
								$start=$row1['sche_start'];
								$end=$row1['sche_end'];

                                $query= $database->query("select * from doctor where doc_id='$docid'");
								$doc= $query->fetch_assoc();
								$name=$doc["doc_name"];
								$spe=$doc["spec_id"];
								$address=$doc['doc_address'];
                                $img=$doc['doc_img'];
                                $charge=$doc['doc_charge'];
                                // echo getWeekday($date); 
								$spcil_res= $database->query("select spec_type from specialist  where spec_id='$spe'");
								$spcil_array= $spcil_res->fetch_assoc();
								$spcil_name=$spcil_array["spec_type"];

								$query= $database->query("select * from transaction where appo_id = $appoid");
								$row= $query->fetch_assoc();
								$tid=$row["tra_id"];
					?>
					<div class="col-lg-12 col-md-6 col-12" style="margin-top:30px;">
						<div class="single-news">
							<div class="row">
								<img src="../../img/Doctor/<?php echo $img; ?>" alt="#" class="squre col-lg-3 col-md-12" style="border-radius:50%;">
								<!-- padding:20px 30px; margin:30px 0 0 10px;  -->
                                <a href="doctordetail.php?action=view&id=<?php echo $docid;?>" class="col-lg-8 col-md-12" style="padding:30px;">
                                    <div>
                                            <div class="detail" style="color:#199fd9;"><b>D</b><?php echo 'r . '.$name; ?></div>
                                            <div class="detail" style="font-weight:bold;"><?php echo $spcil_name; ?></div>
                                            <p   class="detail" style="font-weight:bold; color:#199fd9;"><?php echo $title; ?></p>
                                            <p   class="detail" style=" word-wrap: break-word;"><?php echo $address; ?></p>
                                            <p   class="detail" ><?php echo $date; ?></p>
                                            <p   class="detail" ><?php echo $start.' To '.$end; ?> </p>
                                            <p   class="detail" >₹<?php echo $charge;?> Consultation fee at clinic</p>
                                    </div>
                                </a>
                                
                                <?php
									echo 
										'
											<div class="col-4"></div>
											<a href="php/booking.php?action=delete&id='.$appoid.'&tid='.$tid.'" class="col-4 btn" style="margin-bottom:30px; color:white;  background-color:#e13e3e;">cancle</a>
										';
                                ?>
							</div>
						</div>
					</div>
					<?php 
							}
						}
						else
						{
							echo '<div class="col-lg-12" style="font-size:30px; text-align:center; font-weight:bold; ">You Have No Appointments</div>';
						}
					?>
				</div>
			</section>

			<section class="blog section">
				<div class="row" style="width:90%; padding-left:15%;">
					<?php
						if($resultt->num_rows)
						{
							for ($x=0; $x<$resultt->num_rows;$x++)
							{
								$row=$resultt->fetch_assoc();
								$scheid=$row['sche_id'];
								$appoid=$row['appo_id'];

								$feed = "select * from feedback where appo_id = $appoid";
								$feedstatus = $database->query($feed);

								if($feedstatus->num_rows)
								{
									
								}
								else
								{ 

									$appo_no=$row['appo_no'];
									$appo_date=$row['appo_date'];

									$query = "select * from schedule where sche_id = $scheid";
									$result1= $database->query($query);	
									$row1=$result1->fetch_assoc();

									$docid=$row1["doc_id"];
									$title=$row1["sche_title"];
									$date=$row1['sche_date'];
									$start=$row1['sche_start'];
									$end=$row1['sche_end'];

                                	$query= $database->query("select * from doctor where doc_id='$docid'");
									$doc= $query->fetch_assoc();
									$name=$doc["doc_name"];
									$spe=$doc["spec_id"];
									$address=$doc['doc_address'];
                                	$img=$doc['doc_img'];
                                	$charge=$doc['doc_charge'];
                                	// echo getWeekday($date); 
									$spcil_res= $database->query("select spec_type from specialist  where spec_id='$spe'");
									$spcil_array= $spcil_res->fetch_assoc();
									$spcil_name=$spcil_array["spec_type"];

									$query= $database->query("select * from transaction where appo_id = $appoid");
									$row= $query->fetch_assoc();
									$tid=$row["tra_id"];

									?>
									
										<div class="col-lg-12 col-md-6 col-12" style="margin-top:30px;">
											<div class="single-news">
												<div class="row">
													<img src="../../img/Doctor/<?php echo $img; ?>" alt="#" class="squre col-lg-3 col-md-12" style="border-radius:50%;">
													<!-- padding:20px 30px; margin:30px 0 0 10px;  -->
                    					            <a href="doctordetail.php?action=view&id=<?php echo $docid;?>" class="col-lg-8 col-md-12" style="padding:30px;">
                    					                <div>
                    					                        <div class="detail" style="color:#199fd9;"><b>D</b><?php echo 'r . '.$name; ?></div>
                    					                        <div class="detail" style="font-weight:bold;"><?php echo $spcil_name; ?></div>
                    					                        <p   class="detail" style="font-weight:bold; color:#199fd9;"><?php echo $title; ?></p>
                    					                        <p   class="detail" style=" word-wrap: break-word;"><?php echo $address; ?></p>
                    					                        <p   class="detail" ><?php echo $date; ?></p>
                    					                        <p   class="detail" ><?php echo $start.' To '.$end; ?> </p>
                    					                        <p   class="detail" >₹<?php echo $charge;?> Consultation fee at clinic</p>
                    					                </div>
                    					            </a>

                    					            <?php
														echo 
															'
																<div class="col-4"></div>	
																<a href="feedback.php?action=feedback&id='.$appoid.'" class="col-4 btn" style="margin-bottom:30px; color:white;  background-color:gray;">Feedback</a>
															';
                    					            ?>
												</div>
											</div>
										</div>

									<?php
								}
					?>
					
					<?php 
							}
						}
					?>
				</div>
			</section>
		<!-- End Portfolio Details Area -->
		
		<?php  
			require "Import/Footer.php";
			require "Import/Javascript.php";
		?>
    </body>
</html>