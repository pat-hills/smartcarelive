<body>
<?php  require '../../functions/func_cashier.php';   



?>

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Detailed payment report for, <?php echo getPatientsName($_GET['patient_id']) ?></h3>
						</div>
						<div class="content">

<?php // 

global $connection;
$patient_id   = $_GET['patient_id'];
if(empty($patient_id)){ header("location:my_report"); }

$date_ = date("Y-m-d");

$the_query = "SELECT transcode,date_added,patient_id FROM cashier_payment WHERE patient_id='".$patient_id."' AND date_added='".$date_."' GROUP BY patient_id";

$paymentReport = mysqli_query($connection,$the_query); 


?>

<?php 
		if(mysqli_affected_rows($connection) >0){
			while($getReport = mysqli_fetch_array($paymentReport)){  ?>
<div class="col-md-4">
<div style="margin-top: 60px;" class="block dark-list">
						<div class="header" style="padding:5px">
						<span class="badge badge-danger" style="float:left;margin-left:100px;"><?php echo date('d F Y',strtotime($getReport['date_added'])); ?></span>
							<h4>Services <span class="pull-right">Amount</span></h4>
							</div>
						<div class="content no-padding ">
							<ul class="items">
								<li><?php $consulting = get_Patients_consulting_payment4details($getReport['date_added'],$getReport['patient_id']); ?>
									<i class="fa fa-user-md"></i>Consulting<span class="pull-right value">&#x20B5&nbsp;<?php echo  $consulting; ?></span>
								</li>
								<li>
								<?php  $investigation = get_Patients_investigation_payment4details($getReport['date_added'],$getReport['patient_id']); ?>
									<i class="fa fa-flask"></i>Investigation<span class="pull-right value">&#x20B5&nbsp;<?php echo  $investigation; ?></span> 
				                </li>
								<!-- <li>
									<i class="fa fa-stethoscope"></i>Procedure<span class="pull-right value">&#x20B5&nbsp;0.00</span>
									
								</li> -->
								<li>
								<?php $drugs = get_Patients_drugs_payment4details($getReport['date_added'],$getReport['patient_id']); ?>
								<i class="fa fa-medkit"></i>Drugs<span class="pull-right value">&#x20B5&nbsp;<?php 
								 if(empty($drugs)){
									echo "0.00";
								 } else{ echo $drugs;} 
								
								?></span>
								</li>
								
							</ul>
						</div>
						
						<div class="total-data bg-blue" >
								<a href="#">
									<h2>Total <b class=""></b> <span class="pull-right">&#x20B5 &nbsp;<?php echo $consulting + $investigation + $drugs; ?></span></h2>
								</a>
								
							</div>
</div>
</div>
<?php } }else{ echo "Error: what where you trying to do :don't play with the URL"; } ?>

</div></div></div></div>		