<!-- app/Views/productList.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
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
    height: 100vh;
    width: 250px;
    background-color: #343a40;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 15px;
    transition: left 0.3s ease-in-out;
    z-index: 1000;
  
}

/* Hidden sidebar */
.sidebar.hidden {
    left: -250px;
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

        .logout-container {
    position: absolute;
    bottom: 0;
    width: 100%;
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
    transition: left 0.3s ease-in-out;
    z-index: 1001;
}

.toggle-btn:hover {
            background-color: #495057;
        }



.toggle-btn.move {
    left: 15px;
}
        /* Content Styling */
        .content {
    margin-left: 270px;
    padding: 20px;
    transition: margin-left 0.3s ease-in-out;
}

.content.full-width {
    margin-left: 0;
}

h1{
    margin-left: 30px;
}
h2 {
            font-weight: bold;
            color: #343a40;
            margin-top: 30px; /* Slight margin top for the dashboard */
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



        #stockTrendChart {
            height: 400px;
        }

        /* Mini Pie Chart */
        #pieChart {
    height: 250px;   /* Fixed height */
    width: 250px;    /* Fixed width */
    margin: 0 auto;
    border-radius: 10px;
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

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .sidebar {
        left: -250px; /* Hide sidebar initially */
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

    .content {
        margin-left: 0;
    }

    .toggle-btn {
        left: 15px;
    }
        }
    </style>
</head>
<body>

    <!-- Sidehbar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Warehouse Management</div>
        <div class="sidebar-links-container">
            <ul class="sidebar-links">
                <li><a href="/L2FkbWluX2Rhc2hib2FyZA"><span class="material-icons">dashboard</span> Dashboard</a></li>
                <li><a href="/YWNjb3VudC1tYW5hZ2VtZW50"><span class="material-icons">inventory</span> Account Management</a></li>
                <li><a href="/YXJjaGl2ZS1hY2NvdW50cw"><span class="material-icons">storage</span> Account Archive</a></li>
                <li><a href="/cmVxdWVzdC1wcm9kdWN0"><span class="material-icons">add_box</span> Request Product</a></li>
                <li><a href="/product-list"><span class="material-icons">list_alt</span> Product List</a></li>
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
        <h1>Product List</h1>
        <a href="/addproduct" class="btn btn-primary mb-3">Add Product</a>
        <div class="table-container">
            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            
                          
                           
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTable">
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= esc($product['id']) ?></td>
                                <td><?= esc($product['name']) ?></td>
                                <td><?= esc($product['description']) ?></td>
                                <td><?= esc($product['price']) ?></td>
                               
                                <td>
                                    <a href="/editproduct/<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/deleteproduct/<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
         // Sidebar Toggle Functionality
         const sidebar = document.getElementById("sidebar");
const toggleBtn = document.getElementById("toggle-btn");
const content = document.getElementById("main-content");

let isSidebarOpen = false; // Default state is closed on mobile

toggleBtn.addEventListener("click", () => {
    isSidebarOpen = !isSidebarOpen;

    if (isSidebarOpen) {
        sidebar.classList.remove("hidden");
        content.classList.remove("full-width");
        toggleBtn.classList.remove("move");
        sidebar.style.left = "0"; // Open sidebar
        toggleBtn.style.left = "260px"; 
    } else {
        sidebar.classList.add("hidden");
        content.classList.add("full-width");
        toggleBtn.classList.add("move");
        sidebar.style.left = "-250px"; // Close sidebar
        toggleBtn.style.left = "15px";
    }
});

// Ensure sidebar is hidden on smaller screens on load
if (window.innerWidth <= 768) {
    sidebar.classList.add("hidden");
    sidebar.style.left = "-250px";
    content.classList.add("full-width");
    toggleBtn.classList.add("move");
    toggleBtn.style.left = "15px";
}


        // Automatically hide sidebar on small screens
        window.addEventListener('resize', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.add("hidden");
                content.classList.add("full-width");
                toggleBtn.classList.add("move");
                toggleBtn.style.left = "15px";
            } else {
                sidebar.classList.remove("hidden");
                content.classList.remove("full-width");
                toggleBtn.classList.remove("move");
                toggleBtn.style.left = "260px";
            }
        });

        // Initial check on page load
        if (window.innerWidth <= 768) {
            sidebar.classList.add("hidden");
            content.classList.add("full-width");
            toggleBtn.classList.add("move");
            toggleBtn.style.left = "15px";
        }


    </script>
</body>
</html>