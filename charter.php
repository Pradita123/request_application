<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css?v=1.1">
    <title>Tabel Charter - Portal Aplikasi</title>
</head>
<body>

<?php
include 'navbar.php';
include 'config.php';

// Fetch all demands
$sql = "SELECT * FROM charter";
$result = $conn->query($sql);
?>

<body class="body-background">
    <div class="container mt-3">
        <h1 class="mb-4">Data Charter</h1>

        <!-- Tabel dengan Bootstrap -->
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>ID Demand</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Tujuan</th>
                    <th>Ruang Lingkup</th>
                    <th>Benefit</th>
                    <th>Proyek Bisnis</th>
                    <th>Estimasi Waktu</th>
                    <th>Request By</th>
                    <th>Bisnis Proses Owner</th>
                    <th>Bisnis Partner</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; // Counter untuk nomor berurutan
                while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= 'D-' . $row['id_demand'] ?></td>
                    <td class="no-wrap"><?= date("d-m-Y", strtotime($row['tanggal'])) ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['tujuan'] ?></td>
                    <td><?= $row['ruang_lingkup'] ?></td>
                    <td><?= $row['benefit'] ?></td>
                    <td><?= $row['proyek_bisnis'] ?></td>
                    <td class="text-center"><?= $row['estimasi_waktu'] . ' Hari'?></td>
                    <td><?= $row['request_by'] ?></td>
                    <td><?= $row['bisnis_proses_owner'] ?></td>
                    <td><?= $row['bisnis_partner'] ?></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-success btn-action" data-bs-toggle="modal" data-bs-target="#acceptModal<?= $row['id_demand'] ?>">Accept</button>
                        <button class="btn btn-sm btn-danger btn-action" data-bs-toggle="modal" data-bs-target="#rejectModal<?= $row['id_demand'] ?>">Reject</button>
                    </td>

                </tr>

                <!-- Modal Accept -->
                <div class="modal fade" id="acceptModal<?= $row['id_demand'] ?>" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="accept_charter.php">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="acceptModalLabel">Accept Charter</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menerima demand ini?</p>
                                    <input type="hidden" name="id_demand" value="<?= $row['id_demand'] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Accept</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Reject -->
                <div class="modal fade" id="rejectModal<?= $row['id_demand'] ?>" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="reject_charter.php">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rejectModalLabel">Reject Charter</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menolak demand ini?</p>
                                    <input type="hidden" name="id_demand" value="<?= $row['id_demand'] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

<!-- Script untuk Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>