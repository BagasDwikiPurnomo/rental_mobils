<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            /* overflow-y: hidden; */
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>">
    <link rel="icon" href="<?php echo base_url('assets/images/recars.svg'); ?>" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
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
              lightblue:'#F7FBFF'
            }
          }
        }
      }
    </script>
</head>
<body class="bg-white flex min-h-screen">
  <!-- Loading Overlay -->
  <div class="loading-overlay" id="loading-overlay" style="display: none;"></div>
    <div class="bg-white rounded-3xl flex w-full max-w-5xl h-1 mt-[17.5rem] p-4 sm:p-8 mx-auto">
        <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-center w-full">
            <!-- Image Section -->
            <div class="flex max-w-[28rem] mb-6 lg:mb-0 -ml-36 mr-[10rem]">
                <img class="w-full h-auto rounded-[2rem]" src="<?php echo base_url('assets/images/regist.svg'); ?>" alt="Placeholder Image"/>
            </div>

            <!-- Form Section -->
            <div class="w-[21rem]">
                <div class="flex flex-col items-center gap-8">
                    <!-- Header -->
                    <div class="lg:text-left w-full">
                        <h1 class="text-3xl font-semibold font-['SF Pro Rounded'] leading-9 tracking-tight">Get started with us</h1>
                        <p class="text-sm lg:text-[1rem] text-gray-600 mt-2 font-inter">Enter your personal data to create an account.</p>
                    </div>
                    <!-- Google Sign Up Button -->
                    <div class="w-full h-[2.5rem] bg-[#F3F9FA] -mt-5">
                        <button class="flex -mt-2 items-center justify-center w-full py-2 bg-blue-50 rounded-xl text-gray-700 text-semibold hover:bg-blue-100 transition-colors">
                            <img class="w-6 h-6 lg:w-10 lg:h-10 mr-2" src="https://cdn1.iconfinder.com/data/icons/google-s-logo/150/Google_Icons-09-512.png" alt="Google Icon" />
                            Sign up with Google
                        </button>
                    </div>
                    <!-- Divider -->
                    <div class="flex items-center w-full -mt-5 -mb-5">
                        <hr class="w-full border-gray-300">
                        <span class="mx-4 text-gray-500">Or</span>
                        <hr class="w-full border-gray-300">
                    </div>
                    <!-- Form Fields -->
                    <form class="w-full flex flex-col gap-4" action="<?php echo base_url('User/register_controller/register'); ?>" method="post">
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
                            <label for="username" class="block text-gray-700">Username</label>
                            <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" class="w-full h-[3rem] p-3 bg-lightblue rounded-xl border border-gray-300 placeholder-gray-500 focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="username" required>
                        </div>
                        <div class="w-full">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>" class="w-full p-3 h-[3rem] bg-lightblue rounded-xl border border-gray-300 placeholder-gray-500 focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="Example@gmail.com" required>
                        </div>
                        <div class="w-full">
                            <label for="password" class="block text-gray-700">Password</label>
                            <input type="password" id="password" name="password" class="w-full p-3 h-[3rem] bg-lightblue rounded-xl border border-gray-300 placeholder-gray-500 focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="At least 8 characters" required>
                        </div>
                        <button type="submit" class="w-full py-4 h-12 flex items-center justify-center bg-black text-white text-lg rounded-xl hover:bg-blue-800 transition-colors">Sign Up</button>
                    </form>

                    <!-- Footer Links -->
                    <div class="text-center text-gray-700 text-sm w-full -mt-5">
                        <span>Have an account? </span> 
                        <a href="<?php echo base_url('login'); ?>" class="text-blue hover:underline">Sign in</a>
                    </div>
                </div>
            </div>

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
