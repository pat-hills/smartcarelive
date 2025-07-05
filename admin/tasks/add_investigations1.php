<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Admin</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Admin - Add Investigations</li>
      </ol>
    </div>
    <div class="cl-mcont"> 
        <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">                          
            <h3>Add Investigation</h3>
          </div>
          <div class="content">
             <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate="" id="create_account"  action="#" style="border-radius: 0px;" method="post">
              <div class="form-group">
                <label class="col-sm-3 control-label">Investigation : </label>
                <div class="col-sm-6">
                  <input type="text" name="investigation" required="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Category : </label>
                <div class="col-sm-6">
                  
                  <select id="user_type" name="category" required="" class="form-control">
                    <option value=""> -- Select Category -- </option>
                    
                    <option value="#">Category here</option>
                    <option value="#">Category here</option>
                    <option value="#">Category here</option>
                    <option value="#">Category here</option>
                   
                  </select>         
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Tariffs : </label>
                <div class="col-sm-6">
                  <input type="text" name="tariffs" required="" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">G-DRG CODE : </label>
                <div class="col-sm-6">
                  <input type="text" name="gdrg_code" required="" class="form-control">
                </div>
              </div>
              
              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="add_investigation">Add Investigation</button></div>
            </form>
          </div>
        </div>
        
    </div>