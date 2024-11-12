<?php
include 'config.php';

if (isset($_POST['selected_ids'])) {
    foreach ($_POST['selected_ids'] as $id_demand) {
        // Update status di tabel demands menjadi rejected
        $sql_update_status = "UPDATE demands SET status = 'rejected' WHERE id_demand = '$id_demand'";

        if ($conn->query($sql_update_status) === TRUE) {
            // Hapus data dari tabel charter
            $sql_delete = "DELETE FROM charter WHERE id_demand = '$id_demand'";
            $conn->query($sql_delete);
        } else {
            echo "Error saat mengupdate status: " . $conn->error;
        }
    }

    header("Location: project.php"); // Kembali ke halaman project setelah proses selesai
    exit();
}
?>
