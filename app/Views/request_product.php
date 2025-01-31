<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
   

      <!-- Bootstrap 5 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
    
    <style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    /* Sidebar Styling */
    .sidebar {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100vh;
        width: 250px;
        background-color: #343a40;
        color: white;
        position: fixed;
        top: 0;
        left: 0;
        padding-top: 15px;
        transition: transform 0.3s ease-in-out;
    }

    .sidebar-links-container {
        flex-grow: 1;
    }

    .logout-container {
        padding: 15px;
    }

    .logout-button {
        text-decoration: none;
        color: white;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        padding: 12px 15px;
        border-radius: 5px;
    }

    .logout-button:hover {
        background-color: #495057;
    }

    .sidebar-header {
        font-size: 20px;
        text-align: center;
        padding: 15px;
        font-weight: bold;
        border-bottom: 1px solid #495057;
    }

    .sidebar-links {
        list-style: none;
        padding: 0;
    }

    .sidebar-links li {
        padding: 12px 15px;
    }

    .sidebar-links li a {
        text-decoration: none;
        color: white;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
    }

    .sidebar-links li a:hover {
        background-color: #495057;
        border-radius: 5px;
    }

    /* Toggle Button */
    .toggle-btn {
        position: fixed;
        left: 260px;
        top: 15px;
        background-color: #343a40;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        font-size: 20px;
        border-radius: 5px;
        transition: 0.3s;
    }

    .toggle-btn:hover {
        background-color: #495057;
    }

    /* Content Styling */
    .content {
        margin-left: 270px;
        padding: 20px;
        transition: margin-left 0.3s;
    }

    h2 {
        font-weight: bold;
        color: #343a40;
        margin-top: 30px;
    }

    /* Dashboard Cards */
    .card {
        margin-bottom: 20px;
    }

    .card-title {
        font-size: 16px;
    }

    .card-body {
        padding: 20px;
    }

    .card h3 {
        font-size: 2rem;
    }

    /* Stock Trends Chart */
    #stockTrendChart {
        height: 400px;
    }

    /* Mini Pie Chart */
    #pieChart {
        height: 250px;
        max-width: 300px;
        margin: 0 auto;
        border-radius: 10px;
    }

    /* Accept/Reject Button Styling */
    .btn {
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-activate {
        background: linear-gradient(45deg, #28a745, #218838);
        color: white;
        border: none;
    }

    .btn-activate:hover {
        background: linear-gradient(45deg, #218838, #28a745);
        transform: scale(1.05);
    }

    .btn-reject {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-reject:hover {
        background-color: #c82333;
        transform: scale(1.05);
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        .sidebar {
            transform: translateX(-250px);
        }

        .content {
            margin-left: 0;
        }

        .toggle-btn {
            left: 15px;
        }
    }

    .sidebar.hidden {
        transform: translateX(-250px);
    }

    .content.full-width {
        margin-left: 0;
    }

    .toggle-btn.move {
        left: 15px;
    }

    /* Container for the Charts */
    .chart-container {
        margin-top: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 20px;
    }

    .table-container {
        margin-top: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 20px;
    }

    .table-responsive {
        max-height: 500px;
        overflow-y: auto;
    }

    h1{
        margin-left: 50px;
    }
</style>

</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <button class="close-btn" id="close-btn">&times;</button>
        <div class="sidebar-header">Warehouse Management</div>
        <ul class="sidebar-links">
            <li><a href="/admin_dashboard"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="/account-management"><span class="material-icons">inventory</span> Account Management </a></li>
            <li><a href="/archive-accounts"><span class="material-icons">storage</span> Account Archive</a></li>
            <li><a href="/inventory-log"><span class="material-icons">list</span> Inventory Logs</a></li>
        </ul>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <div class="dashboard-container">
            <h1>Welcome, Admin <?= session()->get('user_name') ?>!</h1>
            <p>You are logged in as an Admin.</p>

            <h3>Requesting New Products</h3>

            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= esc($product['name']) ?></td>
                            <td><?= esc($product['description']) ?></td>
                            <td><?= esc($product['price']) ?></td>
                            <td>
                                <form action="/admin/activate/<?= $product['id'] ?>" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-activate btn-sm">
                                        <i class="fas fa-check"></i> Accept
                                    </button>
                                </form>
                                <form action="/admin/reject/<?= $product['id'] ?>" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-reject btn-sm">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <a href="/logout" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
    <script>
        // Sidebar Toggle Functionality
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("toggle-btn");
        const content = document.getElementById("main-content");

        let isSidebarOpen = true;

        toggleBtn.addEventListener("click", () => {
            isSidebarOpen = !isSidebarOpen;

            if (isSidebarOpen) {
                sidebar.classList.remove("hidden");
                content.classList.remove("full-width");
                toggleBtn.classList.remove("move");
                toggleBtn.style.left = "260px";
            } else {
                sidebar.classList.add("hidden");
                content.classList.add("full-width");
                toggleBtn.classList.add("move");
                toggleBtn.style.left = "15px";
            }
        });
    </script>

</body>
</html>