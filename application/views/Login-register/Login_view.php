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
            <div class="flex flex-col items-center gap-8">
                <!-- Header -->
                <div class="lg:text-left">
                    <h1 class="text-3xl font-semibold font-['SF Pro Rounded'] leading-9 tracking-tight">Welcome Back 👋</h1>
                    <p class="text-sm lg:text-[1rem] text-gray-600 mt-2 font-inter">Today is a new day. It's your day. You shape it. Sign in to start managing your projects.</p>
                </div>
              
                <!-- Form Fields -->
                <form action="<?php echo base_url('login_controller/login'); ?>" method="post" class="w-full flex flex-col gap-4">
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
                    <label for="Email" class="block text-gray-700">Email</label>
                    <input type="text" id="Email" name="email" class="w-full h-[3rem] p-3 bg-lightblue rounded-xl border border-gray-300 placeholder-gray-500 focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="Example@gmail.com">
                    <?php echo form_error('email'); ?>
                </div>
                <div class="w-full">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full p-3 h-[3rem] bg-lightblue rounded-xl border border-gray-300 placeholder-gray-500 focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="At least 8 characters">
                    <?php echo form_error('password'); ?>
                </div>
                <!-- Sign In Button -->
                <button type="submit" class="w-full py-4 h-12 flex items-center justify-center bg-black text-white text-lg rounded-xl hover:bg-blue-800 transition-colors">Sign In</button>
            </form>
           

                 <!-- Divider -->
                 <div class="flex items-center w-full -mt-5 -mb-5">
                    <hr class="w-full border-gray-300">
                    <span class="mx-4 text-sm text-gray-500">Or</span>
                    <hr class="w-full border-gray-300">
                </div>
                  <!-- Google Sign Up Button -->
                  <div class="w-full h-[2.5rem] bg-[#F3F9FA]">
                    <button class="flex -mt-2 items-center justify-center w-full py-2 bg-blue-50 rounded-xl text-gray-700 font-semibold hover:bg-blue-100 transition-colors">
                        <img class="w-6 h-6 lg:w-10 lg:h-10 mr-2" src="https://cdn1.iconfinder.com/data/icons/google-s-logo/150/Google_Icons-09-512.png" alt="Google Icon" />
                        Sign in with Google
                    </button>
                </div>
               
                <!-- Footer Links -->
                <div class="text-center text-gray-700 w-full text-sm">
                    <span>Don't you have an account? </span>
                    <a href="<?php echo base_url('register'); ?>" class="text-blue hover:underline">Sign up</a>
                </div>
            </div>
        </div>
        <!-- Image Section -->
        <div class="flex max-w-[27.6rem] h-auto lg:mb-0 -mt-2 flex items-center justify-center ml-[10rem] -mr-[10rem]">
            <img class="w-full h-auto rounded-[1rem] object-cover" src="<?php echo base_url('assets/images/login.svg'); ?>" alt="Placeholder Image"/>
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
