<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            /* Optional: prevent vertical scrolling */
            overflow-y: hidden;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>">
    <title>Sign Up</title>
    <link rel="icon" href="<?php echo base_url('assets/images/recars.svg'); ?>" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
                inter: ['Inter', 'sans-serif'],
            },
            colors: {
              blue: '#1d4ae8', // Custom blue color
              lightblue: '#F7FBFF',
            }
          }
        }
      }
    </script>
</head>



<body class="bg-white flex items-center justify-center min-h-screen">
     <!-- Loading Overlay -->
     <div class="loading-overlay" id="loading-overlay" style="display: none;"></div>

    <div class="bg-white rounded-3xl flex flex-col lg:flex-row items-center justify-center w-full max-w-5xl p-4 sm:p-8">
        <!-- Form Section -->
        <div class="lg:w-[21rem] lg:flex-shrink-0 lg:ml-10 lg:mr-10">
            <div class="flex flex-col gap-8">
                <!-- Header -->
                <div class="text-left">
                    <h1 class="text-3xl text-left font-semibold font-['inter'] tracking-tight">Welcome admin!</h1>
                </div>
              
                <!-- Form Fields -->
                <form action="<?php echo base_url('Admin/Admin_controller/login'); ?>" method="post" class="w-full flex flex-col gap-4">
                <?php if($this->session->flashdata('error')): ?>
                            <div class="bg-red-100 text-red-700 p-4 rounded-lg">
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if($this->session->flashdata('success')): ?>
                            <div class="bg-green-100 text-green-700 p-4 rounded-lg">
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>

                <div class="w-full">
                    <label for="Username" class="block text-gray-700">Username</label>
                    <input type="text" id="Username" name="Username" class="w-full h-[3rem] p-3 bg-lightblue rounded-xl border border-gray-300 placeholder-gray-500 focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="Enter your username">
                    <?php echo form_error('Username'); ?>
                </div>
                <div class="w-full">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full p-3 h-[3rem] bg-lightblue rounded-xl border border-gray-300 placeholder-gray-500 focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="At least 8 characters">
                    <?php echo form_error('password'); ?>
                </div>
                <!-- Sign In Button -->
                <button type="submit" class="w-full py-4 h-12 flex items-center justify-center bg-black text-white text-lg rounded-xl hover:bg-blue-800 transition-colors">Login</button>
            </form>
           

                
    </div>
    <!-- JavaScript to show loading overlay -->
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            // Show the loading overlay
            document.getElementById('loading-overlay').style.display = 'block';
        });
    </script>
</body>
</html>

