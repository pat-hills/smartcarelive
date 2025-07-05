<?php
//session_start();
//require_once '../../functions/func_search.php';
//require_once '../../functions/func_consulting.php';

$id = $_GET['code']; //lab request code

get_haematology($_SESSION['patient_id'],$id);
general_microbiology($_SESSION['patient_id'],$id);
urine_re($_SESSION['patient_id'],$id);
widal_test($_SESSION['patient_id'],$id);
stool_re($_SESSION['patient_id'],$id);
hvs_wet_prep($_SESSION['patient_id'],$id);
gram_stain($_SESSION['patient_id'],$id);
skin_snip($_SESSION['patient_id'],$id);
?>


       <div class="table_bg">
       <table border="1" style="width: 60%;" cellpadding="2" cellspacing="1">
          
           
         <tr class="f1">
             <td colspan="6">TAFO GOVERNMENT HOSPITAL<wbr/> <br> Old Tafo-Kumasi <br /> LABORATORY REPORT</td>
           
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
             <td colspan="2">Date: </td>
            
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
             <td colspan="3" width="">Hb: <strong><?php  echo @$_SESSION['hb'];?> </strong></td>
             <td> 11 - 18 </td>
             <td colspan="2">Sickling: <strong><?php  echo @$_SESSION['sickling'];?> </strong></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">PCV: <strong><?php  echo @$_SESSION['pcv'];?> </strong> </td>
             <td> 41 - 45</td>
             <td colspan="2">Retics: <strong><?php  echo @$_SESSION['retics'];?> </strong></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">T(WBC) count: <strong><?php  echo @$_SESSION['t_wbc_count'];?> </strong> </td>
             <td> 4 - 10 </td>
             <td colspan="2">Hb Electrophoresis: <strong><?php  echo @$_SESSION['hb_elec'];?> </strong></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">Neutrophils: <strong><?php  echo @$_SESSION['neutrophils'];?> </strong> </td>
             <td> 40 - 70 </td>
             <td colspan="2"></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">Lymphocytes: <strong><?php  echo @$_SESSION['lymphocytes'];?> </strong> </td>
             <td> 20 - 50 </td>
             <td colspan="2">ESR :<strong><?php  echo @$_SESSION['esr'];?> </strong> </td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">Monocytes: <strong><?php  echo @$_SESSION['monocytes'];?> </strong> </td>
             <td> 2 - 10 </td>
             <td colspan="2">G6PD: <strong><?php  echo @$_SESSION['g6pd'];?> </strong> </td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">Eosinophils: <strong><?php  echo @$_SESSION['eosinophils'];?> </strong> </td>
             <td> 1 - 6 </td>
             <td colspan="2">Blood Group: <strong><?php  echo @$_SESSION['blood_group'];?> </strong></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">Basophils: <strong><?php  echo @$_SESSION['basophils'];?> </strong> </td>
             <td> 0 - 1 </td>
             <td colspan="2">FBS: <strong><?php  echo @$_SESSION['fbs'];?> </strong></td>
             
             
             
         </tr>
         <tr>
             <td colspan="3"></td>
             <td> </td>
             <td colspan="2">RBS: <strong><?php  echo @$_SESSION['rbs'];?> </strong></td>
             
             
             
         </tr>
          <!-- HAEMATOLOGY ends-->
          
           <!-- MICROBIOLOGY -->  
         <tr class="f1">
             <td colspan="6"> MICROBIOLOGY </td>
             
             
             
             
             
         </tr>
         
         <tr>
             <td colspan="3" width="">URINE R/E Appearance: <strong><?php  echo @$_SESSION['app'];?> </strong> </td>
             <td colspan="3">pus Cells: <strong><?php  echo @$_SESSION['pus_cells'];?> </strong> </td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Colour: <strong><?php  echo @$_SESSION['colour'];?> </strong> </td>
             <td colspan="3">RBC's: <strong><?php  echo @$_SESSION['rbcs'];?> </strong> </td>
             
             
             
             
         </tr>  
         
         <tr>
             <td colspan="3" width="">Specific Gravity: <strong><?php  echo @$_SESSION['spec_g'];?> </strong> </td>
             <td colspan="3">Epith Cells: <strong><?php  echo @$_SESSION['epith_cells'];?> </strong> </td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">pH: <strong><?php  echo @$_SESSION['ph'];?> </strong> </td>
             <td colspan="3">T. Vaginalis: <strong><?php  echo @$_SESSION['t_vaginalis'];?> </strong>  </td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Protein: <strong><?php  echo @$_SESSION['protein'];?> </strong> </td>
             <td colspan="3">Bacteriodes: <strong> <?php  echo @$_SESSION['bacteriodes'];?> </strong> </td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Glucose: <strong><?php  echo @$_SESSION['glucose'];?> </strong> </td>
             <td colspan="3">Yeast Cells: <strong><?php  echo @$_SESSION['yeast_cells'];?> </strong>  </td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Ketones: <strong><?php  echo @$_SESSION['ketones'];?> </strong>  </td>
             <td colspan="3">S.H/masoni::<strong><?php  echo @$_SESSION['s_h_masoni'];?></strong> </td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Blood: <strong> <?php  echo @$_SESSION['blood'];?></strong> </td>
             <td colspan="3">Crystals: <strong> <?php  echo @$_SESSION['crystals'];?> </strong></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Nitrite: <strong><?php  echo @$_SESSION['nitrite'];?></strong> </td>
             <td colspan="3">Casts: <strong><?php  echo @$_SESSION['casts'];?></strong></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Bilirubin: <strong><?php  echo @$_SESSION['bilirubin'];?></strong></td>
             <td colspan="3">Blood Filming: <strong><?php  echo @$_SESSION['blood_filming'];?></strong></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">Urobilinogen: <strong><?php  echo @$_SESSION['urobilinogen'];?></strong> </td>
             <td colspan="3"></td>
             
             
             
             
         </tr>  
         
          <tr >
             <td colspan="3"> </td>
             <td colspan="3">HBsAg: <strong> <?php  echo @$_SESSION['hbsag'];?></strong></td>
             
             
             
             
         </tr>
         <tr>
             <td colspan="3" width="">STOOL R/E: Macroscopy: <strong> <?php  echo @$_SESSION['macroscopy'];?> </strong></td>
             <td colspan="3">VDRL/KAHN: <strong> <?php  echo @$_SESSION['vdrl_kahn'];?> </strong></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" width="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;Microscopy: <strong> <?php  echo @$_SESSION['microscopy'];?> </strong> </td>
             <td colspan="3">URINE PREG TEST: <strong><?php  echo @$_SESSION['urine_preg'];?></strong></td>
             
             
             
             
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
             <td colspan="0">Pus Cells: <strong><?php  echo @$_SESSION['hvs_pus_cells'];?></strong> </td>
             <td colspan="2">EC: <strong><?php  echo @$_SESSION['hvs_ec'];?></strong></td>
             <td colspan="3">S typhi 'O': <strong><?php  echo @$_SESSION['s_typhi_o'];?> </strong>  </td>
             
             
             
         </tr>  
         <tr>
             <td colspan="3">RBC: <strong><?php  echo @$_SESSION['hvs_rbc'];?></strong></td>
             <td colspan="3">S typhi 'H': <strong><?php  echo @$_SESSION['s_typhi_h'];?> </strong> </td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3" >ORGANISM(S) (1): <strong><?php  echo @$_SESSION['hvs_organism_one'];?></strong>
             <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2):<strong><?php  echo @$_SESSION['hvs_organism_two'];?></strong> </td>
            
             <td colspan="3">Comment: </td>
             
             
             
             
         </tr>  
         
         <tr>
             <td colspan="3">GRAM STAIN: </td>
             <td colspan="3" rowspan="3">SKIN SNIP/SCRAPPING FOR FUNGAL ELE: <br/><strong><?php  echo @$_SESSION['remarks'];?></strong></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="0">Pus Cells:<strong><?php  echo @$_SESSION['gs_pus'];?></strong> </td>
             <td colspan="2"> EC: <strong><?php  echo @$_SESSION['gs_ec'];?></strong></td>
             
             
             
             
         </tr>  
         <tr>
             <td colspan="3">ORGANISM(S) (1): <strong><?php  echo @$_SESSION['gs_org_1'];?></strong>
             <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2): <strong><?php  echo @$_SESSION['gs_org_2'];?></strong> </td>
           
             
             
             
             
         </tr>  
          <!-- MICROBIOLOGY ends--> 
          
         <tr>
             <td colspan="3">BIOMEDICAL SCIENTIST SIGNATURE: </td>
             <td colspan="3">DATE: </td>
             
             
             
             
         </tr>  
       </table>

       </div>
       
 