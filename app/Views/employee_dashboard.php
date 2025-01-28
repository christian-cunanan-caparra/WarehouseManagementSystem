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
        /* ---- Sidebar Styling ---- */
        .sidebar {
            position: fixed;
            top: 0;
            left: -270px;
            width: 270px;
            height: 100%;
            background: rgba(22, 26, 45, 0.9); /* Dark Glassmorphism */
            backdrop-filter: blur(10px);
            color: white;
            padding: 20px;
            transition: 0.4s ease-in-out;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            border-right: 2px solid rgba(255, 255, 255, 0.1);
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

        .sidebar-links {
            list-style: none;
            padding: 0;
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
            gap: 12px;
            padding: 10px;
            transition: 0.3s ease;
            border-radius: 6px;
        }

        .sidebar-links li a:hover {
            background: rgba(255, 255, 255, 0.2);
            padding-left: 15px;
        }

        .menu-separator {
            margin: 15px 0;
            height: 1px;
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* ---- Close Button ---- */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            color: white;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .close-btn:hover {
            color: #f00;
        }

        /* ---- Main Content ---- */
        .content {
            margin-left: 270px;
            padding: 30px;
            transition: margin-left 0.4s ease;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .content.active {
            margin-left: 0;
        }

        /* ---- Responsive Design ---- */
        @media (max-width: 768px) {
            .sidebar {
                left: -270px;
            }

            .sidebar.active {
                left: 0;
            }

            .content {
                margin-left: 0;
            }

            .content.active {
                margin-left: 270px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <button class="close-btn" id="close-btn">&times;</button>
        <div class="sidebar-header">Warehouse Dashboard</div>
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

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h1>Employee Dashboard</h1>
        <p>Welcome to the Warehouse Management System. Here you can manage inventory, view products, and more.</p>
    </div>

    <script>
        // Sidebar Toggle Script
        const sidebar = document.getElementById('sidebar');
        const closeBtn = document.getElementById('close-btn');
        const mainContent = document.getElementById('main-content');

        // Automatically show the sidebar when the page loads
        window.onload = () => {
            sidebar.classList.add('active');
        };

        // Close the sidebar when the close button is clicked
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
            mainContent.classList.remove('active');
        });
    </script>

</body>
</html>
