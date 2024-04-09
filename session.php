<?php
session_start();    
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";
$_SESSION['Message'] = "";
$_SESSION['ERROR'] = "";
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
		 	require "Import/PreLoader.php";
			require "Import/navbar.php";
		?>
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Session</h2>
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
			require "php/connection.php";
			if($_GET){
				$id=$_GET["id"];
				$action=$_GET["action"];
				if($action=='view')
				{
					// $query = "select * from schedule where doc_id = '$id' ";
					$query = "select * from schedule inner join doctor on schedule.doc_id=doctor.doc_id where schedule.sche_date >= '$today' and  schedule.doc_id = '$id' and schedule.sche_id not in(select sche_id from schedule where sche_date = '$today' and sche_end < '$time')";
					$result= $database->query($query);
				}
				elseif($action == 'date'){
					$query = "select * from schedule inner join doctor on schedule.doc_id=doctor.doc_id where schedule.sche_date >= '$today' and schedule.sche_date = '$id' and schedule.sche_id not in(select sche_id from schedule where sche_date = '$today' and sche_end < '$time')";
					$result= $database->query($query);
				}
				else
				{
					$query = "select * from schedule inner join doctor on schedule.doc_id=doctor.doc_id where schedule.sche_date >= '$today' and schedule.sche_id not in(select sche_id from schedule where sche_date = '$today' and sche_end < '$time')";
					$result= $database->query($query);	
				}
			}
			else
			{
				$query = "select * from schedule inner join doctor on schedule.doc_id=doctor.doc_id where schedule.sche_date >= '$today' and schedule.sche_id not in(select sche_id from schedule where sche_date = '$today' and sche_end < '$time')";
				$result= $database->query($query);	
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
								$docid=$row["doc_id"];
								$title=$row["sche_title"];
								$date=$row['sche_date'];
								$start=$row['sche_start'];
								$end=$row['sche_end'];
								$booking=$row['sche_noappo'];

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


								$query="select * from appointment where sche_id = '$scheid'";
								$empty=$database->query($query);	
								$totapo=$empty->num_rows;
								$space = $booking - $totapo;

					?>
					<div class="col-lg-12 col-md-12 col-12" style="margin-top:30px;">
						<div class="single-news">
							<div class="row">
								<img src="img/Doctor/<?php echo $img; ?>" alt="#" class="squre col-lg-3 col-md-3" style="border-radius:50%;">
								<!-- padding:20px 30px; margin:30px 0 0 10px;  -->
                                <a href="doctordetail.php?action=view&id=<?php echo $docid;?>" class="col-lg-6 col-md-12" style="padding:30px;">
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
										if($space > 0)
										{
											if(date('w', strtotime($date)) != 0)
											{
													echo 
													'
														<p class="col-2 book" style="margin-bottom:30px;"><a href="login.php" >Book</a></p>
													';
													//style="color:white; padding:20px 30px;"
											}
											else
											{
													echo 
													'
													<p class="col-2 bookg" style="margin-bottom:30px;"><a href="login.php">Free</a></p>
													';
											}   
										}
										else
										{
											echo 
											'
												<p class="col-2 bookr" style="margin-bottom:30px;"><a>Session Full</a></p>
											';
										}
                                ?>
							</div>
						</div>
					</div>
					<?php 
							}
						}
						else
						{
							echo '<div style="font-size:50px; margin-left:300px;">Session Session Not Available !</div>';
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