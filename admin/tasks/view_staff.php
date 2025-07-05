<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Admin</h2>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>

                <li class="active">Admin - View Staff </li>
            </ol>
        </div>
        <div class="cl-mcont"> 
            <div class="row">
                <div class="col-md-12">

                    <div class="block-flat">
                        <div class="header">                          
                            <h3>Staffs</h3>

                        </div>
                        <div class="content">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-sm btn-flat btn-default"><i class="fa fa-angle-left"></i></button> 
                                <button type="button" class="btn btn-sm btn-flat btn-default"><i class="fa fa-angle-right"></i></button> 
                            </div>
                            
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-sm btn-flat btn-default dropdown-toggle" data-toggle="dropdown">
                                    Order by <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Time</a></li>

                                </ul>
                            </div>
                            <h3 class="widget-title"></h3>
                            <div class="row friends-list">
<?php if (isset($_SESSION['successMsg'])) { ?>
                                <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                                    <div class="alert alert-success alert-white rounded">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <div class="icon"><i class="fa fa-times-circle"></i></div>
                                        <strong><?php
                                            echo $_SESSION['successMsg'];
                                            unset($_SESSION['successMsg'])
                                            ?>!</strong> 
                                    </div>     
                                </div>
                            <?php } else if (isset($_SESSION['errorMsg'])) { ?>
                                <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                                    <div class="alert alert-success alert-white rounded">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <div class="icon"><i class="fa fa-times-circle"></i></div>
                                        <strong><?php
                                            echo $_SESSION['errorMsg'];
                                            unset($_SESSION['errorMsg'])
                                            ?>!</strong> 
                                    </div>     
                                </div>
                            <?php } ?>
                                <?php
                                echo view_staff_list();
                                ?>

                                <!--<div class="col-sm-6 col-md-4">
                                  <div class="friend-widget">
                                    <img src="images/avatars/avatar1.jpg">
                                    <a href="#"><h4>Andrea Smith</h4></a>
                                    <p>Doctor</p>
                                    </div>
                                </div>-->
                            </div>

                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>