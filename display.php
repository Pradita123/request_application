<?php
// Sample PHP code to generate the front end including sidebar and navbar similar to the provided design.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your custom CSS file -->
    <title>eOffice Management System</title>
    <style>
        /* Custom styling for Sidebar and Navbar */
        body {
            display: flex;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            background-color: #003366;
            color: #fff;
            display: flex;
            flex-direction: column;
            height: 100vh;
            padding: 1rem;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            margin: 10px 0;
        }

        .sidebar a:hover {
            background: #0059b3;
            padding: 8px;
            border-radius: 5px;
        }

        .sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }

        .sidebar ul li {
            margin-bottom: 1.5rem;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: calc(100% - 250px);
            padding: 1rem;
            background-color: #f8f9fa;
        }

        .main-content {
            width: calc(100% - 250px);
            padding: 1rem;
        }

        .navbar-right {
            display: flex;
            align-items: center;
        }

        .navbar-right i {
            margin-left: 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="Company Logo" style="width: 100%; margin-bottom: 1rem;">
        </div>
        <ul>
            <li><a href="#" class="active"><i class="fas fa-home"></i> Beranda</a></li>
            <li><a href="#"><i class="fas fa-database"></i> Master Data</a></li>
            <li><a href="#"><i class="fas fa-envelope"></i> Persuratan</a></li>
            <li><a href="#"><i class="fas fa-car"></i> Kendaraan</a></li>
            <li><a href="#"><i class="fas fa-door-open"></i> Ruang</a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Cuti</a></li>
            <li><a href="#"><i class="fas fa-folder"></i> Filing</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="navbar">
            <h3>eOffice Management System</h3>
            <div class="navbar-right">
                <span>Login as : Fenty Rachmawanty, A.Md - Asisten Sub Divisi Sekretariat PT RPN pada Sub Divisi Sekretariat & Komunikasi Perusahaan</span>
                <i class="fas fa-bell"></i>
                <i class="fas fa-expand"></i>
                <i class="fas fa-apple"></i>
            </div>
        </div>
        <div class="content">
            <!-- Page content goes here -->
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
