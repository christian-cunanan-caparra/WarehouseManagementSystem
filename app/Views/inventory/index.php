<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Management</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Google Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    .sidebar {
      position: fixed;
      top: 0;
      left: -270px;
      width: 270px;
      height: 100%;
      background: rgba(22, 26, 45, 0.9);
      color: white;
      padding: 20px;
      transition: 0.4s ease-in-out;
      z-index: 1000;
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
      font-size: 1.5rem;
      cursor: pointer;
      border-radius: 5px;
      z-index: 1001;
    }

    .content {
      margin-left: 50px;
      padding: 30px;
      transition: margin-left 0.4s ease;
    }

    .content.active {
      margin-left: 270px;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <h3>Warehouse Management</h3>
    <ul class="list-unstyled">
      <li><a href="#" class="text-white d-block py-2">Dashboard</a></li>
      <li><a href="#" class="text-white d-block py-2">Products</a></li>
      <li><a href="#" class="text-white d-block py-2">Inventory</a></li>
      <li><a href="#" class="text-white d-block py-2">Logs</a></li>
    </ul>
  </aside>

  <!-- Toggle Button -->
  <button class="toggle-btn" id="toggle-btn">&#9776;</button>

  <!-- Main Content -->
  <div class="content" id="main-content">
    <h2 class="text-center">Inventory Management</h2>

    <!-- Inventory Table -->
    <div class="table-responsive mt-4">
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
  <tr>
    <td><?= esc($product['name']) ?></td>
    <td><?= esc($product['stock_in']) ?></td>
    <td><?= esc($product['stock_out']) ?></td>
    <td id="remainingStock<?= $product['id'] ?>"><?= esc($product['remaining_stock']) ?></td>
    <td>
      <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addStockModal" data-product-name="<?= esc($product['name']) ?>" data-product-id="<?= $product['id'] ?>">Add Stock</button>
      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeStockModal" data-product-name="<?= esc($product['name']) ?>" data-product-id="<?= $product['id'] ?>">Remove Stock</button>
    </td>
  </tr>
  <?php endforeach; ?>
</tbody>

      </table>
    </div>
  </div>

  <!-- Add Stock Modal -->
  <div class="modal fade" id="addStockModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">
            <h5 class="modal-title">Add Stock</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="addStockProductName" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="addStockProductName" readonly>
            </div>
            <div class="mb-3">
              <label for="addStockQuantity" class="form-label">Quantity</label>
              <input type="number" class="form-control" id="addStockQuantity" name="quantity" min="1" required>
            </div>
            <input type="hidden" id="addStockProductId" name="product_id">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Confirm</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Remove Stock Modal -->
  <div class="modal fade" id="removeStockModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">
            <h5 class="modal-title">Remove Stock</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="removeStockProductName" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="removeStockProductName" readonly>
            </div>
            <div class="mb-3">
              <label for="removeStockQuantity" class="form-label">Quantity</label>
              <input type="number" class="form-control" id="removeStockQuantity" name="quantity" min="1" required>
            </div>
            <input type="hidden" id="removeStockProductId" name="product_id">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Confirm</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Handle sidebar toggle
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      mainContent.classList.toggle('active');
    });

    // Pass product data to modals
   

// Handle the add stock form submission
document.querySelector('#addStockModal form').addEventListener('submit', function (e) {
  e.preventDefault();

  const productId = document.getElementById('addStockProductId').value;
  const quantity = document.getElementById('addStockQuantity').value;

  if (quantity <= 0) {
    alert('Please enter a valid quantity.');
    return;
  }

  fetch(`/inventory/add-stock/${productId}`, {
    method: 'POST',
    body: new URLSearchParams({ quantity }),
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        alert(data.message);
        document.getElementById('remainingStock' + productId).innerText = data.remaining_stock;
        bootstrap.Modal.getInstance(document.getElementById('addStockModal')).hide();
      } else {
        alert(data.message);
      }
    })
    .catch(err => console.error(err));
});

// Handle the remove stock form submission
document.querySelector('#removeStockModal form').addEventListener('submit', function (e) {
  e.preventDefault();

  const productId = document.getElementById('removeStockProductId').value;
  const quantity = document.getElementById('removeStockQuantity').value;

  if (quantity <= 0) {
    alert('Please enter a valid quantity.');
    return;
  }

  fetch(`/inventory/remove-stock/${productId}`, {
    method: 'POST',
    body: new URLSearchParams({ quantity }),
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        alert(data.message);
        document.getElementById('remainingStock' + productId).innerText = data.remaining_stock;
        bootstrap.Modal.getInstance(document.getElementById('removeStockModal')).hide();
      } else {
        alert(data.message);
      }
    })
    .catch(err => console.error(err));
});



  </script>
</body>
</html>
