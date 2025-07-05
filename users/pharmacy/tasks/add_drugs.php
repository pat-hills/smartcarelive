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

          <form role="form" method="post" action="dbtasks/add_drugs.php"> 
            <div class="form-group">
              <label>Drug Code/Number</label> <input placeholder="Drug code" autocomplete="off" name="dcode" class="form-control" type="text">
            </div>
		 
            <div class="form-group"> 
              <label>Name</label> <input placeholder="Drug Name" autocomplete="off" class="form-control" name="dname" required type="text">
            </div> 
                             
                <!-- <div class="form-group">
                  <label class="col-sm-6 control-label">NHIS Drug?</label>
                  
                    Yes <input required type="radio" name="nhis" value="1">
                    No <input required type="radio" name="nhis" value="0" >
                  
                </div> -->
                <div class="form-group">
                  <label class="control-label">Expiry Date</label>
                 
                    <input type="date"  class="form-control" name="expdate">
                  </div>
                 
                 <div class="form-group">
                  <label class="control-label">Quantity</label>
                   <input type="number" name="qty" class="form-control" autocomplete="off" required placeholder="Quantity">
                 
                </div>
                 <div class="form-group">
                  <label class="control-label">Cost (GHS)</label>
                   <input type="text" name="price" autocomplete="off" required class="form-control" placeholder="Cost (GHS)">
                 
			     <div class="form-group"> 
              <label>Re-order level</label> <input autocomplete="off" placeholder="Re-order level" required class="form-control" name="reorderlevel" required="" type="text">
            </div> 
				 
                </div>
                <div class="form-group">
                 
                    <label>Drug Type</label>
                    
                    <select class="form-control" name="type" required>
                       <optgroup label="type">
                       		<option value="null" disabled="">select type</option>
                           <option value="tablets">Tablets</option>
                           <option value="amples">Amples</option>
                           <option value="capsules">Capsules</option>
                           <option value="sachets">Sachets</option>       
                           <option value="syrups">Syrups</option>
                           <option value="suppositories">Suppositories</option>
                           <option value="grams">Grams</option>
                           <option value="vial">Vial</option>
                           <option value="tubes">Tubes</option>
                        
                        
                       </optgroup>
                    </select>
                  
                </div>

                <div class="form-group"> 
              <label>Manufacturer</label> <input autocomplete="off" placeholder="Manufacturer" required class="form-control" name="manu" required="" type="text">
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
     