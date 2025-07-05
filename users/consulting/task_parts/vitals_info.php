<?php
//calling 
require_once "../../functions/func_consulting.php";
 get_bio(@$_SESSION['patient_id']);

?>
<p>
Weight:
	<?php
	echo @$_SESSION['weight'];
	?>
</p>
<p>
Blood Pressure:
	<?php
	echo @$_SESSION['blood_pressure'];
	?>
</p>
<p>
Height (M):
	<?php
	echo @$_SESSION['height'];
	?>
</p>
<p>
Temperature:
	<?php
	echo @$_SESSION['temperature'];
	?>
</p>
<p>
BMI:
	<?php
	echo @$_SESSION['bmi'];
	?>
</p>
<p>
Date Taken:
	<?php
	echo @$_SESSION['date_taken'];
	?>
</p>
