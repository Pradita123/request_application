<?php
include 'config.php';
include 'navbar.php';

// Handle form submission to add a new project
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_project = $_POST['id_project'];
    $tanggal = !empty($_POST['tanggal']) ? $_POST['tanggal'] : date("Y-m-d");
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

    // Validasi input
    if (empty($id_project) || empty($nama) || empty($tujuan)) {
        die("Semua field wajib diisi!");
    }

    // Insert into project table
    $sql_insert = "INSERT INTO project (id_project, id_demand, nama, deskripsi, tujuan, ruang_lingkup, benefit, proyek_bisnis, estimasi_waktu, request_by, bisnis_proses_owner, bisnis_partner)
    VALUES ('$id_project', '$id_demand', '$nama', '$deskripsi', '$tujuan', '$ruang_lingkup', '$benefit', '$proyek_bisnis', '$estimasi_waktu', '$request_by', '$bisnis_proses_owner', '$bisnis_partner')";


    if ($conn->query($sql_insert) === TRUE) {
        // Redirect to the project list page after successful insert
        header("Location: project.php");
        exit();
    } else {
        echo "Query Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

// Fetch demand data for dropdown
$sql_demands = "SELECT id_demand, nama, tanggal, tujuan, ruang_lingkup, benefit, proyek_bisnis, estimasi_waktu, request_by, bisnis_proses_owner, bisnis_partner FROM demands";
$result_demands = $conn->query($sql_demands);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Add Project - Portal Aplikasi</title>
</head>

<body class="body-background">
<div class="container-add-demand mt-3">
    <h1 class="my-4">Add Project</h1>

    <!-- Form untuk menambahkan project baru -->
    <form method="post" action="add_project.php">
        <div class="mb-3">
            <label for="id_demand" class="form-label">Pilih Demand</label>
            <select class="form-select" id="id_demand" name="id_demand" onchange="populateDemandDetails()" required>
                <option value="" disabled selected>Select Demand</option>
                <?php
                if ($result_demands->num_rows > 0) {
                    while ($row = $result_demands->fetch_assoc()) {
                        echo "<option value='" . $row['id_demand'] . "' 
                            data-tanggal='" . $row['tanggal'] . "'
                            data-deskripsi='" . $row['deskripsi'] . "'
                            data-tujuan='" . $row['tujuan'] . "'
                            data-ruang-lingkup='" . $row['ruang_lingkup'] . "'
                            data-benefit='" . $row['benefit'] . "'
                            data-proyek-bisnis='" . $row['proyek_bisnis'] . "'
                            data-estimasi-waktu='" . $row['estimasi_waktu'] . "'
                            data-request-by='" . $row['request_by'] . "'
                            data-bisnis-proses-owner='" . $row['bisnis_proses_owner'] . "'
                            data-bisnis-partner='" . $row['bisnis_partner'] . "'>" 
                            . $row['id_demand'] . " | " . $row['nama'] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No demands available</option>";
                }
                ?>
            </select>
        </div>
            <!-- Hidden input untuk menyimpan data tambahan -->
            <input type="hidden" id="tanggal_demand" name="tanggal">
            <input type="hidden" id="tujuan_demand" name="tujuan">
            <input type="hidden" id="deskripsi" name="deskripsi">
            <input type="hidden" id="ruang_lingkup_demand" name="ruang_lingkup">
            <input type="hidden" id="benefit_demand" name="benefit">
            <input type="hidden" id="proyek_bisnis_demand" name="proyek_bisnis">
            <input type="hidden" id="estimasi_waktu_demand" name="estimasi_waktu">
            <input type="hidden" id="request_by_demand" name="request_by">
            <input type="hidden" id="bisnis_proses_owner_demand" name="bisnis_proses_owner">
            <input type="hidden" id="bisnis_partner_demand" name="bisnis_partner">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="id_project" class="form-label">ID Project</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">P-</span>
                    <input type="text" class="form-control" id="id_project" name="id_project" maxlength="8" required placeholder="xx-xxx" oninput="formatIdDemand(this)">
                </div>
                <small class="form-text text-muted">Format: xx-xxx (contoh: D-12-345)</small>
            </div>
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama Project</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
        </div>
        <div>
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="tujuan" class="form-label">Tujuan</label>
                <textarea class="form-control" id="tujuan" name="tujuan" required></textarea>
            </div>
            <div class="col-md-6">
                <label for="ruang_lingkup" class="form-label">Ruang Lingkup</label>
                <textarea class="form-control" id="ruang_lingkup" name="ruang_lingkup" required></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="benefit" class="form-label">Benefit</label>
                <textarea class="form-control" id="benefit" name="benefit" required></textarea>
            </div>
            <div class="col-md-6">
                <label for="proyek_bisnis" class="form-label">Proyek Bisnis</label>
                <textarea class="form-control" id="proyek_bisnis" name="proyek_bisnis" required></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="estimasi_waktu" class="form-label">Estimasi Waktu</label>
                <input type="number" class="form-control" id="estimasi_waktu" name="estimasi_waktu" required>
            </div>
            <div class="col-md-6">
                <label for="request_by" class="form-label">Request By</label>
                <input type="text" class="form-control" id="request_by" name="request_by" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="bisnis_proses_owner" class="form-label">Bussiness Process Owner</label>
                <input type="text" class="form-control" id="bisnis_proses_owner" name="bisnis_proses_owner" required>
            </div>
            <div class="col-md-6">
                <label for="bisnis_partner" class="form-label">Bussiness Partnership</label>
                <input type="text" class="form-control" id="bisnis_partner" name="bisnis_partner" required>
            </div>
        </div>
        <div class="col text-center">
        <button type="submit" class="btn btn-primary" name="add_project">Add Project</button>
        <a href="project.php" class="btn btn-secondary">Cancel</a>
    </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>

function populateDemandDetails() {
    const selectedOption = document.querySelector("#id_demand option:checked");

    // Ambil data dari atribut data-*
    const tanggal = selectedOption.getAttribute("data-tanggal");
    const tujuan = selectedOption.getAttribute("data-tujuan");
    const deskripsi = selectedOption.getAttribute("data-deskripsi");
    const ruangLingkup = selectedOption.getAttribute("data-ruang-lingkup");
    const benefit = selectedOption.getAttribute("data-benefit");
    const proyekBisnis = selectedOption.getAttribute("data-proyek-bisnis");
    const estimasiWaktu = selectedOption.getAttribute("data-estimasi-waktu");
    const requestBy = selectedOption.getAttribute("data-request-by");
    const bisnisProsesOwner = selectedOption.getAttribute("data-bisnis-proses-owner");
    const bisnisPartner = selectedOption.getAttribute("data-bisnis-partner");

    // Isi hidden input dengan nilai yang diambil
    document.getElementById("tanggal_demand").value = tanggal || '';
    document.getElementById("tujuan_demand").value = tujuan || '';
    document.getElementById("deskripsi_demand").value = deskripsi || '';
    document.getElementById("ruang_lingkup_demand").value = ruangLingkup || '';
    document.getElementById("benefit_demand").value = benefit || '';
    document.getElementById("proyek_bisnis_demand").value = proyekBisnis || '';
    document.getElementById("estimasi_waktu_demand").value = estimasiWaktu || '';
    document.getElementById("request_by_demand").value = requestBy || '';
    document.getElementById("bisnis_proses_owner_demand").value = bisnisProsesOwner || '';
    document.getElementById("bisnis_partner_demand").value = bisnisPartner || '';
}
    </script>

<script>
function formatIdDemand(input) {
    let value = input.value.replace(/\D/g, ""); // Hanya angka
    if (value.length > 2) {
        value = value.slice(0, 2) + '-' + value.slice(2);
    }
    if (value.length > 6) {
        value = value.slice(0, 6) + '-' + value.slice(6, 9);
    }
    input.value = value;
}
</script>


</body>
</html>
