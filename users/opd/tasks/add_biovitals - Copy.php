<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Patient's Bio-vitals</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Add bio-vitals</li>
      </ol>
    </div>
    <div class="cl-mcont">    
    <div class="row">
        <div class="block-flat">
          <div class="header">                          
            <h3>Multiple Search Area</h3>
          </div>
          <div class="content">
              <form class="form-horizontal group-border-dashed" action="#" style="border-radius: 0px;">
              <div class="form-group">
                <label class="col-sm-3 control-label">Patient (ID/SURNAME/NATIONAL ID/NHIS)</label>
                <div class="col-sm-6">
                  <select class="select2">
                     <optgroup label="ID">
                       <option value="AK">PAT2014001</option>
                       <option value="HI">PAT20080001</option>
                     </optgroup>
                     <optgroup label="SURNAME">
                       <option value="CA">ASAMOAH</option>
                       <option value="NV">ANDOH</option>
                       <option value="OR">BOAKYE</option>
                       <option value="WA">MENSAH</option>
                     </optgroup>
                     <optgroup label="NATIONAL ID">
                       <option value="AZ">GHID20098</option>
                       <option value="CO">GHID2134</option>
                       <option value="ID">GHID9845</option>
                       <option value="MT">GHID23452</option>
                     </optgroup>
                     <optgroup label="NHIS">
                       <option value="AL">834792874</option>
                       <option value="AR">123245</option>
                       <option value="IL">4346FFF</option>
                      <option value="IA">AASD234665</option>
                     </optgroup>                 
                    
                  </select>

                </div>
                 <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Search</button>
              </div>
            
            </form>
          </div>
        </div>
    </div>
  
	
	<div class="row">
      <div class="col-sm-6 col-md-6">
        <div class="block-flat">
          <div class="header">							
            <h3>Insert Patient's Bio </h3>
          </div>
          <div class="content">

          <form role="form"> 
            <div class="form-group">
              <label>Weight (kg)</label> <input style="width: 180px" type="weight" placeholder="" class="form-control">
            </div>
			
			<div class="form-group">
              <label>Height</label> <input style="width: 180px" type="email" placeholder="" class="form-control">
            </div>
			
			<div class="form-group">
              <label>Blood Pressure</label> <input style="width: 180px" type="email" placeholder="" class="form-control">
            </div>
			
			<div class="form-group">
              <label>FBS/RBS</label> <input style="width: 180px" type="email" placeholder="" class="form-control">
            </div>
            
           
              
              <button class="btn btn-primary pull-right" type="submit">Add Vitals</button>
              <div></div><br>
            </form>
          

        </div>				
      </div>
    </div>
    </div>
  </div> 
</div>