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
    padding: 20px;
}

/* Dashboard Container */
.dashboard-container {
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    padding: 30px;
    max-width: 1200px;
    margin: auto;
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
    left: -250px; /* Initially hidden */
    padding-top: 15px;
    transition: transform 0.3s ease-in-out;
    box-shadow: 3px 0 10px rgba(0, 0, 0, 0.3);
}

.sidebar.active {
    left: 0; /* Show the sidebar when active */
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

.sidebar-links li a.active {
    background-color: #007bff;
}

/* Sidebar Toggle Button */
.toggle-btn {
    position: fixed;
    left: 20px;
    top: 20px;
    background: #161a2d;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    font-size: 1.5rem;
    border-radius: 5px;
    transition: 0.3s;
}

.toggle-btn:hover {
    background: #4f52ba;
}

.content {
    margin-left: 270px;
    padding: 30px;
    transition: margin-left 0.3s;
    background: #f8f9fa;
}

.content.active {
    margin-left: 0; /* When the sidebar is active, shift content */
}

/* Accept & Reject Button Styles */
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
    background: linear-gradient(45deg, #dc3545, #c82333);
    color: white;
    border: none;
}

.btn-reject:hover {
    background: linear-gradient(45deg, #c82333, #dc3545);
    transform: scale(1.05);
}

/* Tables */
.table-container {
    margin-top: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

table th {
    background-color: #007bff;
    color: white;
}

.table-responsive {
    overflow-x: auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        left: -250px; /* Initially hidden */
    }

    .sidebar.active {
        left: 0; /* Show the sidebar when active */
    }

    .content {
        margin-left: 0;
    }

    .content.active {
        margin-left: 250px; /* Push content to the right when sidebar is active */
    }

    .toggle-btn {
        display: block;
    }
}

    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Warehouse Management</div>
        <div class="sidebar-links-container">
            <ul class="sidebar-links">
            <li><a href="/admin_dashboard"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="/account-management"><span class="material-icons">inventory</span> Account Management </a></li>
            <li><a href="/archive-accounts"><span class="material-icons">storage</span> Account Archive</a></li>
            <li><a href="/request-product"><span class="material-icons">add_box</span> Request Product</a></li>

                  <!-- <li><a href="/inventory-log"><span class="material-icons">list</span> Inventory Logs</a></li> -->
            </ul>
        </div>
        <div class="logout-container">
            <a href="/logout" class="logout-button"><span class="material-icons">logout</span> Log out</a>
        </div>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <div class="dashboard-container">
          

            <h3>Requesting Products</h3>

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