<!-- app/Views/productList.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

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

        /* Stock Trends Chart */
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
    <div class="container mt-5">
        <h1>Product List</h1>
        <a href="/admin/add-product" class="btn btn-primary mb-3">Add Product</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Stock In</th>
                    <th>Stock Out</th>
                    <th>Remaining Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= esc($product['id']) ?></td>
                        <td><?= esc($product['name']) ?></td>
                        <td><?= esc($product['description']) ?></td>
                        <td><?= esc($product['price']) ?></td>
                        <td><?= esc($product['quantity']) ?></td>
                        <td><?= esc($product['stock_in']) ?></td>
                        <td><?= esc($product['stock_out']) ?></td>
                        <td><?= esc($product['remaining_stock']) ?></td>
                        <td><?= esc($product['status']) ?></td>
                        <td>
                            <a href="/admin/edit-product/<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/admin/delete-product/<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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