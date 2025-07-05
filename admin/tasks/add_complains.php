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
       
        <li class="active">Admin - Add Complains </li>
      </ol>
    </div>

  <div class="alert alert-info alert-white rounded" style="width:70%;margin-top:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php if ($response == 2) { ?>
                <div class="icon"><i class="fa fa-save"></i></div>
                <strong>Info!</strong>&nbsp;
                <?php
                echo 'Upload Successful';
            } elseif ($response == 0) {
                ?>
                <div style="background: #00CC00" class="icon"><i class="fa fa-info-circle"></i></div>
                <strong>Info! </strong>&nbsp;

                <?php
                echo 'Bulk Uploading of Complains<br/>';
            } elseif ($response == 6) {
                ?>
                <div style="background: #00CC00" class="icon"><i class="fa fa-info-circle"></i></div>
                <strong>Info! </strong>&nbsp;

                <?php
                echo 'Complain has been Deleted<br/>';
            }
            elseif ($response == 7) {
                ?>
                <div style="background: #00CC00" class="icon"><i class="fa fa-info-circle"></i></div>
                <strong>Info! </strong>&nbsp;

                <?php
                echo 'Complain has been Saved<br/>';
            }
            else {
                ?>
                <div style="background: red " class="icon"><i class="fa fa-ban"></i></div>
                <strong>Error!</strong>&nbsp;
                <?php
                if ($response == 1) {
                    echo 'the file size must not be more than 1MB';
                } elseif ($response == 3) {
                    echo 'Unable to Upload';
                } elseif ($response == 4) {
                    echo 'Problem Uploading File';
                } elseif ($response == 5) {
                    echo 'Unable to upload the CSV file';
                }
                elseif ($response == 8) {
                    echo 'Complain Could Not be Saved';
                }
            }
                $response = 0;
            
            ?>

        </div>

    <div class="cl-mcont"> 
        <div class="row">
      <div class="col-md-12 col-sm-12 col-lg-12">
         <div class="col-sm-12 col-md-12" >
        <div class="block-flat">
            <label style="color: dodgerblue"> 1. Upload works with CSV Files <br/>
                2. The CSV file should contain at LEAST a column called complains.
            </label>
            <form action="../users/upload_csv.php" method="post" enctype="multipart/form-data" >
                <input type="file" name="csvFile" value="Upload" class="btn-success  btn-lg"
                       accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                <input type="hidden" name="complains" value="1" >
                <input type="submit" class="btn btn-success btn-s" value="Submit" name="submit" style="margin-top:20px;">
            </form>
            <label style="font-size:10px;">Upload a CSV file (max size is 1MB)</label>
        </div></div>
      
        <div class="block-flat">
           <div class="header">                          
            <h3>Add Complains </h3>
          </div>
          <div class="content">
             <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate="" action="tasks/addcomplain.php" style="border-radius: 0px;" method="post">
              
             <div class="form-group">
                <label class="col-sm-3 control-label">Sentence or Word : </label>
                <div class="col-sm-6">
                  <input type="text" autocomplete="off" name="complain" required="" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Category : </label>
                <div class="col-sm-6">
                <select id="shift" name="complain_category" required="" class="form-control">
                                                <option value=""> -------------------- </option>
                                                <option value="General"> General </option>
                                                <option value="Integumentary"> Integumentary </option>
                                                <option value="Obstetric / Gynaecological"> Obstetric / Gynaecological </option>
                                                <option value="Ocular"> Ocular </option>      
                                                <option value="Cardiovascular"> Cardiovascular </option>
                                                <option value="Neurological"> Neurological </option>  
                                                <option value="Psychiatric"> Psychiatric </option>  
                                                <option value="Ear, Nose and Throat"> Ear, Nose and Throat </option> 
                                                <option value="Gastrointestinal"> Gastrointestinal </option>
                                                <option value="Pulmonary"> Pulmonary </option>
                                                <option value="Rheumatologic"> Rheumatologic </option> 
                                                <option value="Urologic"> Urologic </option> 
                                                <option value="OTHER"> OTHER </option>                                     
                                            </select> 
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">ICD 10 (R CODE) : </label>
                <div class="col-sm-6">
                  <input type="text" autocomplete="off" name="r_code"  class="form-control">
                </div>
              </div>
              
              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="add_complain">Add Complain</button></div>
            </form>
          </div>
            
            <div class="content">
              <div class="table-responsive">
                                <table id="complains" class="table no-border hover">
                                    <thead class="no-border">
                                        <tr>

                                            
                                            <th style="width:20%;"><strong>Complain Code</strong></th>
                                            <th style="width:20%;"><strong>Complain</strong></th>
                                            <th style="width:20%;"><strong>Category</strong></th>
                                             
                                            <th style="width:15%;" class="text-center"><strong>Remove</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="no-border-y">

                                        <?php
                                        echo list_complains();
                                        ?>
                                    </tbody>
                                </table>		
                            </div>
          </div>
            
            
        </div>
        
    </div>