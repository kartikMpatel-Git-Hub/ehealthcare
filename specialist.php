

<!doctype html>
<html class="no-js" lang="zxx">
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
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
							<h2>Doctor</h2>
							<ul class="bread-list">
								<li><a href="index.html">Home</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active">All Doctors</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="width:90%; padding:50px 0 50px 10%;">
            <?php
                require "php/connection.php";

                $query = "select * from specialist";
                $result= $database->query($query);

                for ($x=0; $x<$result->num_rows;$x++)
				{
					$row=$result->fetch_assoc();
					$spe=$row['spec_id'];
					$spcil_res= $database->query("select spec_type from specialist  where spec_id='$spe'");
					$spcil_array= $spcil_res->fetch_assoc();
					$spcil_name=$spcil_array["spec_type"];
            ?>
            <div class="col-lg-3 col-md-4 col-12" style="padding:30px;">
                <div class="single-news">
                    <a href="doctor.php?action=view&id=<?php echo $spe; ?>">
                        <div class="news-head">
                            <center>
                                <i class="menu-btn menu-icon-<?php echo $spcil_name;?>" style="font-size:50px; margin-top:10px;"></i>
                            </center>
                        </div>
                        <div class="news-body">
                            <div class="news-content">
                                <center>
                                    <div class="date" style="color:black; padding:30px;"><?php echo $spcil_name;?></div>
                                </center>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php }?>
            <div class="col-lg-3 col-md-4 col-12" style="padding:30px;">
                <div class="single-news">
                    <a href="doctor.php">
                        <div class="news-head">
                            <center>
                                <i class="menu-btn menu-icon-Other" style="font-size:50px; margin-top:10px;"></i>
                            </center>
                        </div>
                        <div class="news-body">
                            <div class="news-content">
                                <center>
                                    <div class="date" style="color:black; padding:30px;">Other specialist</div>
                                </center>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php  
			require "Section/Footer.php";
			require "ImportFile/Javascript.php";
		?>
    </body>
</html>