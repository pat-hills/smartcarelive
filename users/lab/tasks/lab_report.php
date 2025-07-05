<?php
//session_start();
//require_once '../../functions/func_search.php';
//require_once '../../functions/func_consulting.php';

@$id = $_GET['code']; //lab request code
@$patient_id = $_GET['patient_id']; //lab request code


$get_haematology = get_haematology($patient_id,$id);
$general_microbiology = general_microbiology($patient_id,$id);
urine_re($patient_id,$id);
widal_test($patient_id,$id);
stool_re($patient_id,$id);
hvs_wet_prep($patient_id,$id);
gram_stain($patient_id,$id);
skin_snip($patient_id,$id);

$lab_technician_as_staff = requesting_doctor($_SESSION['uid']);
?>


       <div class="table_bg">
       <table border="1" style="width: 60%;" cellpadding="2" cellspacing="1">
          
           
         <tr class="f1">
             <td colspan="6">Smart Care Patient Hospital<wbr/> <br> Ogbojo - East Legon, Accra <br /> Patient Medical Laboratory Report</td>
           
         </tr>
         
         <tr>
             <td colspan="3">Patient: <?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?></td>
             <td>Age: <?php get_age(@$_SESSION['dob']);echo" years";?></td>
             <td>Sex:<?php echo @$_SESSION['sex']; ?></td>
             <td>LAB No. <?php echo @$_GET['code']; ?>:</td>
             
             
         </tr>
         
          <tr>
             <td colspan="4">Clinical Details/Diagnosis: </td>
             <td colspan="2">Dept: </td>
            
         </tr>
         
         <tr>
             <td colspan="4">Clinical Name/Signature: </td>
             <td colspan="2">Date: <?php
             
              if(isset(   $_SESSION['PROCESSED_DATE'] ) && !empty(   $_SESSION['PROCESSED_DATE'] )){
                   echo    $_SESSION['PROCESSED_DATE'];
              }
             
             ?> </td>
            
         </tr>
         
         <!-- HAEMATOLOGY -->
         <tr class="f1">
             <td colspan="6">Please indicate by ticking test(s) request<br /> HAEMATOLOGY</td>
            
         </tr>
         
          <tr>
             <td colspan="3" width="">Test: </td>
             <td>Normal <br> Range: </td>
             <td colspan="2">Test</td>
             
         </tr>
         <tr>
             <td colspan="3" width="">Hb: <?php if(isset($get_haematology['hb'])) { echo "<strong><span class='label label-success'>". $get_haematology['hb']."</strong></span>";}?> </td>
             <td> 11 - 18 </td>
             <td colspan="2">Sickling:  <?php if(isset($get_haematology['sickling'])) { echo "<strong><span class='label label-success'>". $get_haematology['sickling']."</strong></span>";}?></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">PCV: <?php if(isset($get_haematology['pcv'])) { echo "<strong><span class='label label-success'>". $get_haematology['pcv']."</strong></span>";}?></td>
             <td> 41 - 45</td>
             <td colspan="2">Retics: <?php if(isset($get_haematology['retics'])) { echo "<strong><span class='label label-success'>". $get_haematology['retics']."</strong></span>";}?></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">T(WBC) count: <?php if(isset($get_haematology['t_wbc_count'])) { echo "<strong><span class='label label-success'>". $get_haematology['t_wbc_count']."</strong></span>";}?></td>
             <td> 4 - 10 </td>
             <td colspan="2">Hb Electrophoresis: <?php if(isset($get_haematology['hb_elec'])) { echo "<strong><span class='label label-success'>". $get_haematology['hb_elec']."</strong></span>";}?></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">Neutrophils: <?php if(isset($get_haematology['neutrophils'])) { echo "<strong><span class='label label-success'>". $get_haematology['neutrophils']."</strong></span>";}?></td>
             <td> 40 - 70 </td>
             <td colspan="2"></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">Lymphocytes: <?php if(isset($get_haematology['lymphocytes'])) { echo "<strong><span class='label label-success'>". $get_haematology['lymphocytes']."</strong></span>";}?></td>
             <td> 20 - 50 </td>
             <td colspan="2">ESR : <?php if(isset($get_haematology['esr'])) { echo "<strong><span class='label label-success'>". $get_haematology['esr']."</strong></span>";}?></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">Monocytes: <?php if(isset($get_haematology['monocytes'])) { echo "<strong><span class='label label-success'>". $get_haematology['monocytes']."</strong></span>";}?></td>
             <td> 2 - 10 </td>
             <td colspan="2">G6PD: <?php if(isset($get_haematology['g6pd'])) { echo "<strong><span class='label label-success'>". $get_haematology['g6pd']."</strong></span>";}?></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">Eosinophils: <?php if(isset($get_haematology['eosinophils'])) { echo "<strong><span class='label label-success'>". $get_haematology['eosinophils']."</strong></span>";}?></td>
             <td> 1 - 6 </td>
             <td colspan="2">Blood Group: <?php if(isset($get_haematology['blood_group'])) { echo "<strong><span class='label label-success'>". $get_haematology['blood_group']."</strong></span>";}?></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">Basophils: <?php if(isset($get_haematology['basophils'])) { echo "<strong><span class='label label-success'>". $get_haematology['basophils']."</strong></span>";}?></td>
             <td> 0 - 1 </td>
             <td colspan="2">FBS: <?php if(isset($get_haematology['fbs'])) { echo "<strong><span class='label label-success'>". $get_haematology['fbs']."</strong></span>";}?></td>
             
             
             
         </tr>  
         <tr>
             <td colspan="3"></td>
             <td> </td>
             <td colspan="2">RBS: <?php if(isset($get_haematology['rbs'])) { echo "<strong><span class='label label-success'>". $get_haematology['rbs']."</strong></span>";}?></td>
             
             
             
         </tr>

         <tr>
             <td colspan="3"></td>
             <td> </td>
             <td colspan="2">Malaria Parasites: <?php if(isset($get_haematology['malaria_parasites'])) { echo "<strong><span class='label label-success'>". $get_haematology['malaria_parasites']."</strong></span>";}?></td>
             
             
             
         </tr>
          <!-- HAEMATOLOGY ends-->
          
           <!-- MICROBIOLOGY -->  
         <tr class="f1">
             <td colspan="6"> MICROBIOLOGY </td>
             
             
             
             
             
         </tr>
         
         <tr>
             <td colspan="3" width="">URINE R/E Appearance: <?php if(isset($_SESSION['app'])) { echo "<strong><span class='label label-success'>". @$_SESSION['app']."</strong></span>";}?></td>
             <td colspan="3">pus Cells: <?php echo "<strong><span class='label label-success'>". $general_microbiology['pus_cells']."</strong></span>"?></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Colour: <?php if(isset($_SESSION['colour'])) { echo "<strong><span class='label label-success'>". @$_SESSION['colour']."</strong></span>";}?></td>
             <td colspan="3">RBC's: <?php  echo "<strong><span class='label label-success'>". $general_microbiology['rbcs']."</strong></span>";?><strong><?php  echo @$_SESSION['rbcs'];?></td>
             
             
             
             
         </tr>  
         
         <tr>
             <td colspan="3" width="">Specific Gravity: <?php if(isset($_SESSION['spec_g'])) { echo "<strong><span class='label label-success'>". @$_SESSION['spec_g']."</strong></span>";}?></td>
             <td colspan="3">Epith Cells: <?php  echo "<strong><span class='label label-success'>". $general_microbiology['epith_cells']."</strong></span>";?></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">pH: <?php if(isset($_SESSION['ph'])) { echo "<strong><span class='label label-success'>". @$_SESSION['ph']."</strong></span>";}?>
             <td colspan="3">T. Vaginalis: <?php echo "<strong><span class='label label-success'>". $general_microbiology['t_vaginalis']."</strong></span>";?></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Protein: <?php if(isset($_SESSION['protein'])) { echo "<strong><span class='label label-success'>". @$_SESSION['protein']."</strong></span>";}?></td>
             <td colspan="3">Bacteriodes: <?php  echo "<strong><span class='label label-success'>".$general_microbiology['bacteriodes']."</strong></span>";?></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Glucose: <?php if(isset($_SESSION['glucose'])) { echo "<strong><span class='label label-success'>". @$_SESSION['glucose']."</strong></span>";}?></td>
             <td colspan="3">Yeast Cells: <?php echo "<strong><span class='label label-success'>".$general_microbiology['yeast_cells']."</strong></span>";?></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Ketones: <?php if(isset($_SESSION['ketones'])) { echo "<strong><span class='label label-success'>". @$_SESSION['ketones']."</strong></span>";}?> </td>
             <td colspan="3">S.H/masoni: <?php  echo "<strong><span class='label label-success'>". $general_microbiology['s_h_masoni']."</strong></span>";?></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Blood: <?php if(isset($_SESSION['blood'])) { echo "<strong><span class='label label-success'>". @$_SESSION['blood']."</strong></span>";}?> </td>
             <td colspan="3">Crystals: <?php echo "<strong><span class='label label-success'>".$general_microbiology['crystals']."</strong></span>";?></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Nitrite: <?php if(isset($_SESSION['nitrite'])) { echo "<strong><span class='label label-success'>". @$_SESSION['nitrite']."</strong></span>";}?></td>
             <td colspan="3">Casts: <?php  echo "<strong><span class='label label-success'>".$general_microbiology['casts']."</strong></span>";?></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Bilirubin: <strong><?php  echo @$_SESSION['bilirubin'];?></strong></td>
             <td colspan="3">Blood Filming: <strong><?php  echo $general_microbiology['blood_filming'];?></strong></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Urobilinogen: <?php if(isset($_SESSION['urobilinogen'])) { echo "<strong><span class='label label-success'>". @$_SESSION['urobilinogen']."</strong></span>";}?><strong></td>
             <td colspan="3"></td>
             
             
             
             
         </tr>  
         
          <tr >
             <td colspan="3"> </td>
             <td colspan="3">HBsAg: <?php  echo "<strong><span class='label label-success'>". $general_microbiology['hbsag']."</strong></span>";?></td>
             
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">STOOL R/E: Macroscopy: <?php if(isset($_SESSION['macroscopy'])) { echo "<strong><span class='label label-success'>". @$_SESSION['macroscopy']."</strong></span>";}?></td>
             <td colspan="3">VDRL/KAHN: <?php  echo "<strong><span class='label label-success'>".$general_microbiology['vdrl_kahn']."</strong></span>";?></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;Microscopy: <?php if(isset($_SESSION['microscopy'])) { echo "<strong><span class='label label-success'>". @$_SESSION['microscopy']."</strong></span>";}?></td>
             <td colspan="3">URINE PREG TEST: <?php  echo "<strong><span class='label label-success'>". $general_microbiology['urine_preg_test']."</strong></span>";?></td>
             
         </tr>  
          <tr class="f1">
             <td colspan="6"> &nbsp;</td>
             
         </tr>
         <tr >
             <td colspan="3">Pus Cells:   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/HPF/RBC:   </td>
             <td colspan="3"></td>
             
             
         </tr>
         <tr class="f1">
             <td colspan="3">HVS(WET PREP): </td>
             <td colspan="3">WIDAL TEST </td>
             
         </tr>  
         <tr>
             <td colspan="0">Pus Cells: <?php if(isset($_SESSION['hvs_pus_cells'])) { echo "<strong><span class='label label-success'>". @$_SESSION['hvs_pus_cells']."</strong></span>";}?></td>
             <td colspan="2">EC: <?php if(isset($_SESSION['hvs_ec'])) { echo "<strong><span class='label label-success'>". @$_SESSION['hvs_ec']."</strong></span>";}?></td>
             <td colspan="3">S typhi 'O': <?php if(isset($_SESSION['s_typhi_o'])) { echo "<strong><span class='label label-success'>". @$_SESSION['s_typhi_o']."</strong></span>";}?> </td>
             
             
             
         </tr>  
         <tr>
             <td colspan="3">RBC: <?php if(isset($_SESSION['hvs_rbc'])) { echo "<strong><span class='label label-success'>". @$_SESSION['hvs_rbc']."</strong></span>";}?></td>
             <td colspan="3">S typhi 'H': <?php if(isset($_SESSION['s_typhi_h'])) { echo "<strong><span class='label label-success'>". @$_SESSION['s_typhi_h']."</strong></span>";}?>  </td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" >ORGANISM(S) (1): <?php if(isset($_SESSION['hvs_organism_one'])) { echo "<strong><span class='label label-success'>". @$_SESSION['hvs_organism_one']."</strong></span>";}?></td>
             
             <td colspan="3">Comment: </td>
             
             
             
             
         </tr>  
         
         <tr>
             <td colspan="3">GRAM STAIN: </td>
             <td colspan="3" rowspan="3">SKIN SNIP/SCRAPPING FOR FUNGAL ELE: <br/><br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($_SESSION['remarks'])) { echo "<strong><span class='label label-success'>". @$_SESSION['remarks']."</strong></span>";}?></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="0">Pus Cells: <?php if(isset($_SESSION['gs_pus'])) { echo "<strong><span class='label label-success'>". @$_SESSION['gs_pus']."</strong></span>";}?></td>
             <td colspan="2"> EC: <?php if(isset($_SESSION['gs_ec'])) { echo "<strong><span class='label label-success'>". @$_SESSION['gs_ec']."</strong></span>";}?></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3">ORGANISM(S) (1): <?php if(isset($_SESSION['gs_org_1'])) { echo "<strong><span class='label label-success'>". @$_SESSION['gs_org_1']."</strong></span>";}?></td>
             
         </tr>  
          <!-- MICROBIOLOGY ends--> 
          
         <tr>
             <td colspan="3">BIOMEDICAL SCIENTIST SIGNATURE: <?php echo $lab_technician_as_staff['firstName']." ".$lab_technician_as_staff['otherNames']?> </td>
             <td colspan="3">DATE: </td>
             
             
             
         </tr>  
       </table>

       </div>
       
 