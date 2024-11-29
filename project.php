<?php
include 'config.php';
include 'navbar.php';

// Fetch all projects and join with demands
$sql = "SELECT project.*, demands.id_demand, demands.nama AS nama_demand, demands.tanggal AS demand_tanggal, 
        demands.tujuan AS demand_tujuan, demands.ruang_lingkup AS demand_ruang_lingkup, demands.benefit AS demand_benefit, 
        demands.proyek_bisnis AS demand_proyek_bisnis, demands.estimasi_waktu AS demand_estimasi_waktu, 
        demands.request_by AS demand_request_by, demands.bisnis_proses_owner AS demand_bisnis_proses_owner, 
        demands.bisnis_partner AS demand_bisnis_partner 
        FROM project
        LEFT JOIN demands ON project.id_demand = demands.id_demand";
        

$result = $conn->query($sql);

// Handle form submission to add a new project
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_project = $_POST['id_project'];
    $id_demand = $_POST['id_demand'];
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $tujuan = $_POST['tujuan'];
    $ruang_lingkup = $_POST['ruang_lingkup'];
    $benefit = $_POST['benefit'];
    $proyek_bisnis = $_POST['proyek_bisnis'];
    $estimasi_waktu = $_POST['estimasi_waktu'];
    $request_by = $_POST['request_by'];
    $bisnis_proses_owner = $_POST['bisnis_proses_owner'];
    $bisnis_partner = $_POST['bisnis_partner'];

    $sql_insert = "INSERT INTO project (id_project, id_demand, tanggal, nama, deskripsi, tujuan, ruang_lingkup, benefit, proyek_bisnis, estimasi_waktu, request_by, bisnis_proses_owner, bisnis_partner)
                   VALUES ('$id_project', '$id_demand', '$tanggal', '$nama', '$tujuan', '$ruang_lingkup', '$benefit', '$proyek_bisnis', '$estimasi_waktu', '$request_by', '$bisnis_proses_owner', '$bisnis_partner')";

    if ($conn->query($sql_insert) === TRUE) {
        header("Location: project.php");
        exit();
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tabel Projek - Portal Aplikasi</title>
</head>
<body class="body-background">
<div class="container mt-3">
    <h1 class="mb-4">Data Project</h1>    

    <!-- Button to navigate to Add Project page -->
    <a href="add_project.php" class="btn btn-primary mb-3">Add Project</a>

    <!-- Project table -->
    <div class="table-responsive">
        <table id="projectTable" class="table table-bordered table-striped table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>ID Projek</th>
                    <th>Tanggal</th>
                    <th>Nama Projek</th>
                    <th>Deskripsi</th>
                    <th>Tujuan</th>
                    <th>Request By</th>
                    <th>Bussiness Process Owner</th>
                    <th>Bussiness Partnership</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; // Initialize row number
                while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= 'P-' . $row['id_project'] ?></td>
                    <td class="no-wrap"><?= date("d-m-Y", strtotime($row['tanggal'])) ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td><?= $row['tujuan'] ?></td>
                    <td><?= $row['request_by'] ?></td>
                    <td><?= $row['bisnis_proses_owner'] ?></td>
                    <td><?= $row['bisnis_partner'] ?></td>
                    <td>
                    <button type="button" class="btn btn-info btn-sm" 
    onclick="showDetails(
        '<?= $row['id_project'] ?>', 
        '<?= $row['tanggal'] ?>', 
        '<?= $row['nama'] ?>',
        '<?= $row['deskripsi'] ?>',
        '<?= $row['tujuan'] ?>', 
        '<?= $row['ruang_lingkup'] ?>', 
        '<?= $row['benefit'] ?>', 
        '<?= $row['proyek_bisnis'] ?>', 
        '<?= $row['estimasi_waktu'] ?>', 
        '<?= $row['request_by'] ?>', 
        '<?= $row['bisnis_proses_owner'] ?>', 
        '<?= $row['bisnis_partner'] ?>',
        '<?= $row['id_demand'] ?>', 
        '<?= $row['demand_tanggal'] ?>', 
        '<?= $row['nama_demand'] ?>',
        '<?= $row['demand_tujuan'] ?>', 
        '<?= $row['demand_ruang_lingkup'] ?>', 
        '<?= $row['demand_benefit'] ?>', 
        '<?= $row['demand_proyek_bisnis'] ?>', 
        '<?= $row['demand_estimasi_waktu'] ?>', 
        '<?= $row['demand_request_by'] ?>', 
        '<?= $row['demand_bisnis_proses_owner'] ?>', 
        '<?= $row['demand_bisnis_partner'] ?>')">
    Selengkapnya
</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Custom Modal Backdrop -->
<div id="customBackdrop" class="modal-backdrop-custom"></div>

<!-- Detail Project Modal (Left) -->
<div id="leftModal" class="custom-modal left-modal">

