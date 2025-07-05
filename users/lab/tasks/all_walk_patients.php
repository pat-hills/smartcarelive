<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Search For Walk In Patient To Edit / Delete</h2>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
       
        <li class="active">Search For Walk In Patient To Edit / Delete</li>
      </ol>
    </div>
    <div class="cl-mcont"> 
	<div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
          <?php
                                                echo @$_SESSION['inves_err_exist'];
                                                unset($_SESSION['inves_err_exist']);
                                                ?>
                                                
          </div>
          <div class="content">
          <div class="row">
          <div class="col-sm-12 col-md-12">
                            <div class="block-flat">
                                <div class="header">							
                                    <h3>Walk In Lab Search</h3>
                                </div>
                                <div class="content">

                                
                                <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/edit_delete_walk_in.php" method="post"> 
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Search Fullname : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off" type="text"  id="select_patient_edit_walk_in" name="get_details_edit_walk_in" class="form-control" placeholder="Search Fullname" value="">
                                            </div>
                                        </div>  


                                        <div id="result" class="list-group"></div>
 
                                       

                                       

 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fullname : </label>
                                            <div class="col-sm-6">
                                            <input  autocomplete="off"  type="text" value="<?php
                                            if(isset($_SESSION['full_name']) && !empty($_SESSION['full_name'])){
                                                echo $_SESSION['full_name'];
                                            }
                                            
                                          
                                            
                                            
                                            ?>" name="fullname" class="form-control" placeholder="Phone / Contact">
                                            </div>
                                        </div> 

                                        <input required autocomplete="off" readonly type="hidden" value="<?php
                                            if(isset($_SESSION['walk_in_code']) && !empty($_SESSION['walk_in_code'])){
                                                echo $_SESSION['walk_in_code'];
                                            }
                                            
                                          
                                            
                                            
                                            ?>" name="walk_in_code" class="form-control" placeholder="Phone / Contact">


<input required autocomplete="off" readonly type="hidden" value="<?php
                                            if(isset($_SESSION['patient_id']) && !empty($_SESSION['patient_id'])){
                                                echo $_SESSION['patient_id'];
                                            }
                                            
                                          
                                            
                                            
                                            ?>" name="walk_in_id" class="form-control" placeholder="Phone / Contact">

                                        
                                        

                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Gender : </label>
                                            <div class="col-sm-6">
                                                <select id="source_lab_test" required class="form-control" name="gender">
 
                                                <option selected="true" value="
                                                <?php
                                            if(isset($_SESSION['gender']) && !empty($_SESSION['gender'])){
                                                echo $_SESSION['gender'];
                                            }
                                            
                                          
                                            
                                            
                                            ?>
                                                
                                                "> <?php
                                            if(isset($_SESSION['gender']) && !empty($_SESSION['gender'])){
                                                echo $_SESSION['gender'];
                                            }
                                            
                                          
                                            
                                            
                                            ?> </option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div> 


                                       

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Age: </label>
                                            <div class="col-sm-6">
                                            <input style="float:left;" required autocomplete="off" type="text" name="age"  class="form-control" placeholder="" value="<?php if(isset($_SESSION['dob']) && !empty($_SESSION['dob'])){echo $_SESSION['dob'];}?>">
                                                   
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Contact: </label>
                                            <div class="col-sm-6">
                                            <input style="float:left;" required autocomplete="off" type="text" name="contact"  class="form-control" placeholder="" value="<?php if(isset($_SESSION['contact']) && !empty($_SESSION['contact'])){echo $_SESSION['contact'];}?>">
                                           
                                                   
                                            </div>
                                        </div>




                                       

                                         <div style="text-align: center; margin-top: 10px;"><button onclick='return confirm("Are you sure you want to contitnue with action?")' class="btn btn-primary _update_account" type="submit" name="update_personal_info">Update Record</button></div>
                                   

                                         <div style="text-align: center; margin-top: 10px;"><button onclick='return confirm("Are you sure you want to contitnue with action?")' class="btn btn-primary _update_account" type="submit" name="delete_personal_info">Delete Record</button></div>
                                   
                               
                               
                               
                                        </div>

                            </div>


                        </div>

</div>


          </div>
        </div>

       
        
        <?php 
        
        echo @$_SESSION['err_msg'];
        unset($_SESSION['err_msg']);
        
        
        ?>
      
      
</div>