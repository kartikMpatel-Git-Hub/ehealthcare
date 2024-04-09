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
		<?php
			require "../../php/connection.php";
			$query= $database->query("select * from patient  where patient_email='$useremail'");
			$ans= $query->fetch_assoc();
			$userid=$ans["patient_id"];
			if($_GET){
				$id=$_GET["id"];
				$action=$_GET["action"];
				if($action=='view')
				{
					$query = "select * from article where article_id = '$id'";
					$result= $database->query($query);
				}
				else
				{
					?>
						<script>window.location.href='article.php';</script>
					<?php
				}
			}
			else
			{
				$query = "select * from article where article_id=3";
				$result= $database->query($query);	
			}
			$row=$result->fetch_assoc();
            $aid = $row['article_id'];
            $docid=$row["doc_id"];
            $title=$row["article_title"];
            $desc=$row['article_description'];
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

			$sql="update article set article_view = article_view + 1 where article_id = '$aid'";
       		$result1= $database->query($sql);
		?>
		<section class="news-single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-12">
						<div class="row">
							<div class="col-12">
								<div class="single-main">
									<div class="news-head">
										<img src="../../img/Article/<?php echo $img;?>" alt="#">
									</div>
									<h1 class="news-title"><?php echo $title;?></h1>
									<div class="meta">
										<div class="meta-left">
											<span class="author"><a href="#"><img src="../../img/Doctor/<?php echo $doc_img;?>" alt="#"><?php echo $doc_name;?></a></span>
											<span class="date"><i class="fa fa-clock-o"></i><?php echo $date; ?></span>
										</div>
										<div class="meta-right">
											<span class="comments"><a href="#"><i class="fa fa-comments"></i><?php echo $cmt; ?></a></span>
											<span class="views"><i class="fa fa-eye"></i><?php echo $view; ?> Views</span>
										</div>
									</div>
									<div class="news-text">
										<p><?php echo $desc;?></p>
									</div>
									
								</div>
							</div>
							<?php
								$query = "select * from comment where article_id=$aid";
								$result= $database->query($query);
							?>
							<div class="col-12">
								<div class="blog-comments">
									<h2>All Comments</h2>
										<?php
											if($result->num_rows)
											{
												for ($x=0; $x<$result->num_rows;$x++)
												{
													$row=$result->fetch_assoc();
													$cid=$row['cmt_id'];
													$pid = $row['patient_id'];
													$date = $row['cmt_date'];
													$time = $row['cmt_time'];
													$des = $row['cmt_detail'];
													$query1 = "select * from patient where patient_id='$pid'";
													$result1= $database->query($query1);
													$row1=$result1->fetch_assoc();
													$name = $row1['patient_name'];
													$email = $row1['patient_email'];
													$pimg = $row1['patient_img'];
										?>
										<div class="comments-body" style="margin-top:30px;">
											<div class="single-comments">
												<div class="main">
													<div class="head">
														<img src="../../img/Patient/<?php echo $pimg;?>" alt="#"/>
													</div>
													<div class="body">
														<h4><?php if($useremail == $email){echo "You";} else{ echo $name; }?></h4>
														<div class="comment-meta"><span class="meta"><i class="fa fa-calendar"></i><?php echo $date;?></span><span class="meta"><i class="fa fa-clock-o"></i><?php echo $time;?></span><?php if($pid == $userid) { ?><span class="meta"><a href="php/comment.php?action=delete&id=<?php echo $cid;?>" class="fa fa-trash" style="background-color:white; color:black;"></a></span><?php } ?></div>
														<p><?php echo $des; ?></p>
													</div>
												</div>
											</div>		
										</div>
										<p style="font-size:5px;">_________________________________________________________________________________________________________________________________________________________________________________________</p>
										<?php
												}
											}
										?>
								</div>
							</div>
							<div class="col-12">
								<div class="comments-form">
									<h2>Leave Comments</h2>
									<form class="form" method="post" action="php/comment.php?action=add&id=<?php echo $aid;?>">
										<div class="row">
											<div class="col-12">
												<div class="form-group message">
													<i class="fa fa-pencil"></i>
													<textarea name="message" rows="7" placeholder="Type Your Message Here" required></textarea>
												</div>
											</div>
											<div class="col-12">
												<div class="form-group button">	
												<button type="submit" class="btn primary"><i class="fa fa-send"></i>Submit Comment</button>
												</div>
											</div>
										</div>
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