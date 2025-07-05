<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Admin</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Admin - Add Complains (Sentence)</li>
      </ol>
    </div>

     <?php
        if( isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php echo $_SESSION['successMsg']; unset($_SESSION['successMsg'])?>!</strong> 
                </div>     
            </div>
      <?php  }  else if( isset($_SESSION['errorMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php echo $_SESSION['errorMsg']; unset($_SESSION['errorMsg'])?>!</strong> 
                </div>     
            </div>
      <?php } ?>

    <div class="cl-mcont"> 
        <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">                          
            <h3>Add Complains (Sentence)</h3>
          </div>
          <div class="content">
             <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  action="tasks/addsentence.php" style="border-radius: 0px;" method="post">
              <div class="form-group">
                <label class="col-sm-3 control-label">Sentence : </label>
                <div class="col-sm-6">
                  <input type="text" name="sentence" required="" class="form-control">
                </div>
              </div>
              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="add_sentence">Add Sentence</button></div>
            </form>
          </div>
        </div>
        
    </div>