<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css?v=1.1">
    <title>Input Demand - Portal Aplikasi</title>
</head>
<body class="body-background">

<?php
include 'config.php';
include 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_demand = $_POST['id_demand'];
    $tanggal = !empty($_POST['tanggal']) ? $_POST['tanggal'] : date("Y-m-d"); // Mengisi tanggal dengan tanggal saat ini jika kosong
    $nama = $_POST['nama'];
    $tujuan = $_POST['tujuan'];
    $ruang_lingkup = $_POST['ruang_lingkup'];
    $benefit = $_POST['benefit'];
    $proyek_bisnis = $_POST['proyek_bisnis'];
    $estimasi_waktu = $_POST['estimasi_waktu'];
    $request_by = $_POST['request_by'];
    $bisnis_proses_owner = $_POST['bisnis_proses_owner'];
    $bisnis_partner = $_POST['bisnis_partner'];
    $status = 'pending';

    // Insert ke tabel demands
    $sql_insert_demands = "INSERT INTO demands (id_demand, tanggal, nama, tujuan, ruang_lingkup, benefit, proyek_bisnis, estimasi_waktu, request_by, bisnis_proses_owner,bisnis_partner, status) 
                           VALUES ('$id_demand', '$tanggal', '$nama', '$tujuan', '$ruang_lingkup', '$benefit', '$proyek_bisnis', '$estimasi_waktu', '$request_by', '$bisnis_proses_owner','$bisnis_partner','$status')";

    if ($conn->query($sql_insert_demands) === TRUE) {
        // Insert ke tabel charter
        $sql_insert_charter = "INSERT INTO charter (id_demand, nama, tanggal, tujuan, ruang_lingkup, benefit, proyek_bisnis, estimasi_waktu, request_by, bisnis_proses_owner, bisnis_partner) 
                               VALUES ('$id_demand', '$nama', '$tanggal', '$tujuan', '$ruang_lingkup', '$benefit', '$proyek_bisnis', '$estimasi_waktu', '$request_by', '$bisnis_proses_owner','$bisnis_partner')";
        if ($conn->query($sql_insert_charter) === TRUE) {
            header("Location: demand.php"); // Arahkan ke halaman 'demand.php' setelah data berhasil ditambahkan
            exit();
        } else {
            echo "Error saat menambahkan data ke charter: " . $conn->error;
        }
    } else {
        echo "Error saat menambahkan data ke demands: " . $conn->error;
    }
}
?>

<div class="container-add-demand">
    <h1 class="text-center my-4">Add Demand</h1>
    <form method="POST" action="">
        
        <!-- ID demand, Nama, Tanggal -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="id_demand" class="form-label">ID Demand</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">D-</span>
                    <input type="text" class="form-control" id="id_demand" name="id_demand" maxlength="8" required placeholder="xx-xxx" oninput="formatIdDemand(this)">
                </div>
                <small class="form-text text-muted">Format: xx-xxx (contoh: D-12-345)</small>
            </div>
            <div class="col-md-4">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="col-md-4">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>
        </div>

        <!-- Tujuan, Ruang Lingkup -->
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

        <!-- Benefit, Proyek Bisnis -->
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

        <!-- Estimasi Waktu, Request By -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="estimasi_waktu" class="form-label">Estimasi Waktu</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="estimasi_waktu" name="estimasi_waktu" required>
                    <span class="input-group-text">hari</span>
                </div>
            </div>
            <div class="col-md-6">
                <label for="request_by" class="form-label">Request By</label>
                <input type="text" class="form-control" id="request_by" name="request_by" required>
            </div>
        </div>

        <!-- Bisnis Proses Owner, Bisnis Partner -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="bisnis_proses_owner" class="form-label">Bisnis Proses Owner</label>
                <input type="text" class="form-control" id="bisnis_proses_owner" name="bisnis_proses_owner" required>
            </div>
            <div class="col-md-6">
                <label for="bisnis_partner" class="form-label">Bisnis Partner</label>
                <input type="text" class="form-control" id="bisnis_partner" name="bisnis_partner" required>
            </div>
        </div>
        <div class="col text-center">
        <button type="submit" class="btn btn-primary">Add Demand</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
