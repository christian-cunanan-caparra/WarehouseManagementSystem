<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - Warehouse Management System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -270px;
            width: 270px;
            height: 100%;
            background: #161a2d;
            color: white;
            padding: 20px;
            transition: 0.4s;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }
        .sidebar.active { left: 0; }
        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #161a2d;
            color: white;
            border: none;
            padding: 10px;
            font-size: 1.5rem;
            border-radius: 5px;
            display: block;
            z-index: 1100;
        }
        .toggle-btn:hover { background: #4f52ba; }

        .content {
            margin-left: 0;
            padding: 30px;
            transition: 0.4s;
        }
        .content.active { margin-left: 270px; }

        .sidebar-header {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .sidebar-links {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }
        .sidebar-links li { margin-bottom: 15px; }
        .sidebar-links li a {
            color: white;
            font-size: 1.1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            transition: 0.3s;
            border-radius: 6px;
        }
        .sidebar-links li a:hover {
            background: rgba(255, 255, 255, 0.2);
            padding-left: 15px;
        }

        @media (min-width: 769px) {
            .sidebar { left: 0; }
            .content { margin-left: 270px; }
            .toggle-btn { display: none; }
        }
    </style>
</head>
<body>
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Warehouse Management</div>
        <ul class="sidebar-links">
            <li><a href="/employee_dashboard"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="/product"><span class="material-icons">inventory</span> Products</a></li>
            <li><a href="/inventory"><span class="material-icons">storage</span> Inventory</a></li>
        </ul>
    </aside>

    <div class="content" id="main-content">
        <h1>Dashboard</h1>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Products</h5>
                            <h3 class="card-text"><?= count($products) ?></h3>
                        </div>
                        <span class="material-icons">inventory</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
        });
    </script>
</body>
</html>