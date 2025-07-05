<?php

$dignosis_response = "";
 

?>
<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Admin</h2>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>

                <li class="active">Admin - Add Diagnosis</li>
            </ol>
        </div>

         

        <?php if ($dignosis_response == 6) {
                ?>
                 <div class="alert alert-info alert-white rounded" style="width:70%;margin-top:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div class="icon"><i class="fa fa-save"></i></div>
                <strong>Info!</strong>&nbsp;
                <?php
                echo 'Diagnosis Addition Was Successful'." </div>";
            }


            ?>
 


        <div class="cl-mcont"> 
            <div class="row">
                <div class="col-md-12">

                    <div class="block-flat">
                        <div class="header">                          
                            <h3>Add Diagnosis</h3>
                        </div>
                        <div class="content">
                            <form autocomplete="off" class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  action="tasks/diagnosis_list.php" style="border-radius: 0px;" method="post">
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Diagnosis: </label>
                                        <div class="col-sm-9">
                                            <input type="text" required name="diagnosis" required="" class="form-control">
                                        </div>
                                    </div>
 
                                    
                                </div>
 

                                <div class="row">
                                    <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="add_diagnosis">Add Diagnosis</button></div>
                                </div>
                            </form>




                        </div>

                        <div class="content">
                            <div class="table-responsive">
                                <table id="diagnosis" class="table no-border hover">
                                    <thead class="no-border">
                                        <tr>

                                            
                                            <th style="width:20%;"><strong>Diagnosis</strong></th> 
                                            <th style="width:15%;" class="text-center"><strong>Remove</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="no-border-y">

                                        <?php
                                        echo list_diagnosis();
                                        ?>
                                    </tbody>
                                </table>		
                            </div>
                        </div>
                    </div>

                </div>