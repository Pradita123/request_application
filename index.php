<?php 
include 'navbar.php';
include 'config.php';

$dark_mode = isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === 'true';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css?v=1.1">
    <title>Dashboard - Portal Aplikasi</title>
</head>

<body class="body-background">
    <!-- Dashboard Content -->
    <div class="container-fluid py-4">
        <!-- Quick Stats Row -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card dashboard-card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-title mb-1">Total Permintaan</h6>
                                <h3 class="mb-0">156</h3>
                                <small class="text-white-50">+12 bulan ini</small>
                            </div>
                            <div class="stat-icon">
                                <i class="bi bi-file-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-title mb-1">Project Aktif</h6>
                                <h3 class="mb-0">24</h3>
                                <small class="text-white-50">8 menunggu approval</small>
                            </div>
                            <div class="stat-icon">
                                <i class="bi bi-kanban"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-title mb-1">Dalam Proses</h6>
                                <h3 class="mb-0">42</h3>
                                <small class="text-white-50">15 mendekati deadline</small>
                            </div>
                            <div class="stat-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-title mb-1">Selesai</h6>
                                <h3 class="mb-0">89</h3>
                                <small class="text-white-50">+5 minggu ini</small>
                            </div>
                            <div class="stat-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- Charts Row -->
         <div class="row mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Trend Permintaan</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <!-- Placeholder for chart -->
                            <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                <p class="text-muted">Area Grafik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Status Project</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <!-- Placeholder for pie chart -->
                            <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                <p class="text-muted">Area Pie Chart</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities & Tasks -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Permintaan Terbaru</h5>
                        <a href="#" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item recent-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Pengembangan Sistem HR</h6>
                                    <small class="text-muted">3 hari yang lalu</small>
                                </div>
                                <p class="mb-1">Divisi HR - Modul Absensi</p>
                                <span class="badge bg-warning status-badge">Dalam Review</span>
                            </div>
                            <div class="list-group-item recent-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Update Dashboard Finance</h6>
                                    <small class="text-muted">5 hari yang lalu</small>
                                </div>
                                <p class="mb-1">Divisi Finance - Reporting</p>
                                <span class="badge bg-success status-badge">Disetujui</span>
                            </div>
                            <div class="list-group-item recent-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Integrasi API Payment</h6>
                                    <small class="text-muted">1 minggu yang lalu</small>
                                </div>
                                <p class="mb-1">Divisi IT - Payment Gateway</p>
                                <span class="badge bg-info status-badge">In Progress</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Project Timeline</h5>
                        <a href="#" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item recent-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Sistem Manajemen Inventori</h6>
                                    <small class="text-danger">Deadline: 2 hari</small>
                                </div>
                                <div class="mb-2">Progress:</div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%">75%</div>
                                </div>
                            </div>
                            <div class="list-group-item recent-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Mobile App Development</h6>
                                    <small class="text-warning">Deadline: 2 minggu</small>
                                </div>
                                <div class="mb-2">Progress:</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 45%">45%</div>
                                </div>
                            </div>
                            <div class="list-group-item recent-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Website Redesign</h6>
                                    <small class="text-success">Deadline: 1 bulan</small>
                                </div>
                                <div class="mb-2">Progress:</div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 30%">30%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>