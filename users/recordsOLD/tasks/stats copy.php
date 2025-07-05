<div class="container-fluid" id="pcont">
			<div class="page-head">
				<h2>Records Landing Page</h2>
				<ol class="breadcrumb">
				  <li><a href="#">Records</a></li>
				  <li class="active"><a href="#">Home</a></li>
				  
				</ol>
			</div>		
		<div class="cl-mcont">
			<div class="row dash-cols">
				<div class="col-sm-6 col-md-12">
				
					<div class="block-flat">
						<div class="header">
							<div class="pull-right actions">
							</div>							
							<h1>Hospital Stats</h1>
						</div>
						<div class="content">
							 <div class="stats_bar">
				<div class="butpro butstyle" data-step="2" data-intro="<strong>Beautiful Elements</strong> <br/> If you are looking for a different UI, this is for you!.">
					<div class="sub"><h2>Registered Patients</h2><span id="total_clientes">
						<?php
						//calling total number of patients registered on the system 
						total_pat();
						
						?>
						
						</span></div>
					 </div>
				<div class="butpro butstyle">
					<div class="sub"><h2>NHIS Patients</h2><span>
						<?php
						//calling total number of nhis patients registered on the system 
						total_nhis();
						
						?>
						
						
						</span></div>
					
				</div>
				<div class="butpro butstyle">
					<div class="sub"><h2>Males</h2><span>
							<?php
						//calling total number of male patients  on the system 
						total_males();
						
						?>
						
						
						
						
						</span></div>
					
				</div>	
				<div class="butpro butstyle">
					<div class="sub"><h2>Females</h2><span>
						<?php
						//calling total number of female patients  on the system 
						total_females();
						
						?>
						
						</span></div>
					
				</div>	
				<div class="butpro butstyle">
					<div class="sub"><h2>Today's Visits</h2><span>
                                                <?php
						//calling total number of patients visiting today
						total_visits();
						
						?>
                                                </span></div>
					 </div>
				<div class="butpro butstyle">
                                            <div class="sub"><h2>Doctor's Available</h2><span>
                                            <?php
						//calling total number of doctors  on the system 
						total_docs();
						
						?>
                                        </span></div>
					 </div>	

			</div>
							
						</div>
					</div>
					
					
					              <div class="clearfix"></div>
						</div>
					</div>		
					
					
				</div>	