<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css?v=1.1">
    <title>Tabel Charter - Portal Aplikasi</title>
    <style>
        .hidden { display: none; }
    </style>
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
        <!-- Button "Pilih Demand" -->
        <div class="mb-3">
            <button type="button" class="btn btn-primary" onclick="toggleCheckboxColumn()" id="pilihDemandBtn">Pilih Demand</button>
            <button type="button" class="btn btn-secondary hidden" onclick="cancelDemand()" id="cancelBtn">Cancel</button>
            <button type="button" class="btn btn-success hidden" data-bs-toggle="modal" data-bs-target="#acceptModal" id="acceptBtn">Accept</button>
            <button type="button" class="btn btn-danger hidden" data-bs-toggle="modal" data-bs-target="#rejectModal" id="rejectBtn">Reject</button>

        </div>

        
        <!-- Tabel dengan Bootstrap -->
        <form id="charterForm" method="POST">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th class="select-column hidden">Pilih</th>
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
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; // Counter untuk nomor berurutan
                while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="select-column hidden text-center"><input type="checkbox" name="selected_ids[]" value="<?php echo $row['id_demand']; ?>" class="demand-checkbox" onclick="toggleActionButtons()"></td>
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
                </tr>

                <!-- Accept Modal -->
                <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="acceptModalLabel">Konfirmasi Accept</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menerima permintaan ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success" onclick="submitForm('accept_charter.php')">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reject Modal -->
                <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rejectModalLabel">Konfirmasi Reject</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menolak permintaan ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" onclick="submitForm('reject_charter.php')">Reject</button>
                            </div>
                        </div>
                    </div>
                </div>


                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

<script>
    function toggleCheckboxColumn() {
        const checkboxColumn = document.querySelectorAll('.select-column');
        checkboxColumn.forEach(column => column.classList.remove('hidden'));

        // Sembunyikan tombol "Pilih Demand" dan tampilkan tombol "Accept", "Reject", dan "Cancel"
        document.getElementById('pilihDemandBtn').classList.add('hidden');
        document.getElementById('acceptBtn').classList.remove('hidden');
        document.getElementById('rejectBtn').classList.remove('hidden');
        document.getElementById('cancelBtn').classList.remove('hidden');
    }
    
    function cancelDemand() {
        // Sembunyikan tombol "Accept", "Reject", dan "Cancel", tampilkan kembali tombol "Pilih Demand"
        document.getElementById('pilihDemandBtn').classList.remove('hidden');
        document.getElementById('acceptBtn').classList.add('hidden');
        document.getElementById('rejectBtn').classList.add('hidden');
        document.getElementById('cancelBtn').classList.add('hidden');
        // Sembunyikan kolom checkbox
        const checkboxColumn = document.querySelectorAll('.select-column');
        checkboxColumn.forEach(column => column.classList.add('hidden'));
    }

    function submitForm(action) {
        document.getElementById('charterForm').action = action;
        document.getElementById('charterForm').submit();
    }

    function toggleActionButtons() {
        const checkboxes = document.querySelectorAll('.demand-checkbox');
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        document.getElementById('acceptBtn').disabled = !anyChecked;
        document.getElementById('rejectBtn').disabled = !anyChecked;
    }

    function confirmAccept() {
        const selectedRows = document.querySelectorAll('.demand-checkbox:checked');
        selectedRows.forEach(row => {
            console.log('Accepted row:', row.closest('tr'));
        });
        // Tambahkan logika lanjutan untuk confirm accept
        document.getElementById('acceptModal').modal('hide'); // Tutup modal
    }

    function confirmReject() {
        const selectedRows = document.querySelectorAll('.demand-checkbox:checked');
        selectedRows.forEach(row => {
            console.log('Rejected row:', row.closest('tr'));
        });
        // Tambahkan logika lanjutan untuk confirm reject
        document.getElementById('rejectModal').modal('hide'); // Tutup modal
    }
</script>

<!-- Script untuk Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
