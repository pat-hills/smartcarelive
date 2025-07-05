<!DOCTYPE html>
<html lang="en">
    
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="assets/images/favicon.png">

	<title>SmartCareAid | Home </title>
	<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>-->

	<!-- Bootstrap core CSS -->
	<link href="assets/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

	<link rel="stylesheet" href="assets/fonts/font-awesome-4/css/font-awesome.min.css">

	<!-- Custom styles for this template -->
	<link href="assets/css/style.css" rel="stylesheet" />	

</head>

<body class="texture">

<div id="cl-wrapper" class="login-container">

	<div class="middle-login" style="width:50%">
		<?php
				//setting login error messages
				session_start();
				echo @$_SESSION['err_msg'];
				
				unset($_SESSION['err_msg']);
				
				$usertype = $_GET['usertype'];
				$user = $_GET['user'];
				$userid = $_GET['userid'];
				?>				
		<div class="block-flat ">
			<div class="header">
				
							
				<h3 class="text-center"><img class="logo-img" src="assets/images/logo.png" alt="logo"/>SmartCareAid</h3>
			</div>
			<div>
				<form data-parsley-validate novalidate style="margin-bottom: 0px !important;" class="form-horizontal" action="route/route.php" method="post">
					<div class="content">
						<h4 class="title" style="color:red;">Hi <?php echo $user; ?>,&nbsp;For Security reasons we entreat you to change your password,Thank You</h4>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock"></i></span>
										<input type="password" placeholder="Password" id="pass" name="pass" class="form-control" required="">
									</div>
								</div>
							</div>
							<input type="hidden" name="usertype" value="<?php echo $usertype; ?>">
							<input type="hidden" name="userid" value="<?php echo $userid; ?>">
							<input type="hidden" name="changePass" value="1">
				
							
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock"></i></span>
										<input data-parsley-equalto="#pass" type="password" placeholder="Confirm Password" id="password" name="cpass" class="form-control" required="">
									</div>
								</div>
							</div>
							
					</div>
					<div class="foot">
						<button class="btn btn-default" data-dismiss="modal" type="reset">Clear</button>
						<button class="btn btn-primary" data-dismiss="modal" type="submit">Save</button>
					</div>
				</form>
			</div>
		</div>
 
	</div> 
	
</div>

<script src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/behaviour/general.js"></script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <script src="assets/js/behaviour/voice-commands.js"></script>
  <script src="assets/js/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.flot/jquery.flot.js"></script>
<script type="text/javascript" src="assets/js/jquery.flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="assets/js/jquery.flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="assets/js/jquery.flot/jquery.flot.labels.js"></script>
<script src="assets/js/jquery.parsley/dist/parsley.min.js" type="text/javascript"></script>
<script src="assets/js/jquery.parsley/src/extra/dateiso.js" type="text/javascript"></script>

 <script type="text/javascript">
    $(document).ready(function(){
      //initialize the javascript
      App.init();
      $('form').parsley();
    });
  </script>
 
  
</body>

</html>
