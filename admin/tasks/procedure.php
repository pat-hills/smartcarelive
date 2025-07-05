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

                <li class="active">Admin - Add Diagnosis</li>
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
                echo 'Bulk Uploading of Procedure<br/>';
            } elseif ($response == 6) {
                ?>
                <div style="background: #00CC00" class="icon"><i class="fa fa-info-circle"></i></div>
                <strong>Info! </strong>&nbsp;

                <?php
                echo 'Procedure has been Deleted<br/>';
            } elseif ($response == 7) {
                ?>
                <div style="background: #00CC00" class="icon"><i class="fa fa-info-circle"></i></div>
                <strong>Info! </strong>&nbsp;

                <?php
                echo 'Procedure has been Saved<br/>';
            } else {
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
                } elseif ($response == 8) {
                    echo 'Procedure Could Not be Saved';
                }
            }
            $response = 0;
            ?>

        </div>







        <div class="col-sm-12 col-md-12"  >
            <div class="block-flat">
                <label style="color: dodgerblue"> 1. Upload works with CSV Files <br/>
                    2. The CSV file should contain at LEAST columns like
                    procedure, category, tarriffs, procedure_code, gdrgcode,nhis.
                </label>
                <form action="../users/upload_csv.php" method="post" enctype="multipart/form-data" >
                    <input type="file" name="csvFile" value="Upload" class="btn-success  btn-lg"
                           accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    <input type="hidden" name="procedure" value="1" >
                    <input type="submit" class="btn btn-success btn-s" value="Submit" name="submit" style="margin-top:20px;">
                </form>
                <label style="font-size:10px;">Upload a CSV file (max size is 1MB)</label>
            </div></div>
        <div class="cl-mcont"> 
            <div class="row">
                <div class="col-md-12">

                    <div class="block-flat">
                        <div class="header">                          
                            <h3>Add Procedure</h3>
                        </div>
                        <div class="content">
                            <form autocomplete="off" class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  action="tasks/procedure_list.php" style="border-radius: 0px;" method="post">
                                <div class="col-md-6 col-sm-6 col-lg-6">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Procedure Name: </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="procedure" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">G-DRG CODE: </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gdrgcode" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tariffs: </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tariffs" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">NHIS : </label>
                                        <div class="col-sm-9">

                                            <select id="nhis" name="nhis" required="" class="form-control">
                                                <option value=""> -- Select  -- </option>

                                                <option value="1">Yes</option>
                                                <option value="0">No</option>


                                            </select>         
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Category : </label>
                                        <div class="col-sm-9">

                                            <select id="nhis" name="category" required="" class="form-control">
                                                <option value=""> -- Select  -- </option>

                                                <option value="1">cat1 </option>
                                                <option value="0">cat 2</option>


                                            </select>         
                                        </div>
                                    </div>
                                </div>




                                <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="add_procedure">Add Procedure</button></div>
                            </form>
                        </div>

                        <div class="content">
                            <div class="table-responsive">
                                <table id="procedure" class="table no-border hover">
                                    <thead class="no-border">
                                        <tr>


                                            <th style="width:15%;"><strong>Procedure Code</strong></th>
                                            <th style="width:20%;"><strong>Procedure Name</strong></th>
                                            <th style="width:15%;"><strong>G-DRG CODE</strong></th>
                                            <th style="width:20%;"><strong>Category</strong></th>
                                            <th style="width:10%;"><strong>Tariffs</strong></th>
                                            <th style="width:10%;"><strong>NHIS</strong></th>

                                            <th style="width:10%;" class="text-center"><strong>Remove</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="no-border-y">

                                        <?php
                                        echo list_procedure();
                                        ?>
                                    </tbody>
                                </table>		
                            </div>
                        </div>
                    </div>

                </div>