<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <!-- Meta Tags -->
		<?php
			require "ImportFile/Head.php";
		?>
    </head>
    <body>
		<?php
		 	require "Section/PreLoader.php";
			require "Section/navbar.php";
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
					$query = "select * from schedule where doc_id = '$id'";
					$result= $database->query($query);
				}
				else
				{
					?>
						<script>window.location.href='specialist.php';</script>
					<?php
				}
			}
			else
			{
				$query = "select * from schedule";
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
								$docid=$row["doc_id"];
								$title=$row["sche_title"];
								$date=$row['sche_date'];
								$start=$row['sche_start'];
								$end=$row['sche_end'];

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
                                
					?>
					<div class="col-lg-12 col-md-6 col-12" style="margin-top:30px;">
						<div class="single-news">
							<div class="row">
								<img src="User/Doctor/img/<?php echo $img; ?>" alt="#" class="squre col-3" style="padding:20px; margin-left:10px; border-radius:50%;">
                                <a href="doctor.php" class="col-6" style="padding:30px;">
                                    <div style="padding-top:30px;">
                                            <div class="detail" style="color:#199fd9;"><b>D</b><?php echo 'r . '.$name; ?></div>
                                            <div class="detail" style="font-weight:bold;"><?php echo $spcil_name; ?></div>
                                            <p   class="detail" style="font-weight:bold; color:#199fd9;"><?php echo $title; ?></p>
                                            <p   class="detail" ><?php echo $address; ?></p>
                                            <p   class="detail" ><?php echo $date; ?></p>
                                            <p   class="detail" ><?php echo $start.' To '.$end; ?> </p>
                                            <p   class="detail" >₹<?php echo $charge;?> Consultation fee at clinic</p>
                                    </div>
                                </a>
                                
                                <?php
                                    if(date('w', strtotime($date)))
                                    {
                                        echo 
                                        '
                                            <p class="col-2 book" ><a href="login.php" style="color:white; padding:20px 60px;">Book</a></p>
                                        ';
                                    }
                                    else
                                    {
                                        echo '<p class="col-2 bookg" ><a href="login.php" style="color:white; background-color:green; padding:20px 60px;">Book Free</a></p>';
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
							$spcil_res= $database->query("select spec_type from specialist  where spec_id='$id'");
							$spcil_array= $spcil_res->fetch_assoc();
							$spcil_name=$spcil_array["spec_type"];
							echo '<div style="font-size:50px; margin-left:300px;">'.$spcil_name.' Not Available !</div>';
						} 
					?>
				</div>
			</section>
		<!-- End Portfolio Details Area -->
		
		<?php  
			require "Section/Footer.php";
			require "ImportFile/Javascript.php";
		?>
    </body>
</html>