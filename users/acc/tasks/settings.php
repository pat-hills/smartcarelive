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
 
 
 <?php $theSettings_data = getToEditSettings();
if(!empty($theSettings_data)){ ?>
 	
<div class="col-sm-6 col-md-6">
        <div class="block-flat">
          <div class="header">							
            <h3>Scheme Settings</h3>
          </div>
          <div class="content">

          <form role="form" method="post" action="tasks/editSettings.php"> 
		  
		  
            <div class="form-group">
              <label>HI Code</label> <input value="<?php echo $theSettings_data['hicode']; ?>" placeholder="HI code" 
			  name="hicode" class="form-control" type="text">
            </div>
			<input type="hidden" value="<?php echo $theSettings_data['settings_code']; ?>" name="securitycode">
                <br />
                <br />
            <div class="checkbox"><button class="btn btn-primary btn-lg" type="submit">Save</button>
           </form>
     </div></div></div>


      </div>
  <?php }else{ ?>
  
<div class="col-sm-6 col-md-6">
        <div class="block-flat">
          <div class="header">							
            <h3>Scheme Settings</h3>
          </div>
          <div class="content">

          <form role="form" method="post" action="tasks/SaveSettings.php"> 
		  
		  
            <div class="form-group">
              <label>HI Code</label> <input placeholder="HI code" name="hicode" class="form-control" type="text">
            </div>
			
                <br />
                <br />
            <div class="checkbox"><button class="btn btn-primary btn-lg" type="submit">Save</button>
             </form>
     </div></div></div>


      </div>
  
<?php  } ?>    
     
</div></div>
     