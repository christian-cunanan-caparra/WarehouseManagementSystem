<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Management</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
    }

    /* Sidebar Styles */
    .sidebar {
      position: fixed;
      top: 0;
      left: -270px;
      width: 270px;
      height: 100%;
      background: rgba(22, 26, 45, 0.9);
      backdrop-filter: blur(10px);
      color: white;
      padding: 20px;
      transition: 0.4s ease-in-out;
      z-index: 1000;
      border-right: 2px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar.active {
      left: 0;
    }

    .toggle-btn {
      position: fixed;
      top: 20px;
      left: 20px;
      background: #161a2d;
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
      font-size: 1.5rem;
      border-radius: 5px;
      z-index: 1001;
    }

    .content {
      margin-left: 50px;
      padding: 30px;
      transition: margin-left 0.4s ease;
      min-height: 100vh;
    }

    .content.active {
      margin-left: 270px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .content {
        margin-left: 0;
      }

      .sidebar {
        left: -270px;
      }

      .sidebar.active {
        left: 0;
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
    <div class="sidebar-header text-center mb-4">
      <h3>Warehouse Management</h3>
    </div>
    <ul class="list-unstyled">
      <li><a href="/employee_dashboard" class="text-white d-block p-2"><span class="material-icons">dashboard</span> Dashboard</a></li>
      <li><a href="/product" class="text-white d-block p-2"><span class="material-icons">inventory</span> Products</a></li>
      <li><a href="/inventory" class="text-white d-block p-2"><span class="material-icons">storage</span> Inventory</a></li>
      <li><a href="/inventory_logs" class="text-white d-block p-2"><span class="material-icons">history</span> Inventory Logs</a></li>
    </ul>
  </aside>

  <!-- Toggle Button -->
  <button class="toggle-btn" id="toggle-btn">&#9776;</button>

  <!-- Main Content -->
  <div class="content" id="main-content">
    <h1 class="text-center mb-4">Inventory Management</h1>

    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card bg-primary text-white">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h5>Total Products</h5>
              <h3><?= count(array_column($products, 'stock_in')) ?></h3>
            </div>
            <span class="material-icons">inventory</span>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card bg-success text-white">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h5>Total Inventory Stocks</h5>
              <h3><?= array_sum(array_column($products, 'remaining_stock')) ?></h3>
            </div>
            <span class="material-icons">inventory</span>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card bg-danger text-white">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h5>Total Stocks Out</h5>
              <h3><?= array_sum(array_column($products, 'stock_out')) ?></h3>
            </div>
            <span class="material-icons">inventory</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Table -->
    <div class="table-responsive">
      <table class="table table-striped">
        <thead class="bg-dark text-white">
          <tr>
            <th>Product Name</th>
            <th>Stock In</th>
            <th>Stock Out</th>
            <th>Remaining Stock</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product): ?>
            <?php if ($product['status'] == 1): ?>
              <tr>
                <td><?= esc($product['name']) ?></td>
                <td><?= esc($product['stock_in']) ?></td>
                <td><?= esc($product['stock_out']) ?></td>
                <td><?= esc($product['remaining_stock']) ?></td>
                <td>
                  <form action="/inventory/add-stock/<?= $product['id'] ?>" method="post" class="d-inline">
                    <button type="submit" class="btn btn-success btn-sm">Add Stock</button>
                  </form>
                  <form action="/inventory/remove-stock/<?= $product['id'] ?>" method="post" class="d-inline">
                    <button type="submit" class="btn btn-danger btn-sm">Remove Stock</button>
                  </form>
                </td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Sidebar toggle salogic
    // Sidebar toggle salogic
    // Sidebar toggle salogic

    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    toggleBtn.addEventListener('click', function () {
      sidebar.classList.toggle('active');
      mainContent.classList.toggle('active');
    });

    window.onload = function () {
      if (window.innerWidth > 768) {
        sidebar.classList.add('active');
        mainContent.classList.add('active');
      }
    };
  </script>
</body>
</html>
