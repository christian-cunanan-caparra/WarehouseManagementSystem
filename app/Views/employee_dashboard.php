<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - Warehouse Management System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: -260px;
            width: 260px;
            height: 100%;
            background-color: #161a2d;
            color: white;
            padding: 20px;
            transition: 0.3s ease;
            z-index: 1000;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            font-size: 1.25rem;
            font-weight: 600;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-header .close-btn {
            cursor: pointer;
            font-size: 1.5rem;
        }

        .sidebar-links {
            list-style: none;
            margin-top: 20px;
        }

        .sidebar-links li {
            margin-bottom: 15px;
        }

        .sidebar-links li a {
            color: white;
            font-size: 1.1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-links li a:hover {
            background-color: #4f52ba;
            border-radius: 4px;
            padding: 10px;
        }

        .sidebar .menu-separator {
            margin: 15px 0;
            height: 1px;
            background-color: #4f52ba;
        }

        /* New Advanced Toggle Button Styles */
        .toggle-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #161a2d;
            color: white;
            border: none;
            padding: 12px;
            cursor: pointer;
            font-size: 1.8rem;
            z-index: 1100;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .toggle-btn:hover {
            background-color: #4f52ba;
        }

        .toggle-btn:focus {
            outline: none;
        }

        .toggle-btn .material-icons {
            font-size: 2rem;
        }

        /* Content Styles */
        .content {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s ease, width 0.3s ease;
            width: 100%; /* Make content wide by default */
        }

        .content.active {
            margin-left: 260px;
            width: calc(100% - 260px); /* Make content narrow when sidebar is open */
        }

        /* Add responsive styles */
        @media (max-width: 768px) {
            .sidebar {
                left: -260px;
            }

            .sidebar.active {
                left: 0;
            }

            .content {
                margin-left: 0;
            }

            .content.active {
                margin-left: 260px;
            }

            .toggle-btn {
                top: 10px;
                left: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <span>Warehouse Dashboard</span>
            <span class="material-icons close-btn" id="close-btn">close</span>
        </div>
        <ul class="sidebar-links">
            <h4>Main Menu</h4>
            <li><a href="#"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="#"><span class="material-icons">inventory</span> Products</a></li>
            <li><a href="#"><span class="material-icons">settings</span> Settings</a></li>
            <div class="menu-separator"></div>
            <h4>Resume</h4>
            <li><a href="index.html"><span class="material-icons">account_circle</span> Christian Caparra</a></li>
            <li><a href="jhuniel.html"><span class="material-icons">account_circle</span> Jhuniel Galang</a></li>
        </ul>
    </aside>

    <!-- Advanced Toggle Button (Hamburger Icon) -->
    <button class="toggle-btn" id="toggle-btn">
        <span class="material-icons">menu</span> <!-- Advanced icon -->
    </button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h1>Employee Dashboard</h1>
        <p>Welcome to the Warehouse Management System. Here you can manage inventory, view products, and more.</p>

        <!-- Example Product Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Product A</td>
                    <td>High-quality item</td>
                    <td>50</td>
                    <td>$100</td>
                    <td><a href="#" class="btn btn-warning btn-sm">Edit</a></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

    <script>
        // Get elements
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const closeBtn = document.getElementById('close-btn');

        // Check local storage for sidebar state and set initial state
        const sidebarState = localStorage.getItem('sidebarState');
        if (sidebarState === 'active') {
            sidebar.classList.add('active');
            mainContent.classList.add('active');
        }

        // Toggle Sidebar visibility and save state to localStorage
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');

            // Save the sidebar state
            if (sidebar.classList.contains('active')) {
                localStorage.setItem('sidebarState', 'active');
            } else {
                localStorage.setItem('sidebarState', 'inactive');
            }
        });

        // Close the sidebar when close button is clicked
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
            mainContent.classList.remove('active');
            localStorage.setItem('sidebarState', 'inactive');
        });
    </script>

</body>
</html>
