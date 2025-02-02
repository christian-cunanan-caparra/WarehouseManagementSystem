<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Google Icons & FontAwesome -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
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
        .sidebar.hidden { left: -250px; }
        .sidebar-header { text-align: center; padding: 15px; font-weight: bold; border-bottom: 1px solid #495057; }
        .sidebar-links { list-style: none; padding: 0; }
        .sidebar-links li { padding: 12px 15px; }
        .sidebar-links li a { text-decoration: none; color: white; display: flex; align-items: center; gap: 10px; font-size: 16px; }
        .sidebar-links li a:hover { background-color: #495057; border-radius: 5px; }

        /* Toggle Button */
        .toggle-btn {
            position: fixed; left: 260px; top: 15px;
            background-color: #343a40; color: white;
            border: none; padding: 8px 12px;
            cursor: pointer; font-size: 20px;
            border-radius: 5px; transition: left 0.3s ease-in-out;
            z-index: 1001;
        }
        .toggle-btn.move { left: 15px; }

        /* Main Content */
        .content { margin-left: 270px; padding: 20px; transition: margin-left 0.3s ease-in-out; }
        .content.full-width { margin-left: 0; }

        /* Responsive */
        @media screen and (max-width: 768px) {
            .sidebar { left: -250px; }
            .content { margin-left: 0; }
            .toggle-btn { left: 15px; }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Warehouse Management</div>
        <ul class="sidebar-links">
            <li><a href="#"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="#"><span class="material-icons">inventory</span> Inventory</a></li>
            <li><a href="#"><span class="material-icons">list_alt</span> Products</a></li>
            <li><a href="#"><span class="material-icons">logout</span> Log out</a></li>
        </ul>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h1>Welcome, Admin <?= session()->get('user_name') ?>!</h1>

        <!-- Inventory Data -->
        <h3>Stock Overview</h3>
        <canvas id="inventoryChart"></canvas>

        <!-- Live Chat -->
        <h3>Live Chat</h3>
        <div id="chat-box" style="border:1px solid #ddd; padding:10px; height:200px; overflow-y:scroll;"></div>
        <input type="text" id="chat-input" class="form-control" placeholder="Type a message...">
        <button id="send-message" class="btn btn-primary mt-2">Send</button>
    </div>

    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("toggle-btn");
        const content = document.getElementById("main-content");

        let isSidebarOpen = false;
        toggleBtn.addEventListener("click", () => {
            isSidebarOpen = !isSidebarOpen;
            sidebar.classList.toggle("hidden");
            content.classList.toggle("full-width");
            toggleBtn.classList.toggle("move");
        });

        // Chart.js - Inventory Pie Chart
        function loadChart() {
            $.ajax({
                url: "<?= base_url('dashboard/getInventoryData') ?>",
                method: "GET",
                success: function(data) {
                    let parsedData = JSON.parse(data);
                    let ctx = document.getElementById("inventoryChart").getContext("2d");
                    new Chart(ctx, {
                        type: "pie",
                        data: {
                            labels: parsedData.labels,
                            datasets: [{
                                data: parsedData.values,
                                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"]
                            }]
                        }
                    });
                }
            });
        }
        loadChart();

        // Live Chat AJAX
        function loadChat() {
            $.ajax({
                url: "<?= base_url('chat/fetchMessages') ?>",
                method: "GET",
                success: function(data) {
                    $("#chat-box").html(data);
                }
            });
        }
        setInterval(loadChat, 2000);

        $("#send-message").click(function() {
            let message = $("#chat-input").val();
            if (message.trim() !== "") {
                $.post("<?= base_url('chat/sendMessage') ?>", { message: message }, function() {
                    $("#chat-input").val("");
                    loadChat();
                });
            }
        });

        // Auto-Hide Sidebar on Mobile
        if (window.innerWidth <= 768) { sidebar.classList.add("hidden"); content.classList.add("full-width"); toggleBtn.classList.add("move"); }
    </script>
</body>
</html>
