<body>

    <?php 

 

    global $error; 
    if (isset($_POST['add_investigation'])) {

        if (!empty($_POST['investigation']) and !empty($_POST['tariffs'])) {

            $investigation = $_POST['investigation'];
            $tariffs = $_POST['tariffs'];
          //  $gdrg_code = $_POST['gdrg_code'];
           // $nhis = $_POST['nhis'];

            //create_investigation($investigation, $category, $tariffs, $gdrg_code, $nhis)

            // if (create_investigation($investigation, $tariffs)) {
            //     $error = 1;
            // } else {
            //     $error = 2;
            // }
        }
    }
    ?>


    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Lab</h2>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>

                <li class="active">Lab - Edit Investigations</li>
            </ol>
        </div>

        

        <?php if ($error == 3) {
                ?>
                 <div class="alert alert-info alert-white rounded" style="width:70%;margin-top:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div class="icon"><i class="fa fa-save"></i></div>
                <strong>Info!</strong>&nbsp;
                <?php
                echo 'Investigation Deletion Was Successful'." </div>";
            }


            ?>
       
           



           <?php if ($error == 1) {
                ?>
                 <div class="alert alert-info alert-white rounded" style="width:70%;margin-top:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div class="icon"><i class="fa fa-save"></i></div>
                <strong>Info!</strong>&nbsp;
                <?php
                echo 'Investigation Addition Was Successful'." </div>";
            }


            ?>
          
       

              <!-- <div class="col-sm-9 col-md-9" >
                    <div class="block-flat">
        
                        <label style="color: dodgerblue"> 1. Upload works with CSV Files <br/>
                            2. The CSV file should contain at LEAST, columns like 
                            investigations, nhis, category, tarriffs, gdrgcode.
                        </label>
                        <form action="../users/upload_csv.php" method="post" enctype="multipart/form-data" >
                            <input type="file" name="csvFile" class="btn-success  btn-lg" value="Upload"
                                   accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            <input type="hidden" name="investigation" value="1" >
                            <input type="submit" class="btn btn-success btn-s" value="Submit" name="submit" style="margin-top:20px;">
                        </form>
                        <label style="font-size:10px;">Upload a CSV file (max size is 1MB)</label>
                    </div>
                
                </div>  -->



        <div class="cl-mcont"> 
            <div class="row">
                <div class="col-md-12">

                    <div class="block-flat">
                        <div class="header">                          
                            <h3>Edit Price</h3>

                        </div>
                        <div class="content">

                            <form autocomplete = "off" class="form-horizontal group-border-dashed"  action="db_tasks/edit_lab_price_action" style="border-radius: 0px;" method="post">
                                <div class="col-md-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Investigation : </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="investigation" required readonly class="form-control"
                                            
                                            value="<?php if(isset($_SESSION['Investigation_name']) && $_SESSION['Investigation_name'] != null )echo $_SESSION['Investigation_name'];?>"
                                            
                                            >
                                        </div>
                                    </div>
<!--                                     
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Category : </label>
                                        <div class="col-sm-9">

                                            <select id="category" name="category" required="" class="form-control">
                                                <option value=""> -- Select Category -- </option>

                                                <option value="mdc">MDC</option>
                                                <option value="app">APP</option>


                                            </select>         
                                        </div>
                                    </div> -->

<!--                                     

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">NHIS : </label>
                                        <div class="col-sm-9">

                                            <select id="nhis" name="nhis" required="" class="form-control">
                                                <option value=""> -- Select  -- </option>

                                                <option value="1">Yes</option>
                                                <option value="2">No</option>


                                            </select>         
                                        </div>
                                    </div>
 -->

                                </div>
                                <div class="col-md-6 col-md-6 col-sm-6">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Price : </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tariffs" required class="form-control"  value="<?php if(isset($_SESSION['Investigation_price']) && $_SESSION['Investigation_price'] != null )echo $_SESSION['Investigation_price'];?>">
                                        </div>
                                    </div>

<!-- 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">G-DRG CODE : </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gdrg_code" required="" class="form-control">
                                        </div>
                                    </div> -->


                                </div>
                                <div class="row">
                                    <div style="text-align: center; margin-top: 10px;"><input class="btn btn-primary" type="submit" name="add_investigation" value='Edit Price'></div>
                                </div>
                            </form>


                            <h3>List of Investigation</h3>
<hr/>
                            <div class="table-responsive">
                                <table id="investigations"  class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th> <strong>Investigation</strong></th>
 
                                            <th> <strong>Price</strong></th>
                                            <th> <strong>Investigation Code</strong></th> 
                                            <th style="width:15%;" class="text-center"><strong>Edit</strong></th>

                                        </tr>
                                    </thead>
                                    <tbody class="no-border-y">
                                        <?php
                                        echo listprice_investigations();
                                        ?>	
                                    </tbody>

                                </table>					
                            </div>

                        </div>
                    </div>

                </div>