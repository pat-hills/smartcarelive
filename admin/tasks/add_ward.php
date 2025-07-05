<?php
$response = 0;
if (isset($_GET['a']) && !empty($_GET["a"])) {
    $response = $_GET['a'];
}
?>
<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Admin</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Admin - Setup Ward </li>
      </ol>
    </div>

 

        <?php if ($response == 7) { ?>
            <div class="alert alert-info alert-white rounded" style="width:70%;margin-top:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>   
            <div style="background: #440060" class="icon"><i class="fa fa-info-circle"></i></div>
                <strong>Info! </strong>&nbsp;

                
                  
                  <b>Ward has been saved!!!</b>   
                  
           </div>
                <?php } ?>      

        <?php if ($response == 6) { ?>
            <div class="alert alert-info alert-white rounded" style="width:70%;margin-top:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>   
            <div style="background: #440060" class="icon"><i class="fa fa-info-circle"></i></div>
                <strong>Info! </strong>&nbsp;

      <b>Ward has been Deleted!!!</b> 
        </div>        

                <?php } ?>      
 
      
        <div class="block-flat">
           <div class="header">                          
            <h3>Add Wards </h3>
          </div>
          <div class="content">
             <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate="" action="tasks/addward.php" style="border-radius: 0px;" method="post">
              
             <div class="form-group">
                <label class="col-sm-3 control-label">Name of ward : </label>
                <div class="col-sm-6">
                  <input type="text" placeholder="Eg. WARD 1, WARD A, GREEN WARD" autocomplete="off" name="nameward" required="" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Gender : </label>
                <div class="col-sm-6">
                <select id="shift" name="gender" required="" class="form-control">
                                                <option value=""> -------------------- </option>
                                                <option value="Male"> Male </option>
                                                <option value="Female"> Female </option>                                     
                                            </select> 
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Service Department : </label>
                <div class="col-sm-6">
                <select id="shift" name="service_department" required="" class="form-control">
                                                <option value=""> -------------------- </option>
                                                <option value="General"> General </option>
                                                <option value="Maternity"> Maternity </option>
                                                <option value="Paediatric"> Paediatric </option>   
                                                <option value="Surgical"> Surgical </option>                                                
                                            </select> 
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Bed Capacity Of Ward : </label>
                <div class="col-sm-6">
                  <input type="text" autocomplete="off" name="bedcapacity"  class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Current Number Of Beds : </label>
                <div class="col-sm-6">
                  <input type="text" autocomplete="off" name="currentbeds"  class="form-control">
                </div>
              </div>
              
              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="add_complain">Add Ward</button></div>
            </form>
          </div>
            
            <div class="content">
              <div class="table-responsive">
                                <table id="complains" class="table no-border hover">
                                    <thead class="no-border">
                                        <tr>

                                            
                                            <th style="width:20%;"><strong>Ward Name</strong></th>
                                            <th style="width:20%;"><strong>Ward Gender</strong></th>
                                            <th style="width:20%;"><strong>Service Department</strong></th>
                                            <th style="width:20%;"><strong>Beds Available</strong></th>
                                             
                                            <th style="width:15%;" class="text-center"><strong>Remove</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="no-border-y">

                                        <?php
                                        echo list_wards();
                                        ?>
                                    </tbody>
                                </table>		
                            </div>
          </div>
            
            
        </div>
        
    </div>