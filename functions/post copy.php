<?php
declare(strict_types=1);

function my_max(array $xs): int {

    // I am using count function here
	//Basically making sure my array is not empty before i continue
	// I think for me is a good practice and checking to get things right before any set of activities or operations
    if (count($xs) === 0) {
        throw new Exception('Oops!!! Sorry your input is empty');
    }

    // I need an initial max value here
	// Should be the smallest value i think
	// So I am using PHP_INT_MIN

    $max = PHP_INT_MIN;

    // Checks done
	// Passed and ready to iterate throught the loop
	// We are looping then
	// In try / catch of course still cautions on any exceptions
	// I am cautions about security/validation etc  in programming though
    foreach ($xs as $value) {


        try {

			//Begin try
            if (is_array($value)) {

                // Let's check if its array
				// We can find the max
				//So the function is calling itself
				// Recursively here
				// to find the max value
				// Pretty simple here i think
                $nest_Max = my_max($value);
                if ($nest_Max > $max) {
                    $max = $nest_Max;
                }

            } else {

                // Else, or let me say otherwise,
				//We can compare and do an update value of the max
				// That is what is happening here
				//Pretty simple here too!
                if ($value > $max) {
                    $max = $value;
                }
            }
        } catch (Exception $e) {
            //Yes my expections
			// Would catch any expection
			//Should incase
			// And return the mininum possible value 
			// 
            echo 'Error: ' . $e->getMessage() . "\n";
            return PHP_INT_MIN; 
        }
    }

    return $max;
}