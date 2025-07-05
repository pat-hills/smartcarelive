<body>

    <?php
    $response = 0;
    if (isset($_GET['a']) && !empty($_GET["a"])) {
        $response = $_GET['a'];
    }
    ?>
    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Admin</h2>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>

                <li class="active">Admin - View Patients </li>
            </ol>
        </div>
        <div class="cl-mcont"> 
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">                            
                            <h3>Patients List</h3>
                        </div>
                        <div class="content">

                            <?php if ($response == 6) { ?>
                                <div class="alert alert-info alert-white rounded" style="width:70%;margin-top:20px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                    <div style="background: #00CC00" class="icon"><i class="fa fa-info-circle"></i></div>
                                    <strong>Info! </strong>&nbsp;

                                    <?php
                                    echo 'Patient has been Deleted<br/>';
                                    $response = 0;
                                }
                                ?>


                            </div>

                            <div class="table-responsive">
                                <table id="patients_list" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><strong>Patient ID</strong></th>
                                            <th><strong>Surname</strong></th>
                                            <th><strong>Othernames</strong></th>
                                            <th><strong>Occupation</strong></th>
                                            <th><strong>Phone Number</strong></th>
                                            <th><strong>Address</strong></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                    </tbody>

                                </table>					
                            </div>
                        </div>
                    </div>              
                </div>
            </div>  
        </div>





