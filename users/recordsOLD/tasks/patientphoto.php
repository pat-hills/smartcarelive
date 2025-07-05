<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Take Patient's Picture</h2>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>

                <li class="active">Take Patient's Picture </li>
            </ol>
        </div>
        <?php if (isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Success!</strong> <?php echo $_SESSION['successMsg'] ?>
                </div>     
            </div>
            <?php
            unset($_SESSION['successMsg']);
        } else if (isset($_SESSION['errorMsg'])) {
            ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Error!</strong>  <?php echo $_SESSION['errorMsg'] ?>
                </div>     
            </div>
            <?php
            unset($_SESSION['errorMsg']);
        }
        ?>

        <div   style="background: white">

            <div class="row">
                <div class="col-md-12" >





                    <!--Fields to be updated here-->

                    <div  >
                        <div class="col-sm-6 col-md-6">

                            <div class="  profile-info">
                                <div class="row">

                                    <div class="col-sm-12" style="margin-left: 50px;">
                                        <?php
                                        //setting login error messages

                                        echo @$_SESSION['err_msg'];
                                        unset($_SESSION['err_msg']);

                                        require_once "../../functions/conndb.php";
                                        require_once "../../functions/func_search.php";

                                        $patient_id = $_SESSION['new_pat_id'];
                                        get_pat_details($patient_id);
                                        ?>			

                                        <div class="personal">
                                            <h1 class="name"><?php echo @$_SESSION['surname'] . " " . @$_SESSION['other_names']; ?></h1>
                                            <p class="description">Patient ID: <span class="label label-danger"><?php echo @$_SESSION['patient_id']; ?></span></p>

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
                                            <?php }  //else {  ?>
                                            <!--<p class="description">Membership ID: </p>-->
<?php //}  ?>


                                            <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                                            <p class="description">Age : <?php get_age(@$_SESSION['dob']);
echo" years"; ?></p><p>
                                            <p class="description">Gender: <?php echo @$_SESSION['sex']; ?></p><p>
                                            </p>
                                        </div>
                                        <br/><br/>               <a href="add_patient.php" class="btn btn-primary" >Add New Patient</a>

                                    </div>


                                </div>
                            </div>    
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="block-flat">
                                <div class="header">              
                                    <h3>Take Picture of:  
                                        <span id="patient_id">
                                            <?php
                                            isset($_SESSION['patient_id']) ? print @$_SESSION['patient_id'] : 'Patient ID not set';
                                            ?>
                                        </span>
                                    </h3>
                                </div>
                                <div class="content">
                                    <div class="photo_booth"  >
                                        <video id="video"   autoplay></video>
                                        <canvas id="canvas" width="500" height="500"></canvas>
                                        <div>
                                            <div>
                                                <center>
                                                    <div style="display: table; margin: 0 auto; background:#000; ">
                                                        <button id="capture" style="margin-left: 100px;background:#000" type="button" class="btn btn-transparent"><i class="fa fa-camera"></i></button>
                                                        <button id="new" style="margin-left: 200px;background:#000" type="button" class="btn btn-transparent"><i class="fa fa-rotate-right"></i></button>
                                                        <button  id="upload" style="margin-right:  100px;background:#000" type="button" class="btn btn-transparent"><i class="fa fa-upload"></i></button>

                                                    </div>
                                                </center>
                                                <!--<button class="btn btn-primary btn-flat md-trigger" data-modal="md-fall"> Fall</button>-->
                                            </div>
                                        </div>  
                                    </div>
                                </div>


                                <p></p>
                                <div>
                                    <div>
<!--                                        <div style="display: table; margin: 0 auto; background:#000; padding: 5px;">
                                            <button id="capture" type="button" class="btn btn-transparent"><i class="fa fa-camera"></i></button>
                                            <button id="new" type="button" class="btn btn-transparent"><i class="fa fa-rotate-right"></i></button>
                                            <button  id="upload" type="button" class="btn btn-transparent"><i class="fa fa-upload"></i></button>

                                        </div>-->
                                        <!--<button class="btn btn-primary btn-flat md-trigger" data-modal="md-fall"> Fall</button>-->
                                    </div>
                                </div>

                                <!-- Nifty Modal -->
                                <div style="perspective: 1300px;" class="md-modal md-effect-5" id="md-fall">
                                    <div class="md-content">
                                        <div class="modal-header">
                                            <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form"> 
                                                <div class="form-group">
                                                    <label>Patient ID</label> <input placeholder="Patient ID here" class="form-control" type="patient_id">
                                                </div>

                                                <button class="btn btn-primary" type="submit">Set Patient ID</button>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <!-- Nifty Modal -->	

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>