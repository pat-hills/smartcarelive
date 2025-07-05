<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Admin</h2>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>

                <li class="active">Admin - Assign Consulting Room</li>
            </ol>
        </div>

        <?php if (isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php echo $_SESSION['successMsg'];
        unset($_SESSION['successMsg']) ?>!</strong> 
                </div>     
            </div>
        <?php } else if (isset($_SESSION['errorMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-danger alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php echo $_SESSION['errorMsg'];
        unset($_SESSION['errorMsg']) ?>!</strong> 
                </div>     
            </div>
<?php } ?>

        <div class="cl-mcont"> 
            <div class="row">
                <div class="col-md-12">

                    <div class="block-flat">
                        <div class="header">                          
                            <h3>Assign Consulting Room</h3>
                        </div>
                        <div class="content">
                            <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  action="tasks/assignroom.php" style="border-radius: 0px;" method="post">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Room : </label>
                                        <div class="col-sm-9">

                                            <select id="room" name="room" required="" class="form-control">
                                                <option value=""> -- Select Room -- </option>
                                                <?php
                                                select_consulting_rooms();
                                                ?>

                                            </select>         
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Doctor : </label>
                                        <div class="col-sm-9">

                                            <select id="doctor" name="doctor" required="" class="form-control">
                                                <option value=""> -- Select Doctor -- </option>

                                                <?php
                                                select_consultants();
                                                ?>

                                            </select>         
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Shift : </label>
                                        <div class="col-sm-9">

                                            <select id="shift" name="shift" required="" class="form-control">
                                                <option value=""> -- Select Shift -- </option>
                                                <option value="Morning"> Morning </option>
                                                <option value="Afternoon"> Afternoon </option>
                                                <option value="Night"> Night </option>  
                                                <option value="AllDay"> All Day </option>                
                                            </select>         
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">

                                        <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="assign">Assign</button></div>
                                    </div>
                                </div>
                            </form>
                            <div class="content">
                                <div class="table-responsive">
                                    <table id="assignconsulting" class="table no-border hover">
                                        <thead class="no-border">
                                            <tr>

                                                <th style="width:25%;"><strong>Room Name</strong></th>
                                                <th style="width:30%;"><strong>Doctor</strong></th>
                                                <th style="width:10%;"><strong>Shift</strong></th>
                                                <th style="width:15%;" class="text-center"><strong>Remove</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody class="no-border-y">

                                            <?php
                                            echo list_assigned_rooms();
                                            ?>
                                        </tbody>
                                    </table>		
                                </div>
                            </div>

                        </div>
                    </div>

                </div>