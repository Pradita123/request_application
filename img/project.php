<?php
include 'config.php';
include 'navbar.php';
    
$sql = "SELECT * FROM project";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css?v=1.1">
    <title>Tabel Projek - Portal Aplikasi</title>
</head>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var searchValue = this.value.toLowerCase();
        var tableRows = document.querySelectorAll('#projectTable tbody tr');

        tableRows.forEach(function(row) {
            var rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(searchValue) ? '' : 'none';
        });
    });
</script>
<body class="body-background">
<div class="container mt-3">
    <h1 class="mb-4">Data Project</h1>    
    <!-- Link untuk menambahkan project baru -->
    <a href="charter.php" class="btn btn-primary mb-3">Add Project</a>

    <!-- Enhanced table with Bootstrap styling -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>ID Projek</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Request By</th>
                    <th>Bisnis Proses Owner</th>
                    <th>Bisnis Partner</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; // Inisialisasi nomor urut
                while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?='P-'. $row ['id_demand'] ?></td>
                    <td class="no-wrap"><?= date("d-m-Y", strtotime($row['tanggal'])) ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['request_by'] ?></td>
                    <td><?= $row['bisnis_proses_owner'] ?></td>
                    <td><?= $row['bisnis_partner'] ?></td>
                    <td>
                        <div class="text-center">
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#mainModal<?= $row['id_demand'] ?>">
                                Selengkapnya
                            </button>
                        </div>

                        <!-- Modal Utama yang berisi dua container modal di dalamnya -->
                        <div class="modal fade" id="mainModal<?= $row['id_demand'] ?>" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mainModalLabel">Detail Project dan Demand</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex justify-content-between">
                                        <!-- Container Modal Detail Proyek -->
                                        <div class="modal-container me-3 p-3 border" style="width: 48%;">
                                            <h5>Detail Proyek</h5>
                                            <p><strong>Tujuan:</strong> <?= $row['tujuan'] ?></p>
                                            <p><strong>Ruang Lingkup:</strong> <?= $row['ruang_lingkup'] ?></p>
                                            <p><strong>Benefit:</strong> <?= $row['benefit'] ?></p>
                                            <p><strong>Proyek Bisnis:</strong> <?= $row['proyek_bisnis'] ?></p>
                                        </div>

                                        <!-- Container Modal Detail Demand -->
                                        <div class="modal-container p-3 border" style="width: 48%;">
                                            <h5>Detail Demand</h5>
                                            <p><strong>Bisnis Partner:</strong> <?= $row['bisnis_partner'] ?></p>
                                            <p><strong>Estimasi Waktu:</strong> <?= $row['estimasi_waktu'] ?> Hari</p>
                                            <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>