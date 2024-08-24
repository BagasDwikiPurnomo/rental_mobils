<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>
<div class="fixed top-0 left-0 bg-black text-white w-64 h-full pt-3 pb-3 z-50 flex flex-col justify-between">
    <div class="p-10">
        <a href="<?php echo base_url('Admin/Dashboard_controller'); ?>">
            <p class="font-['inter'] font-bold text-base mb-20">Hello, Admin!</p>
        </a>

        <div class="flex flex-col space-y-4">
            <a href="<?php echo base_url('User/User_controller'); ?>" class="block p-4 font-inter font-bold text-sm hover:bg-gray-700 rounded-lg transition-colors">
                <i class="fas fa-users"></i> 
                <span class="ml-2">Data User</span>
            </a>
            <a href="<?php echo base_url('admincarlist'); ?>" class="block p-4 font-inter font-bold text-sm hover:bg-gray-700 rounded-lg transition-colors">
                <i class="fas fa-car"></i>
                <span class="ml-2">Car List</span>
            </a>
            <a href="<?php echo base_url('rent'); ?>" class="block p-4 font-inter font-bold text-sm hover:bg-gray-700 rounded-lg transition-colors">
                <i class="fas fa-calendar-check"></i>
                <span class="ml-2">Rent User Rent</span>
            </a>
        </div>
    </div>

    <div class="p-10">
        <form action="<?php echo base_url('Admin/Admin_controller/logout'); ?>" method="post">
            <button type="submit" class="flex items-center w-full space-x-2 p-3 rounded-lg hover:bg-customLightBlue transition block p-4 font-inter font-bold text-sm hover:bg-gray-700 rounded-lg transition-colors">
                <i class="fas fa-sign-out-alt"></i>
                <span class="ml-2">Logout</span>
            </button>
        </form>
    </div>
</div>
</body>
</html>
