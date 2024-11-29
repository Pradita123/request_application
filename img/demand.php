<?php
include 'navbar.php';
include 'config.php';

// Fetch all demands
$sql = "SELECT * FROM demands";
$result = $conn->query($sql);

// Edit function
// Fungsi untuk mengedit data
if (isset($_POST['update'])) {
    $id = $_POST['id_demand'];
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $tujuan = $_POST['tujuan'];
    $ruang_lingkup = $_POST['ruang_lingkup'];
    $benefit = $_POST['benefit'];
    $proyek_bisnis = $_POST['proyek_bisnis'];
    $estimasi_waktu = $_POST['estimasi_waktu'];
    $request_by = $_POST['request_by'];
    $bisnis_proses_owner = $_POST['bisnis_proses_owner'];
    $bisnis_partner = $_POST['bisnis_partner'];
    $status = $_POST['status'];

    // Update tabel demands
    $sql_update_demands = "UPDATE demands SET 
        nama='$nama', 
        tanggal='$tanggal', 
        tujuan='$tujuan', 
        ruang_lingkup='$ruang_lingkup', 
        benefit='$benefit', 
        proyek_bisnis='$proyek_bisnis', 
        estimasi_waktu='$estimasi_waktu', 
        request_by='$request_by', 
        bisnis_proses_owner='$bisnis_proses_owner',
        bisnis_partner='$bisnis_partner',
        status='$status'
        WHERE id_demand='$id'";
    
    $conn->query($sql_update_demands);

    // Update tabel charter
    $sql_update_charter = "UPDATE charter SET 
        nama='$nama', 
        tanggal='$tanggal', 
        tujuan='$tujuan', 
        ruang_lingkup='$ruang_lingkup', 
        benefit='$benefit', 
        proyek_bisnis='$proyek_bisnis', 
        estimasi_waktu='$estimasi_waktu', 
        request_by='$request_by', 
        bisnis_proses_owner='$bisnis_proses_owner',
        bisnis_partner='$bisnis_partner'
        WHERE id_demand='$id'";
    
    $conn->query($sql_update_charter);

    header("Location: demand.php");
    exit();
}


