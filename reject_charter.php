<?php
include 'config.php';

if (isset($_POST['id_demand'])) {
    $id_demand = $_POST['id_demand'];

    // Update status di tabel demands menjadi rejected
    $sql_update_status = "UPDATE demands SET status = 'rejected' WHERE id_demand = '$id_demand'";
    
    if ($conn->query($sql_update_status) === TRUE) {
        // Hapus data dari tabel charter
        $sql_delete = "DELETE FROM charter WHERE id_demand = '$id_demand'";
        $conn->query($sql_delete);
        
        header("Location: project.php");
        exit();
    } else {
        echo "Error saat mengupdate status: " . $conn->error;
    }
}
?>