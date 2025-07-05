 <script src="../../assets/js/jquery.js"></script>
  
  <script src="../../assets/js/jquery.select2/select2.min.js" type="text/javascript"></script>
  
  <script src="../../assets/js/jquery.icheck/icheck.min.js" type="text/javascript"></script>
  
  <script src="../../assets/js/jquery.parsley/dist/parsley.js" type="text/javascript"></script>
  <script src="../../assets/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
  <script src="../../assets/js/modernizr.js" type="text/javascript"></script>
  <script src="../../assets/js/jquery.maskedinput/jquery.maskedinput.js" type="text/javascript"></script>
  <script type="text/javascript" src="../../assets/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="../../assets/js/bootstrap.switch/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="../../assets/js/jquery.nestable/jquery.nestable.js"></script>
	<script type="text/javascript" src="../../assets/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="../../assets/js/behaviour/general.js"></script>
  <script src="../../assets/js/jquery.ui/jquery-ui.js" type="text/javascript"></script>

   
  <script type="text/javascript" src="../../assets/js/jquery.datatables/jquery.datatables.min.js"></script>

<script type="text/javascript" src="../../assets/js/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>
  <script type="text/javascript" src="../../assets/js/jquery.niftymodals/js/jquery.modalEffects.js"></script>    

 


<script type="text/javascript">
    $(function() {
      
        $("#drug_table_records").dataTable();
     
    });

	$(function() {
      
	  $("#myReport").dataTable();
   
  });

  $(function() {
      
	  $("#getPatientsWithNoPrescriptionRows").dataTable();
   
  });

    
    
</script>

 
  
  <script type="text/javascript">
  
      $(document).ready(function(){
        
var errorIndicator = $('#errorIndicator').val();
if(errorIndicator == 1){
$('.tablfocontent').html("<strong style='font-size:20px;color:red;'>No prescription for patient</strong>");
}

///////////////////////////////////////////////////////////////////
$('input:checkbox').hide();





$('button.add').on('click',function(){
var id=$(this).attr('id');

//name holds values
var btnName=$(this).attr('name');

//var keepqty=$('input.'+id).val();
//localStorage.setItem('qty',keepqty);

var rembtn=$("button#"+id+'.remove');
$(this).hide()
rembtn.show()

$('input.code#'+id).val(id);
var getqty=localStorage.getItem(id);
$('input.'+id).val(getqty);

$('input.'+id).fadeIn(1000);

//doing calculations

var getSubprice=$('input#priceScreen').val();
//var getsubprice=$('input#pricescreen').val();

var subprice=parseFloat(getSubprice);
var price=parseFloat(btnName);
var amt=subprice+price;



$('input#priceScreen').val(amt.toPrecision(5));
$('strong#pricescreen').html(amt.toPrecision(5)).prepend(' &#x20B5; ');
$("input."+id+"[name='remainqty[]']").hide();
return false;
})		
     

	  

$('button.remove').on('click',function(){
var id=$(this).attr('id');
//name holds values
var keepqty=$('input.'+id).val();
$('input.'+id).hide();
var getqty=localStorage.setItem(id,keepqty);
var btnName=$(this).attr('name');
var addBtn=$("button#"+id+'.add');
addBtn.show()
$(this).hide();

$('input.code#'+id).val('');

var getSubprice=$('#priceScreen').val();
var subprice=parseFloat(getSubprice);
var price=parseFloat(btnName);
var amt=subprice-price;

var qtz=$('input.'+id).val('');
if(amt<1){
amt=0;
}
$('input#priceScreen').val(amt.toPrecision(5));
$('strong#pricescreen').html(amt.toPrecision(5)).prepend(' &#x20B5; ');
return false;
});	
      


	  //doing the calculation on the change of the quantity of drug offered
	  
	var oriPrice=$('input#priceScreen').val()
	var stoPrice=localStorage.setItem('op',oriPrice);  
	
	$('input').on('change',function(){

	var Subprice=$('input#priceScreen').val();	
	var id= $(this).attr('id');
	var iv= $(this).val();
	var tdv=$('td#'+id).html();
	var tdu=$('td.'+id).html();
	
	if(iv==''||iv==undefined||iv==null){
		iv=0;
		tdu=0;
	}
	
	if(iv>tdv){
	alert('Please watch UR VALUES ');
	$(this).val('').focus();
	
	}else{
	var getstoPrice=localStorage.getItem('op');
	var price=(tdv-iv)*tdu;
	var drugtobuy=tdv-iv;
	$("input."+id+"[name='remainqty[]']").val(drugtobuy);
	
	localStorage.setItem(id,drugtobuy +' to buy');
	var newPrice=parseFloat(getstoPrice)-price;
	$('input#priceScreen').val(newPrice.toPrecision(5));
	$('strong#pricescreen').html(newPrice.toPrecision(5)).prepend(' &#x20B5; ');
	
	}
	
		
	})
	
	 //initialize the javascript
        App.init();
        App.dataTables();  
	  
});




  </script>
  
  
   <script src="../../assets/js/custom.js"></script>
   
    <script src="../../assets/js/behaviour/voice-commands.js"></script>
      <script src="../../assets/js/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="../../assets/js/jquery.gritter/js/jquery.gritter.js"></script>
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
</body>

<!-- Mirrored from foxypixel.net/cleanzone/form-wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Jul 2014 16:22:01 GMT -->
</html>
