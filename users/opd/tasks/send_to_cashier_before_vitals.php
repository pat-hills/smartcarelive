<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Patient's Bio Vitals</h2>
            <ol class="breadcrumb">
                <li><a href="#">Tasks</a></li>

                <li class="active">Vitals</li>
            </ol>
            <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_patient_details_cashier" style="border-radius: 0px;">
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <label class="col-sm-3 control-label">Search Patient Name</label>

                    <div class="col-sm-3">
 
                        <input class="form-control col-sm-3" placeholder="Begin by first name and select patient"  type="text" autocomplete="off" id="select_patient" name="get_details" />

                      
                    </div>
                    <!-- <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Get Details</button> -->
                </div>

                <div id="result" class="list-group"></div>

            </form>
        </div>
        <div class="cl-mcont">

            <div class="row">
                <div class="col-md-12">



                    <div class="block-flat profile-info">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="avatar">
                                    <img src="
                                    <?php
                                    if (isset($_SESSION['patient_id'])) {
                                        echo @patient_profile_picture($_SESSION['patient_id']);
                                    } else {
                                        echo @no_image();
                                    }
                                    ?>
                                         " class="profile-avatar">
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="personal">
                                    <h1 class="name"><?php echo @$_SESSION['surname'] . " " . @$_SESSION['other_names']; ?></h1>
                                    <p class="description">Patient ID: <?php echo @$_SESSION['patient_id']; ?></p>

                                    <!-- -->
                                    <?php if (isset($_SESSION['scheme']) && !empty($_SESSION['scheme'])) { ?>
                                        <p class="description">Insurance Scheme: <?php echo @strtoupper($_SESSION['scheme']); ?></p>
                                    <?php } else { ?>
                                        <p class="description">Insurance Scheme: None</p>
                                    <?php } ?>

                                    <!-- -->
                                    <?php if (isset($_SESSION['sub_metro']) && !empty($_SESSION['sub_metro'])) { ?>
                                        <p class="description">Sub Metro: <?php echo @$_SESSION['sub_metro']; ?></p>
                                    <?php } ?>

                                    <!-- -->
                                    <?php if (isset($_SESSION['membership_id']) && !empty($_SESSION['membership_id'])) { ?>
                                        <p class="description">Membership ID: <?php echo @ucfirst($_SESSION['membership_id']); ?></p>
                                    <?php } //else { ?>
                            <!--<p class="description">Membership ID: </p>-->
                                    <?php //} ?>


                                    <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                                    <p class="description">Age : <?php
                                        get_age(@$_SESSION['dob']);
                                        echo" years";
                                        ?></p><p>
                                    <p class="description">Gender: <?php echo @$_SESSION['sex']; ?></p><p>
                                    </p></div>
                            </div>
                            <div class="col-sm-3">
                                <?php
                                //setting login error messages

                                echo @$_SESSION['err_msg'];
                                unset($_SESSION['err_msg']);
                                ?>
                            </div>
                        </div>
                    </div>

                   

                    <div class="cl-mcont">

                   
                    <?php
                        if (isset($_SESSION['indicator'])) {
                            $theIndicator = $_SESSION['indicator'];
                        } else {
                            $theIndicator = "";
                        }
                        if ($theIndicator == 5) {
                            ?>


                            <div class="col-sm-6 col-md-6">
                                <div class="block-flat">
                                    <div class="header">                          
                                        <h3>Send Patient To Cashier For Payment Of Consultation</h3>
                                    </div>
                                    <div class="content">

                                        <form role="form" action="tasks/insert_consultation" method="post" autocomplete="off"> 
                                        <input value="TO-CASHIER" class="form-control col-sm-3" type="hidden" id="select_patient" name="to_cashier" />
                                            <br/>

                             <?php if (isset( $_SESSION['message']) &&  $_SESSION['message']=="") {
                              ?>
                                            <button onclick='return confirm("Are you sure you want to send patient to cashier?")' class="btn btn-primary pull-right test" type="submit" name="update">Send Patient</button>
                                           
                                            <?php } 
                                            
                                            else if (isset( $_SESSION['message'])&&  $_SESSION['message']=="Payment-Pending") {
    ?>
                                   <h2  class="btn btn-primary pull-right test">Patient Is Pending Payment</h2>
                                                     
                                            
                                         
                             <?php }       
                            
                            ?>  
                                      <input class="btn btn-primary" id="review" type="checkbox" value="Check if patient is coming for review" name="review"/>        
                                      <label for="review">Check if patient is coming for review</label><br>

                                      <a style="display:none" class="btn btn-primary" href="add_biovitals" id="reviewLink">
                                        Continue to take patient vitals
                                      </a>

                                            <div></div><br>
                                        </form>


                                    </div>
                                </div>              
                            </div>



                            <?php } ?>
 

                     

                    </div>




