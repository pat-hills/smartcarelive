<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
       <h2>New Patient Registration</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Add Patient</li>
      </ol>
        
    </div>
     <div class="cl-mcont">   
    <div class="row wizard-row">
      <div class="col-md-12 fuelux">
        <div class="block-wizard">
          <div id="wizard1" class="wizard wizard-ux">
            <ul class="steps">
              <li data-target="#step1" class="active">Step 1<span class="chevron"></span></li>
              <li data-target="#step2">Step 2<span class="chevron"></span></li>
              <li data-target="#step3">Step 3<span class="chevron"></span></li>
            </ul>
            <div class="actions">
              <button type="button" class="btn btn-xs btn-prev btn-default"> <i class="icon-arrow-left"></i>Prev</button>
              <button type="button" class="btn btn-xs btn-next btn-default" data-last="Finish">Next<i class="icon-arrow-right"></i></button>
            </div>
          </div>
          <div class="step-content">
            <form class="form-horizontal group-border-dashed" action="#" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate> 
              <div class="step-pane active" id="step1">
                <div class="form-group no-padding">
                  <div class="col-sm-7">
                    <h3 class="hthin">User Info</h3>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">User Name</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="User name">
                  </div>
                </div>  
                <div class="form-group">
                  <label class="col-sm-3 control-label">E-Mail</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="User E-Mail">
                  </div>
                </div>  
                <div class="form-group">
                  <label class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" placeholder="Enter your password">
                  </div>
                </div>    
                <div class="form-group">
                  <label class="col-sm-3 control-label">Verify Password</label>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" placeholder="Enter your password again">
                  </div>
                </div>  
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-default">Cancel</button>
                    <button data-wizard="#wizard1" class="btn btn-primary wizard-next">Next Step <i class="fa fa-caret-right"></i></button>
                  </div>
                </div>                  
              </div>
              <div class="step-pane" id="step2">
                <div class="form-group no-padding">
                  <div class="col-sm-7">
                    <h3 class="hthin">Notifications</h3>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-7">
                    <label class="control-label">E-Mail Notifications</label>
                    <p>This option allow you to recieve email notifications by us.</p>
                  </div>
                  <div class="col-sm-3">
                    <input class="switch" checked data-size="small" name="op1" type="checkbox" checked />
                  </div>
                </div>  
                <div class="form-group">
                  <div class="col-sm-7">
                    <label class="control-label">Phone Notifications</label>
                    <p>Allow us to send phone notifications to your cell phone.</p>
                  </div>
                  <div class="col-sm-3">
                   <input class="switch" checked data-size="small" name="op1" type="checkbox" checked />
                  </div>
                </div>  
                <div class="form-group">
                  <div class="col-sm-7">
                    <label class="control-label">Global Notifications</label>
                    <p>Allow us to send notifications to your dashboard.</p>
                  </div>
                  <div class="col-sm-3">
                   <input class="switch" checked data-size="small" name="op1" type="checkbox" checked />
                  </div>
                </div>  
                <div class="form-group">
                  <div class="col-sm-12">
                    <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> Previous</button>
                    <button data-wizard="#wizard1" class="btn btn-primary wizard-next">Next Step <i class="fa fa-caret-right"></i></button>
                  </div>
                </div>  
              </div>
              <div class="step-pane" id="step3">
                <div class="form-group no-padding">
                  <div class="col-sm-7">
                    <h3 class="hthin">Configuration</h3>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6">
                    <label class="control-label">Buy Credits: <span id="credits">$0</span></label>
                    <p>This option allow you to buy an amount of credits.</p>
                    
                    <input id="credit_slider" type="text" class="bslider form-control" value="0" />
                  </div>
                  <div class="col-sm-6">
                    <label class="control-label">Change Plan</label>
                    <p>Change your plan many times as you want.</p>
                    <select class="select2">
                       <optgroup label="Personal">
                         <option value="p1">Basic</option>
                         <option value="p2">Medium</option>
                       </optgroup>
                       <optgroup label="Company">
                         <option value="p3">Standard</option>
                         <option value="p4">Silver</option>
                         <option value="p5">Gold</option>
                       </optgroup>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6">
                    <label class="control-label">Payment Rate: <span id="rate">0%</span></label>
                    <p>Choose your payment rate to calculate how much money you will recieve.</p>
                    
                    <input id="rate_slider"  data-slider-min="0" data-slider-max="100" type="text" class="bslider form-control" value="0" />
                  </div>
                  <div class="col-sm-6">
                    <label class="control-label">Keywords</label>
                    <p>Write your keywords to do a successful CEO with web search engines.</p>
                    <input class="tags" type="hidden" value="brown,blue,green" />
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> Previous</button>
                    <button data-wizard="#wizard1" class="btn btn-success wizard-next"><i class="fa fa-check"></i> Complete</button>
                  </div>
                </div>  
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    </div>
  </div> 
</div>