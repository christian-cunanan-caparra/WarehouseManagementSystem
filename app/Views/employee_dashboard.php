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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            font-size: 1.5rem; /* Increased font size */
            font-weight: 700;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .sidebar-header .close-btn {
            cursor: pointer;
            font-size: 2rem; /* Larger close icon */
            transition: transform 0.3s ease;
        }

        .sidebar-header .close-btn:hover {
            transform: rotate(180deg); /* Rotate close button on hover */
        }

        .sidebar-links {
            list-style: none;
            margin-top: 20px;
        }

        .sidebar-links li {
            margin-bottom: 20px; /* Increased spacing between items */
        }

        .sidebar-links li a {
            color: white;
            font-size: 1.2rem; /* Larger font for links */
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px;
            border-radius: 50px; /* Rounded edges */
            transition: all 0.3s ease;
        }

        .sidebar-links li a:hover {
            background-color: #4f52ba;
            transform: scale(1.05); /* Slight hover zoom effect */
            box-shadow: 0 2px 8px rgba(79, 82, 186, 0.5); /* Shadow on hover */
        }

        .sidebar .menu-separator {
            margin: 20px 0;
            height: 1px;
            background-color: #4f52ba;
        }

        /* Toggle Button Styles (outside the sidebar) */
        .toggle-btn {
            position: absolute;
            top: 20px;
            left: -50px;  /* Positioned on the left side outside the sidebar */
            background-color: #161a2d;
            color: white;
            border: none;
            padding: 15px;
            cursor: pointer;
            font-size: 2rem; /* Increased size */
            z-index: 1100;
            border-radius: 50%; /* Circular button */
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Slight shadow for the toggle button */
        }

        .toggle-btn:hover {
            background-color: #4f52ba;
            transform: scale(1.1); /* Zoom effect on hover */
            box-shadow: 0 4px 12px rgba(79, 82, 186, 0.4); /* Stronger shadow on hover */
        }

        .toggle-btn:focus {
            outline: none;
        }

        .toggle-btn .material-icons {
            font-size: 2.5rem; /* Larger icon */
        }

        /* Close Button in Sidebar */
        .close-btn {
            display: none;
        }

        /* Modern Buttons for Table and Actions */
        .btn-modern {
            background: linear-gradient(145deg, #4f52ba, #3b4197);
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1rem;
            border-radius: 50px; /* Rounded button */
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(79, 82, 186, 0.2); /* Soft shadow */
        }

        .btn-modern:hover {
            background: linear-gradient(145deg, #3b4197, #4f52ba);
            transform: scale(1.05); /* Subtle scaling on hover */
            box-shadow: 0 5px 15px rgba(79, 82, 186, 0.4); /* Stronger shadow on hover */
        }

        .btn-modern:focus {
            outline: none;
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

        .content h1 {
            margin-left: 20px; /* Adjust margin-left for content */
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
            <!-- Close Button -->
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

    <!-- Toggle Button (Hamburger Icon) Outside Sidebar -->
    <button class="toggle-btn" id="toggle-btn">
        <span class="material-icons">menu</span> <!-- Open icon -->
    </button>

    <!-- Main Content (Container) -->
    <div class="content" id="main-content">
        <div class="container">
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
                        <td><button class="btn-modern">Edit</button></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
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
            toggleBtn.style.display = 'none'; // Hide open button when sidebar is open
            closeBtn.style.display = 'block'; // Show close button
        }

        // Toggle Sidebar visibility and save state to localStorage
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.add('active');
            mainContent.classList.add('active');
            toggleBtn.style.display = 'none'; // Hide open button
            closeBtn.style.display = 'block'; // Show close button

            // Save the sidebar state
            localStorage.setItem('sidebarState', 'active');
        });

        // Close the sidebar when close button is clicked
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
            mainContent.classList.remove('active');
            toggleBtn.style.display = 'block'; // Show open button again
            closeBtn.style.display = 'none'; // Hide close button

            localStorage.setItem('sidebarState', 'inactive');
        });
    </script>

</body>
</html>
