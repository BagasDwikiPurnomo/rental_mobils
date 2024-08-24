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
    <title>Dashboard</title>
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
     <?php $this->load->view('Admin/sidebar_view'); ?>

    <div class="ml-32 p-4 bg-white rounded-3xl -mt-36">
        <!-- Form Section -->
        <div class="lg:flex-shrink-0">
            <div class="flex flex-col gap-8">
                <!-- Header -->
                <div class="text-left">
                <img class="w-[100px] h-[100px] mb-12 rounded-[10px]"
                src="<?php echo base_url('assets/images/Admin/recarsadmin.svg'); ?>"  />                    
                <h1 class="text-3xl text-left font-bold font-['inter'] tracking-tight mt-20 mb-10">Welcome admin Recars</h1>
                    <div class="w-[748px] text-black text-base font-normal font-['Inter'] leading-[30px]">"Selamat Datang di Dashboard Admin Recars! Kelola reservasi, kendaraan, dan <br/>pelanggan dengan mudah di sini."</div>
                </div>
           

                
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

