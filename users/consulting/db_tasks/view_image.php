<?php

require_once '../../../functions/conndb.php';
require_once '../../../functions/func_consulting.php';
require_once '../../../functions/func_common.php';
//session_start();

 // Get the note ID from the query parameter
if (isset($_GET['id'])) {
    $note_id = intval($_GET['id']);

    // Fetch the image data from the database
    $sql = "SELECT file_type, file_content FROM tbl_patient_files WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $note_id);
    $stmt->execute();
    $stmt->bind_result($file_type, $file_content);
    $stmt->fetch();
    $stmt->close();

    if ($file_content) {
        // Set the correct content type
        header("Content-Type: $file_type");
        echo $file_content;
    } else {
        echo "No image found.";
    }
} else {
    echo "Invalid request.";
}

?>