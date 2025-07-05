<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Patient Walk In Updated Information</h2>
            <ol class="breadcrumb">
                <li><a href="#">Update Info</a></li>

                <li class="active">Walk In</li>
            </ol>
            <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_patient_details_cashier" style="border-radius: 0px;">
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    
                    <div class="col-sm-3">
 
                        
                      
                    </div>
                    
                </div>

                <div id="result" class="list-group"></div>

            </form>
        </div>
        <div class="cl-mcont">

            <div class="row">
                <div class="col-md-12">



                    <div class="block-flat profile-info">
                        <div class="row">
                            
                            <div class="col-sm-7">
                                <div class="personal">
                                    <h1 class="name"><?php echo @$_SESSION['full_name'] ?></h1>
                                    <p class="description">Patient ID: <?php echo @$_SESSION['walk_in_code']; ?></p>

                                   
                                 


                                    <p class="description">Contact: <?php echo @$_SESSION['contact']; ?></p><p>
                                    <p class="description">Age: <?php echo @$_SESSION['dob']; ?></p><p>
                                    <p class="description">Gender: <?php echo @$_SESSION['gender']; ?></p><p>
                                    </p></div>

                                    <p>
                 <!-- <a href="walk_in_edit_review_back" class="btn btn-success"> Back To Page </a>  -->

                 </p>
 
                            </div>
                            <div class="col-sm-3">
                                <?php
                                //setting login error messages

                                echo @$_SESSION['err_msg_update'];
                                unset($_SESSION['err_msg_update']);




                                echo @$_SESSION['err_msg_delete'];
                                unset($_SESSION['err_msg_delete']);
                               
                               ?>
                            </div>
                        </div>
                    </div>

                   

                    <div class="cl-mcont">

                   
                      
             

                     

                    </div>