<button id="closeIcon" class="close-button" onclick="hideDetails()">✕</button>
    <h1 class="mb-5">Detail Project</h1>
    <p><strong>ID Projek:</strong> <span id="detail_id_project"></span></p>
    <p><strong>Tanggal:</strong> <span id="detail_tanggal"></span></p>
    <p><strong>Nama:</strong> <span id="detail_nama"></span></p>
    <p><strong>Deskripsi:</strong> <span id="detail_deskripsi"></span></p>
    <p><strong>Tujuan:</strong> <span id="detail_tujuan"></span></p>
    <p><strong>Ruang Lingkup:</strong> <span id="detail_ruang_lingkup"></span></p>
    <p><strong>Benefit:</strong> <span id="detail_benefit"></span></p>
    <p><strong>Estimasi Waktu:</strong> <span id="detail_estimasi_waktu"></span></p>
    <p><strong>Proyek Bisnis:</strong> <span id="detail_proyek_bisnis"></span></p>
    <p><strong>Bussiness Process owner:</strong> <span id="detail_bisnis_proses_owner"></span></p>
    <p><strong>Bussiness Partner:</strong> <span id="detail_bisnis_partner"></span></p>
</div>

<!-- Detail Project Modal (Right) -->
<div id="rightModal" class="custom-modal right-modal">
    <h1 class="mb-5">Detail Demand</h1>
    <p><strong>ID Demand:</strong> <span id="id_demand"></span></p>
    <p><strong>Nama Demand:</strong> <span id="nama_demand"></span></p>
    <p><strong>Tanggal:</strong> <span id="demand_tanggal"></span></p>
    <p><strong>Tujuan:</strong> <span id="demand_tujuan"></span></p>
    <p><strong>Ruang Lingkup:</strong> <span id="demand_ruang_lingkup"></span></p>
    <p><strong>Benefit:</strong> <span id="demand_benefit"></span></p>
    <p><strong>Proyek Bisnis:</strong> <span id="demand_proyek_bisnis"></span></p>
    <p><strong>Estimasi Waktu:</strong> <span id="demand_estimasi_waktu"></span></p>
    <p><strong>Request By:</strong> <span id="demand_request_by"></span></p>
    <p><strong>Bussiness Process Owner:</strong> <span id="demand_bisnis_proses_owner"></span></p>
    <p><strong>Bussiness Partnership:</strong> <span id="demand_bisnis_partner"></span></p>
</div>

<!-- JavaScript to show and hide custom modals -->
<script>
function showDetails(
    id_project, tanggal, nama, deskripsi, tujuan, ruang_lingkup, benefit, proyek_bisnis, estimasi_waktu, request_by, bisnis_proses_owner, bisnis_partner,
    id_demand, demand_tanggal, nama_demand, demand_tujuan, demand_ruang_lingkup, demand_benefit, demand_proyek_bisnis, demand_estimasi_waktu, demand_request_by, demand_bisnis_proses_owner, demand_bisnis_partner
) {
    // Data untuk left modal (Detail Project)
    document.getElementById('detail_id_project').innerText = id_project;
    document.getElementById('detail_tanggal').innerText = tanggal;
    document.getElementById('detail_nama').innerText = nama;
    document.getElementById('detail_deskripsi').innerText = deskripsi;
    document.getElementById('detail_tujuan').innerText = tujuan;
    document.getElementById('detail_ruang_lingkup').innerText = ruang_lingkup;
    document.getElementById('detail_benefit').innerText = benefit;
    document.getElementById('detail_proyek_bisnis').innerText = proyek_bisnis;
    document.getElementById('detail_estimasi_waktu').innerText = estimasi_waktu + " hari";
    document.getElementById('detail_bisnis_proses_owner').innerText = bisnis_proses_owner;
    document.getElementById('detail_bisnis_partner').innerText = bisnis_partner;

    // Data demand untuk right modal (Detail Demand)
    document.getElementById('id_demand').innerText = id_demand;
    document.getElementById('nama_demand').innerText = nama_demand;
    document.getElementById('demand_tanggal').innerText = demand_tanggal;
    document.getElementById('demand_tujuan').innerText = demand_tujuan;
    document.getElementById('demand_ruang_lingkup').innerText = demand_ruang_lingkup;
    document.getElementById('demand_benefit').innerText = demand_benefit;
    document.getElementById('demand_proyek_bisnis').innerText = demand_proyek_bisnis;
    document.getElementById('demand_estimasi_waktu').innerText = demand_estimasi_waktu ? demand_estimasi_waktu + " hari" : '-';
    document.getElementById('demand_request_by').innerText = demand_request_by;
    document.getElementById('demand_bisnis_proses_owner').innerText = demand_bisnis_proses_owner;
    document.getElementById('demand_bisnis_partner').innerText = demand_bisnis_partner;

    // Menampilkan kedua modal
    document.getElementById('leftModal').style.display = 'block';
    document.getElementById('rightModal').style.display = 'block';
    document.getElementById('customBackdrop').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function hideDetails() {
    // Menyembunyikan kedua modal
    document.getElementById('leftModal').style.display = 'none';
    document.getElementById('rightModal').style.display = 'none';
    document.getElementById('customBackdrop').style.display = 'none';
    document.body.style.overflow = 'auto';
}
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
