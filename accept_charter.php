<?php
include 'config.php';

// Cek apakah form telah disubmit dengan id yang dipilih
if (isset($_POST['selected_ids'])) {
    foreach ($_POST['selected_ids'] as $id_demand) {
        // Ambil data dari tabel demands berdasarkan id_demand
        $sql_select = "SELECT * FROM demands WHERE id_demand = '$id_demand'";
        $result = $conn->query($sql_select);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Insert data ke tabel project
            $sql_insert = "INSERT INTO project (id_demand, tanggal, nama, tujuan, estimasi_waktu, ruang_lingkup, benefit, proyek_bisnis, request_by, bisnis_proses_owner, bisnis_partner)
            VALUES (
                '{$row['id_demand']}', '{$row['tanggal']}', '{$row['nama']}', '{$row['tujuan']}', '{$row['estimasi_waktu']}', '{$row['ruang_lingkup']}', '{$row['benefit']}', '{$row['proyek_bisnis']}', '{$row['request_by']}', '{$row['bisnis_proses_owner']}', '{$row['bisnis_partner']}'
            )";

            if ($conn->query($sql_insert) === TRUE) {
                // Update status di tabel demands
                $sql_update_status = "UPDATE demands SET status = 'accepted' WHERE id_demand = '$id_demand'";
                $conn->query($sql_update_status);

                // Hapus data dari tabel charter
                $sql_delete = "DELETE FROM charter WHERE id_demand = '$id_demand'";
                $conn->query($sql_delete);
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Data tidak ditemukan untuk ID Demand: $id_demand.";
        }
    }

    header("Location: project.php"); // Kembali ke halaman project setelah proses selesai
    exit();
}
?>
