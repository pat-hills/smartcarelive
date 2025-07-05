<?php
	require '../../functions/conndb.php';
    require '../../functions/func_admin.php';
    session_start(); 

if($_POST['update']){
	
if(isset($_POST['nonNhis_members']))
{

//$nhis_members  = $_POST['nhis_members'];
$nonNhis_members = $_POST['nonNhis_members'];

if(update_consulting_fee($nhis_members=0,$nonNhis_members)){



 $_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Successfully updated</strong>
                 </div>";
                 
                 header("Location: " . $_SERVER['HTTP_REFERER']);
    

}else{

 $_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Nothing was updated</strong>
                 </div>";
               
                 header("Location: " . $_SERVER['HTTP_REFERER']);
    

}



}else{
 $_SESSION['err_msg'] = "<div class='alert alert-danger alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>All the feilds are required</strong>
                 </div>";
                 
                 header("Location: " . $_SERVER['HTTP_REFERER']);
    

}











}else{
	
if(isset($_POST['nonNhis_members']))
{

//$nhis_members  = $_POST['nhis_members'];
$nonNhis_members = $_POST['nonNhis_members'];

if(create_consulting_fee($nhis_members=0,$nonNhis_members)){



 $_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Successfully created</strong>
                 </div>";
                 
                 header("Location: " . $_SERVER['HTTP_REFERER']);
    

}else{

 $_SESSION['err_msg'] = "<div class='alert alert-warning alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>Unable to create consulting tariffs</strong>
                 </div>";
               
                 header("Location: " . $_SERVER['HTTP_REFERER']);
    

}



}else{
 $_SESSION['err_msg'] = "<div class='alert alert-danger alert-white rounded'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <div class='icon'><i class='fa fa-check'></i></div>
                  <strong>All the feilds are required</strong>
                 </div>";
                 
                 header("Location: " . $_SERVER['HTTP_REFERER']);
    

}
}


?>