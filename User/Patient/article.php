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
			require "Import/PreLoader.php";
			require "Import/navbar.php";
		?>
		<!-- Breadcrumbs -->
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Doctor Article</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
		<?php
			require "php/connection.php";
			if($_GET){
				$id=$_GET["id"];
				$action=$_GET["action"];
				if($action=='view')
				{
					$query = "select * from article where doc_id = '$id'";
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
				$query = "select * from article";
				$result= $database->query($query);	
			}
		?>
		<!-- Single News -->
		<section class="news-single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-12">
                        <?php
                            if($result->num_rows)
                            {
                                for ($x=0; $x<$result->num_rows;$x++)
                                {
                                    $row=$result->fetch_assoc();
                                    $aid = $row['article_id'];
                                    $docid=$row["doc_id"];
                                    $title=$row["article_title"];
                                    $desc=$row['article_description'];
                                    $desc = substr($desc, 0, 50);
                                    $date=$row['article_date'];
                                    $img=$row['article_img'];
                                    $view=$row['article_view'];
                                
                                    $query= $database->query("select * from doctor  where doc_id='$docid'");
                                    $ans= $query->fetch_assoc();
                                    $doc_name=$ans["doc_name"];
                                    $doc_img=$ans["doc_img"];
                                
                                    $query = "select * from comment where article_id = '$aid'";
                                    $result1= $database->query($query);	
                                    $cmt=$result1->num_rows;
                        ?>
						<div class="row">
							<div class="col-12">
								<div class="single-main">
									<!-- News Head -->
									<div class="news-head">
										<img src="../../img/Article/<?php echo $img;?>" alt="#">
									</div>
									<!-- News Title -->
									<h1 class="news-title"><a href="singlearticle.php?action=view&id=<?php echo $aid;?>"><?php echo $title;?></a></h1>
									<!-- Meta -->
									<div class="meta">
										<div class="meta-left">
											<span class="author"><a href="#"><img src="../../img/Doctor/<?php echo $doc_img;?>" alt="#"><?php echo $doc_name;?></a></span>
											<span class="date"><i class="fa fa-clock-o"></i><?php echo $date; ?></span>
										</div>
										<div class="meta-right">
											<span class="comments"><a href="#"><i class="fa fa-comments"></i><?php echo $cmt;?></a></span>
											<span class="views"><i class="fa fa-eye"></i><?php echo $view; ?> Views</span>
										</div>
									</div>
									<!-- News Text -->
									<div class="news-text">
										<p><?php echo $desc;?>...</p>
									</div>
									
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
					<div class="col-lg-4 col-12">
						<div class="main-sidebar">
							<div class="single-widget search">
								<div class="form">
									<input type="email" placeholder="Search Here...">
									<a class="button" href="#"><i class="fa fa-search"></i></a>
								</div>
							</div>
							<div class="single-widget category">
								<h3 class="title">Other Publisher's Blog</h3>
								<ul class="categor-list">
									<?php
										$query = "select DISTINCT  doctor.doc_id from doctor,article where doctor.doc_id = article.doc_id";
										$result= $database->query($query);
										if($result->num_rows)
										{
											for ($x=0; $x<$result->num_rows;$x++)
											{
												$row=$result->fetch_assoc();
												$did = $row['doc_id'];
												$query= $database->query("select * from doctor  where doc_id='$did'");
    											$ans= $query->fetch_assoc();
    											$doc_name=$ans["doc_name"];

									?>
										<li><a href="?action=view&id=<?php echo $did; ?>"><?php echo $doc_name;?></a></li>
									<?php
											}
										}
									?>
								</ul>

							</div>
							<div class="single-widget recent-post">
								<h3 class="title">Recent post</h3>
								<?php 
									$query = "select * from article";
    								$result= $database->query($query);
    								if($result->num_rows)
    								{
    								    for ($x=0; $x<$result->num_rows;$x++)
    								    {
    								        $row=$result->fetch_assoc();
    								    }
										$aid = $row['article_id'];
										$title = $row['article_title'];
										$img = $row['article_img'];
										$date = $row['article_date'];
										$view = $row['article_view'];
								?>
								<div class="single-post">
									<div class="image">
										<img src="../../img/Article/<?php echo $img; ?>" alt="#">
									</div>
									<div class="content">
										<h5><a href="singlearticle.php?action=view&id=<?php echo $aid;?>"><?php echo $title;?></a></h5>
										<ul class="comment">
											<li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $date; ?></li>
											<li><i class="fa fa-eye" aria-hidden="true"></i><?php echo $view; ?></li>
										</ul>
									</div>
								</div>
								<?php
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</section>
		<!--/ End Single News -->
		<?php  
			require "Import/Footer.php";
			require "Import/Javascript.php";
		?>
		<!--/ End Footer Area -->
		
    </body>
</html>