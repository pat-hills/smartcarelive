$(document).ready(function(){

var getURL = $('#getBaseUrl').attr('action');


$('#saveServices').on('click',function(e){

var pharm  = '';
if($('#pharm').is(':checked'))
{
pharm =1; 
}else{
pharm = 0;
}

var servicea = $('input[name=servicea]:checked').val();
var serviceb = $('input[name=serviceb]:checked').val();


if(serviceb ==''|| serviceb ==undefined || servicea =='' || servicea ==undefined){
alert('All feilds are required');
e.preventDefault();
}


var dataString ='servicea='+servicea+'&serviceb='+serviceb+'&pharm='+pharm; 

$.ajax({
url:getURL,
type:"POST",
data:dataString,
cache: false,
success:function(result){

 if(result){
	 $('#saveServices').hide();
 	 $('#EditServices').show();
 }else{
 alert('unable to save data');
 }

},
error:function(){
alert('srver errors');
}

});


});


$('#EditServices').on('click',function(){
var pharm;
if($('#pharm').is(':checked'))
{
pharm =1; 
}else{
pharm = 0;
}

var servicea = $('input[name=servicea]:checked').val();
var serviceb = $('input[name=serviceb]:checked').val();
var service_code = $('#service_code').val();


if(serviceb ==''|| serviceb ==undefined || servicea =='' || servicea ==undefined || service_code==''){
alert('All feilds are required');
e.preventDefault();
}


var dataString ='servicea='+servicea+'&serviceb='+serviceb+'&pharm='+pharm+'&service_code='+service_code; 

$.ajax({
url:'tasks/update_services.php',
type:"POST",
data:dataString,
cache: false,
success:function(result){

 if(result){
	 //alert('successfully updated');
 	 $('#EditServices').show();
 }else{
	alert('unable to update');
 }

},
error:function(){
alert('srver errors');
}

});
});



//////////////////////send drug to cashier/////////
//get the drugcode
$('.ajaxDrugCode').on('click',function(){
var drugcode = $(this).attr('id');
var patient_id = $('#patient_id').val();
var totalcost = $('#totalcost').val();
var uid = $('#uid').val();
var seldrugcodes = $('#seldrugcodes').val();
var dataString = 'drugcode='+drugcode+'&patient_id='+patient_id+'&totalcost='+totalcost
				 '&seldrugcodes='+seldrugcodes+'&uid='+uid;	
$.ajax({
url:getURL+'/ajaxProcessing.php',
type:"POST",
data:dataString,
cache: false,
//dataType:'text',
success:function(result){
  alert(result);
//console.log(dme);
//if(result == 1){alert('aa yes');}else{alert('mike no');}

},
error:function(){
alert('yawa');
}

});
});


$('.senddata').on('click',function(){
alert('Data sent can not be undo');
});


$('#saveoutcome').on('click',function(e){
var outcome = $('input[name=outcome]:checked').val();

if(outcome =="" || outcome==undefined){alert('select one outcome');e.preventDefault();}


$.ajax({
url:'tasks/add_outcome.php',
type:"POST",
data:'outcome='+outcome,
cache: false,
success:function(result){

 if(result){
	 $('#saveoutcome').hide();
 	 $('.Editoutcome').show();
 }else{
	alert('unable to save');
 }

},
error:function(){
alert('srver errors');
}

});

});




$('.Editoutcome').on('click',function(e){

var outcome = $('input[name=outcome]:checked').val();
var outcome_code = $('#outcome_code').val();

if(outcome =="" || outcome==undefined || 
   outcome_code =="" || outcome_code==undefined ){alert('select one outcome'); e.preventDefault();}
 
 var dataString = 'outcome='+outcome+'&outcome_code='+outcome_code;

$.ajax({
url:'tasks/update_outcome.php',
type:"POST",
data:dataString,
cache: false,
success:function(result){
alert(result);
 if(result){
	
 	 $('.Editoutcome').show();
 }else{
	alert('unable to save');
 }

},
error:function(){
alert('srver errors');
}

});

});




$('#saveAttendance').on('click',function(e){

var Attendance = $('input[name=Attendance]:checked').val();
var Specialitycode = $('#Specialitycode').val();

if(Attendance =="" || Attendance==undefined || Specialitycode =="" || Specialitycode==undefined)
{alert('select one outcome');e.preventDefault();}
var dataString = 'Attendance='+Attendance+'&Specialitycode='+Specialitycode;


$.ajax({
url:'tasks/add_attendance.php',
type:"POST",
data:dataString,
cache: false,
success:function(result){

 if(result){
	 $('#saveAttendance').hide();
 	 $('#EditAttendance').show();
 }else{
	alert('unable to save');
 }

},
error:function(){
alert('srver errors');
}

});

});




$('#EditAttendance').on('click',function(e){

var Attendance = $('input[name=Attendance]:checked').val();
var Specialitycode = $('#Specialitycode').val();
var attendance_code = $('#attendance_code').val();

if(Attendance =="" || Attendance==undefined || Specialitycode =="" || Specialitycode==undefined)
{alert('select one outcome');e.preventDefault();}
var dataString = 'Attendance='+Attendance+'&Specialitycode='+Specialitycode+'&attendance_code='+attendance_code;


$.ajax({
url:'tasks/update_attendance.php',
type:"POST",
data:dataString,
cache: false,
success:function(result){
console.log(result);
 if(result){
	// $('#saveAttendance').hide();
 	 $('#EditAttendance').show();
 }else{
	alert('unable to save');
 }

},
error:function(){
alert('srver errors');
}

});

});



$('#saveDateProvision').on('click',function(e){
var v1 = $('#v1').val();
var v2 = $('#v2').val();
var v3 = $('#v3').val();
var v4 = $('#v4').val();
var duOfsp = $('#duOfsp').val();

/*if(v1 =="" || v1==undefined || v2 =="" || v2==undefined || v3 =="" || v3==undefined || v4 =="" || v4==undefined || duOfsp =="" || duOfsp==undefined)
{alert('select one outcome'); e.preventDefault();}
*/
var dataString = 'v1='+v1+'&v2='+v2+'&v3='+v3+'&v4='+v4+'&duOfsp='+duOfsp;


$.ajax({
url:'tasks/add_DateProvision.php',
type:"POST",
data:dataString,
cache: false,
success:function(result){

 if(result){
	 $('#saveDateProvision').hide();
 	 $('#editDateProvision').show();
 }else{
	alert('unable to save');
 }

},
error:function(){
alert('srver errors');
}

});

});




$('#editDateProvision').on('click',function(e){
var v1 = $('#v1').val();
var v2 = $('#v2').val();
var v3 = $('#v3').val();
var v4 = $('#v4').val();
var duOfsp = $('#duOfsp').val();
var visitcode = $('#visitcode').val();

/*if(v1 =="" || v1==undefined || v2 =="" || v2==undefined || v3 =="" || v3==undefined || v4 =="" || v4==undefined || duOfsp =="" || duOfsp==undefined)
{alert('select one outcome'); e.preventDefault();}
*/
var dataString = 'v1='+v1+'&v2='+v2+'&v3='+v3+'&v4='+v4+'&duOfsp='+duOfsp+'&visitcode='+visitcode;


$.ajax({
url:'tasks/update_DateProvision.php',
type:"POST",
data:dataString,
cache: false,
success:function(result){

 if(result){
	 //$('#saveDateProvision').hide();
 	 $('#editDateProvision').show();
 }else{
	alert('unable to save');
 }

},
error:function(){
alert('srver errors');
}

});

});



 
$('.get4model').on('click',function(e){
var thePatients = $(this).attr('id');
var dataString = 'patient_id='+thePatients;

$.ajax({
url:'tasks/getPatientsClaims.php',
type:"POST",
data:dataString,
cache: false,
success:function(result){
console.log(result);
 if(result){
	 //$('#saveDateProvision').hide();
 	 $('.patientstheModels').html(result);
 }else{
	alert('unable to save');
 }

},
error:function(){
alert('srver errors');
}

});

});

 
 
 

$('#PaulAutoAjustMike').css('font-size','10px');
var paul = $('#PaulAutoAjustMike').val();
var somePaul = paul.length;
if(somePaul > 28){
var x = somePaul;
var fx = 15-(x/8);
$('#PaulAutoAjustMike').css('font-size',fx);
}





////////////////






});//killed engine