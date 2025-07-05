<p><?php
	get_vitals(@@$_SESSION['patient_id']);
	?>
Blood Group:	<?php echo @$_SESSION['bg'];  ?>
	
</p>
<p>
Diabetes ?	<?php echo set_diabetes(@$_SESSION['diabetes']); ?>
	
</p>
<p>
Hypertension? <?php set_hyper(@$_SESSION['hyper']); ?>
	
</p>
<p>
Epilepsy?	<?php set_epilepsy(@$_SESSION['epilepsy']); ?>
	
</p>
<p>
Allergies?	<?php set_allergies(@$_SESSION['allergies']); ?>
	
</p>
<p>
Sickle Cell?	<?php set_sickle(@$_SESSION['sickle_cell']); ?>
	
</p>
<p>
Other:	<?php echo @$_SESSION['other']; ?>
	
</p>