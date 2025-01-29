<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #1e1e2f;
            --sidebar-bg: #22223b;
            --sidebar-hover: #4a4e69;
            --text-light: #f8f9fa;
            --accent-color: #ff6b6b;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-light);
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: -260px;
            width: 260px;
            height: 100%;
            background: var(--sidebar-bg);
            padding: 20px;
            transition: 0.4s;
            z-index: 1000;
        }
        .sidebar.active {
            left: 0;
        }
        .sidebar-header {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .sidebar-links li {
            list-style: none;
            margin: 15px 0;
        }
        .sidebar-links a {
            text-decoration: none;
            color: var(--text-light);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            padding: 10px;
            transition: 0.3s;
            border-radius: 6px;
        }
        .sidebar-links a:hover {
            background: var(--sidebar-hover);
        }
        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: var(--sidebar-bg);
            color: var(--text-light);
            border: none;
            padding: 10px;
            font-size: 1.5rem;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1001;
        }
        .toggle-btn:hover {
            background: var(--accent-color);
        }
        .content {
            margin-left: 50px;
            padding: 30px;
            transition: margin-left 0.4s;
        }
        .content.active {
            margin-left: 260px;
        }
        .table th {
            background: var(--sidebar-hover);
            color: var(--text-light);
        }
        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        @media (max-width: 768px) {
            .sidebar { left: -260px; }
            .sidebar.active { left: 0; }
            .content { margin-left: 0; }
            .content.active { margin-left: 260px; }
        }
    </style>
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Warehouse Management</div>
        <ul class="sidebar-links">
            <li><a href="#"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="#"><span class="material-icons">inventory</span> Products</a></li>
            <li><a href="#"><span class="material-icons">storage</span> Inventory</a></li>
        </ul>
    </aside>
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>
    <div class="content" id="main-content">
        <div class="container">
            <h2 class="my-4">Inventory Management</h2>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Stock In</th>
                            <th>Stock Out</th>
                            <th>Remaining Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sample Product</td>
                            <td>50</td>
                            <td>20</td>
                            <td>30</td>
                            <td>
                                <button class="btn btn-success btn-sm">Add</button>
                                <button class="btn btn-danger btn-sm">Remove</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
        });
    </script>
</body>
</html>
