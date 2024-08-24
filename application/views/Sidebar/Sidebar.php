<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        customBlue: '#1e3a8a',
                        customLightBlue: '#3b82f6',
                    }
                }
            }
        }
    </script>
    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-customBlue text-white h-screen p-5 flex flex-col">
            <h1 class="text-2xl font-bold mb-10">Dashboard</h1>
            <nav class="flex flex-col space-y-4">
                <a href="#" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-customLightBlue transition">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="#" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-customLightBlue transition">
                    <i class="fas fa-file-alt"></i>
                    <span>Reports</span>
                </a>
                <a href="#" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-customLightBlue transition">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <a href="#" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-customLightBlue transition">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
        <?php $this->load->view('User/User_view'); ?>
        
            <h2 class="text-4xl font-bold mt-5">Welcome to the Dashboard</h2>
            <p class="mt-4 text-gray-700">This is where your main content will be displayed.</p>
        </div>
    </div>
</body>

</html>
