<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Add New Drug</h2>
      <ol class="breadcrumb">
        <li><a href="#">Tasks</a></li>
       
        <li class="active">Add drug</li>
      </ol>
    </div>
    <div class="cl-mcont">
       
    <div class="row">
      
<?php


echo @$_SESSION['add_drug'];
unset($_SESSION['add_drug']);


 ?>
 
 
 	<?php if(!empty($_SESSION['upload_message'])){?>
	<div class="alert alert-danger alert-white rounded" style="width:70%;margin-top:20px;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-info-circle"></i></div>
								<strong>Info!</strong>&nbsp;<?php echo $_SESSION['upload_message'];?>
	</div>
	<?php } ?>
 
 
 
<!-- <div class="col-sm-4 col-md-3" style="float:right;margin-right:250px;">
<div class="block-flat">
 <form action="../upload_csv.php" method="post" enctype="multipart/form-data" >
<input type="file" name="file" accept=".csv" /> 
<input type="submit" class="btn btn-success btn-xs" value="Submit" name="import" style="margin-top:20px;">
 </form>
  <label style="font-size:10px;">Upload a CSV file (max size is 1MB)</label>
</div>
</div> -->
 
<div class="col-sm-12 col-md-12">
      <div class="block-flat">
          <div class="header">							
            <h3>New Drug Entry</h3>
          </div>
          <div class="content">

          <form role="form" method="post" action="db_tasks/add_drugs"> 
		 
            <div class="form-group"> 
              <label>Name</label> <input placeholder="Drug Name" autocomplete="off" class="form-control" name="dname" required type="text">
            </div> 
                             
              
                <div class="form-group">
                  <label class="control-label">Expiry Date</label>
                 
                    <input type="date"  class="form-control" name="expdate">
                  </div>
               
            </div> 
                <br />
                <br />
                <br />
                <br />
            <div class="checkbox"><button class="btn btn-primary btn-lg col-sm-6" type="submit">Add Drug</button>
             </form>
     </div>
    </div>
    </div>


      </div>
      
     
</div></div>
     