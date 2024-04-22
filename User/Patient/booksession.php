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
			require "../../php/connection.php";
			if($_GET){
				$action=$_GET["action"];
				$id=$_GET["id"];
				if($action=='book')
				{
					$query = "select * from schedule where sche_id = $id";
					$result= $database->query($query);
				}
			}
			else
			{
                header('location: session.php');
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

								$query= $database->query("select * from patient where patient_email='$useremail'");
								$patient= $query->fetch_assoc();
								$pid=$patient["patient_id"];

								$query="select * from appointment where sche_id = '$scheid' and patient_id = '$pid'";
								$empty=$database->query($query);	
								$status=$empty->num_rows;

					?>
					<div class="col-lg-12 col-md-6 col-12" style="margin-top:30px;">
						<div class="single-news">
							<div class="row">
								<img src="../../img/Doctor/<?php echo $img; ?>" alt="#" class="squre col-lg-4 col-md-12" style="border-radius:50%;">
								<!-- padding:20px 30px; margin:30px 0 0 10px;  -->
								<div class="row">
                                	<a href="doctordetail.php?action=view&id=<?php echo $docid;?>" class="col-lg-6 col-md-12" style="padding:30px;">
                                	    <div>
                                	            <div class="detail" style="color:#199fd9;"><b>D</b><?php echo 'r . '.$name; ?></div>
                                	            <div class="detail" style="font-weight:bold;"><?php echo $spcil_name; ?></div>
                                	            <p   class="detail" style="font-weight:bold; color:#199fd9;"><?php echo $title; ?></p>
                                	            <p   class="detail" style=" word-wrap: break-word;"><?php echo $address; ?></p>
                                	            <p   class="detail" ><?php echo $date; ?></p>
                                	            <p   class="detail" ><?php echo $start.' To '.$end; ?> </p>
                                	            <p   class="detail" >₹<?php echo $charge;?> Consultation fee at clinic</p>
												<input type="hidden" class="form-control" name="payAmount" id="payAmount" value="<?php echo $charge;?>"disabled>
												<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $scheid;?>"disabled>

                                	    </div>
                                	</a>
								
									<button  id="PayNow" class="col-10 btn" style="margin-bottom:30px;">Charge ₹<?php echo $charge;?></button>
								</div>			
							</div>
						</div>
					</div>
					<?php 
							}
						}
						else
						{
							// $query= $database->query("select * from doctor  where doc_id='$id'");
							// $result= $query->fetch_assoc();
							// $docname=$result["doc_name"];
							echo '<div style="font-size:50px; margin-left:300px;">Session Not Available !</div>' ;
						} 
					?>
				</div>
			</section>
		<!-- End Portfolio Details Area -->
		
		<?php  
			require "Import/Footer.php";
			require "Import/Javascript.php";
		?>


<!-- Payment Getway -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
   
jQuery(document).ready(function($)
{
    jQuery('#PayNow').click(function(e)
    {
	    var paymentOption='';
        var paymentOption= "netbanking";
        var payAmount = $('#payAmount').val();
        var id = $('#id').val();
        var request_url="Payment/payment.php";
	    var formData = 
        {
	    	paymentOption:paymentOption,
	    	payAmount:payAmount,
	    	action:'payOrder'
	    }
    
	    $.ajax({type: 'POST',url:request_url,data:formData,dataType: 'json',encode:true,}).done(function(data)
        {
        
	    	if(data.res=='success')
            {
	    			var orderID=data.order_number;
	    			var orderNumber=data.order_number;
	    			var options = 
                    {
                        "key": data.razorpay_key, // Enter the Key ID generated from the Dashboard
                        "amount": data.userData.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": "E-Health Care", //your business name
                        "description": data.userData.description,
                        "image": "Payment/payment.png",
                        "order_id": data.userData.rpay_order_id, //This is a sample Order ID. Pass 
                        "handler": function (response)
                        {
                            window.location.replace("Payment/payment-success.php?action=Done&id="+id);
                        },
                        "modal": 
                        {
                            "ondismiss": function()
                            {
                                window.location.replace("Payment/payment-success.php?action=cancle&id="+id);
                            }
                        },
                            "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                            "name": data.userData.name, //your customer's name
                            "email": data.userData.email,
                            "contact": data.userData.mobile //Provide the customer's phone number for better conversion rates 
                        },
                        "notes": 
                        {
                            "address": "E-Health Care"
                        },
                        "config": 
                        {
                            "display": 
                            {
                                "blocks": 
                                {
                                    "banks": 
                                    {
                                        "name": 'Pay using '+paymentOption,
                                        "instruments": [{"method": paymentOption},],
                                    },
                                },
                                "sequence": ['block.banks'],
                                "preferences": 
                                {
                                    "show_default_blocks": true,
                                },
                            },
                        },
                        "theme": 
                        {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.on(
                        'payment.failed', function (response)
                        {
                            window.location.replace("Payment/payment-failed.php?oid="+orderID+"&reason="+response.error.description+"&paymentid="+response.error.metadata.payment_id);
                        });
                    rzp1.open();
                    e.preventDefault(); 
            }
        
        });
    });
});
</script>
 
    </body>
</html>