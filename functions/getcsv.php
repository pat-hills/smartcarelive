<?php

//error_reporting(E_ERROR | E_PARSE);
function get_csv_assoc_array($file_path, $questions) {
    $q_location = array();
    $final_array = array();
    $row = 0;
    if (($handle = fopen($file_path, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, "", ",")) !== FALSE) {
            if ($row == 0) {
                foreach ($questions as $key => $value) {
                    foreach ($data as $d_key => $d_value) {
                        if ($data[$d_key] == $value) {
                            $q_location[$value] = $d_key;
                        }
                    }
                }
            } else {
                foreach ($questions as $key => $value) {
                    $new_row = $row - 1;
                    $final_array[$new_row][$value] = $data[$q_location[$value]];
                }
            }

            if (!empty($q_location)) {
                $row++;
            } else {
                return $final_array;
            }
        }
        fclose($handle);
    }
    return $final_array;
}

?>