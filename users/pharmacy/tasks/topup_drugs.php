<body>
<?php 
require_once '../../functions/func_pharmacy.php';
if(!isset($_GET['code']) and empty($_GET['code'])){
header('Location:../update_drug.php'); die();
 }else{ 
 
global $drugcode,$errors;
$drugcode = $_GET['code'];
$errors = 0;



//////////after submitting//////////
if(isset($_POST['submit_edit'])){ 

  $topup = intval( $_POST['quantity']) + intval( $_POST['topup']);
  $drugcode = trim($_POST['drugcode']);

  //var_dump($drugcode);

  if(topup_drug_details($drugcode,$topup) == true)
  {
  $errors = 1;
  
  }else{
  $errors = 2;
  }


//}

}


?>
  <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Top Up Drug</h2>
      <ol class="breadcrumb">
        <li><a href="#">Tasks</a></li>
       
        <li class="active">Top Up Drug</li>
		</ol>
    </div>
    <div class="cl-mcont">
       
    <div class="row">
      
	  <?php 
	  if(!empty($errors)){
	 
	  if($errors == 1){
	  echo' <div class="alert alert-danger alert-white rounded" style="width:70%;margin-top:20px;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-info-circle"></i></div>
								<strong>Info!</strong>&nbsp; Top Up Successful
	</div>';
	  }elseif($errors == 2){
	  echo' <div class="alert alert-danger alert-white rounded" style="width:70%;margin-top:20px;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-info-circle"></i></div>
								<strong>Info!</strong>&nbsp; nothing was top up
	</div>';
	  }
	  
	  }
	  ?>
	  
	  

<div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <a style="float:right;" href="update_drug.php" class="btn btn-default"><i class="fa fa-arrow-left"></i>back</a>
      
			<h3>Top Up</h3>
			
          </div>
          <div class="content">

          <form role="form" method="post" action=""> 
            
			<?php getDrugToUp($drugcode); ?>
			
			
			
                </div>
                <br />
                <br />
                <br />
                <br />
            <div class="checkbox"><button name="submit_edit" class="btn btn-primary btn-lg col-sm-6" type="submit">Top Up</button>
             </form>
     </div></div></div>


      </div>
      
     
</div></div>
     <?php } ?>