// Fungsi untuk menghapus data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data dari tabel demands
    $sql_delete_demands = "DELETE FROM demands WHERE id_demand='$id'";
    $conn->query($sql_delete_demands);

    // Hapus data dari tabel charter
    $sql_delete_charter = "DELETE FROM charter WHERE id_demand='$id'";
    $conn->query($sql_delete_charter);

    header("Location: demand.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css?v=1.1">
    <title>Tabel Demand - Portal Aplikasi</title>

</head>

<body class="body-background">
<div class="container mt-3">
    <h1 class="mb-4 text-start text-center">Data Demand</h1>
    <!-- Button untuk menambahkan data -->
    <a href="add_demand.php" class="btn btn-primary mb-3">Add Demand</a>

    <!-- Tabel dengan Bootstrap -->
    <div class="table-responsive"> 
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>ID Demand</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Request By</th>
                    <th>Bisnis Proses Owner</th>
                    <th>Bisnis Partner</th>
                    <th><Details></Details></th>
                    <th>Status</th>
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
                    <td><?= $row['request_by'] ?></td>
                    <td><?= $row['bisnis_proses_owner'] ?></td>
                    <td><?= $row['bisnis_partner'] ?></td>
                    <td>
                        <div class="text-center">
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal<?= $row['id_demand'] ?>">
                                Selengkapnya
                            </button>
                        </div>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="detailModal<?= $row['id_demand'] ?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel">Detail</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Tujuan :</strong> <?= $row['tujuan'] ?></p>
                                            <p><strong>Ruang Lingkup :</strong> <?= $row['ruang_lingkup'] ?></p>
                                            <p><strong>Benefit :</strong> <?= $row['benefit'] ?></p>
                                            <p><strong>Proyek Bisnis :</strong> <?= $row['proyek_bisnis'] ?></p>
                                            <p><strong>Estimasi Waktu :</strong> <?= $row['estimasi_waktu']." Hari" ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    <td>
                        <?php if ($row['status'] == 'accepted'): ?>
                            <span class="btn btn-success btn-sm text-center">Accepted</span>
                        <?php elseif ($row['status'] == 'rejected'): ?>
                            <span class="btn btn-danger btn-sm text-center">Rejected</span>
                        <?php else: ?>
                            <span class="btn btn-warning btn-sm text-center">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <!-- Tombol Edit -->
                        <button class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id_demand'] ?>">Edit</button>
                        <!-- Tombol Delete -->
                        <button class="btn btn-sm btn-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row['id_demand'] ?>">Delete</button>
                    </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="editModal<?= $row['id_demand'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="demand.php">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Demand</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_demand" value="<?= $row['id_demand'] ?>">

                                    <!-- Input Fields -->
                                    <div class="mb-3">
                                        <label for="nama<?= $row['id_demand'] ?>" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama<?= $row['id_demand'] ?>" name="nama" value="<?= $row['nama'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal<?= $row['id_demand'] ?>" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal<?= $row['id_demand'] ?>" name="tanggal" value="<?= $row['tanggal'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tujuan<?= $row['id_demand'] ?>" class="form-label">Tujuan</label>
                                        <input type="text" class="form-control" id="tujuan<?= $row['id_demand'] ?>" name="tujuan" value="<?= $row['tujuan'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ruang_lingkup<?= $row['id_demand'] ?>" class="form-label">Ruang Lingkup</label>
                                        <input type="text" class="form-control" id="ruang_lingkup<?= $row['id_demand'] ?>" name="ruang_lingkup" value="<?= $row['ruang_lingkup'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="benefit<?= $row['id_demand'] ?>" class="form-label">Benefit</label>
                                        <input type="text" class="form-control" id="benefit<?= $row['id_demand'] ?>" name="benefit" value="<?= $row['benefit'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="proyek_bisnis<?= $row['id_demand'] ?>" class="form-label">Proyek Bisnis</label>
                                        <input type="text" class="form-control" id="proyek_bisnis<?= $row['id_demand'] ?>" name="proyek_bisnis" value="<?= $row['proyek_bisnis'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="estimasi_waktu<?= $row['id_demand'] ?>" class="form-label">Estimasi Waktu</label>
                                        <input type="text" class="form-control" id="estimasi_waktu<?= $row['id_demand'] ?>" name="estimasi_waktu" value="<?= $row['estimasi_waktu'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="request_by<?= $row['id_demand'] ?>" class="form-label">Request By</label>
                                        <input type="text" class="form-control" id="request_by<?= $row['id_demand'] ?>" name="request_by" value="<?= $row['request_by'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bisnis_proses_owner<?= $row['id_demand'] ?>" class="form-label">Bisnis Proses Owner</label>
                                        <input type="text" class="form-control" id="bisnis_proses_owner<?= $row['id_demand'] ?>" name="bisnis_proses_owner" value="<?= $row['bisnis_proses_owner'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bisnis_partner<?= $row['id_demand'] ?>" class="form-label">Bisnis Partner</label>
                                        <input type="text" class="form-control" id="bisnis_partnerr<?= $row['id_demand'] ?>" name="bisnis_partner" value="<?= $row['bisnis_partner'] ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal<?= $row['id_demand'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="GET" action="demand.php">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Demand</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus demand ini?</p>
                                    <input type="hidden" name="id" value="<?= $row['id_demand'] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Script untuk Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    // Ensure that only one modal is open at a time
    const editButtons = document.querySelectorAll('button[data-bs-toggle="modal"]');
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const allModals = document.querySelectorAll('.modal');
            allModals.forEach(modal => {
                if (modal !== document.querySelector(button.getAttribute('data-bs-target'))) {
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                }
            });
        });
    });
</script>

</body>
</html>
