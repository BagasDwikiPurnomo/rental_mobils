<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> 

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        blue: '#FFFFFF',
                    }
                }
            }
        }
    </script>
    <style>
        /* Additional styling if needed */
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userMenu = document.getElementById('user-menu');
            const modal = document.getElementById('modal');
            const closeModal = document.getElementById('close-modal');

            userMenu.addEventListener('mouseover', () => {
                modal.style.display = 'block';
            });

            userMenu.addEventListener('mouseleave', () => {
                // Add a slight delay before hiding the modal to avoid flickering
                setTimeout(() => {
                    if (!modal.matches(':hover')) {
                        modal.style.display = 'none';
                    }
                }, 200);
            });

            closeModal.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            document.addEventListener('click', (event) => {
                if (!userMenu.contains(event.target) && !modal.contains(event.target)) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</head>
<body>
    <div class="shadow-sm py-4 pr-10 pl-10">
        <!-- NAVBAR -->
        <div class="container mx-auto flex justify-between items-center">
            <!-- Brand Logo and Name -->
            <div class="flex items-center gap-x-2">
                <div>
                    <img src="<?php echo base_url('assets/images/recars.svg'); ?>" width="38" height="38">
                </div>
                <div>
                    <a class="text-[25px] font-semibold font-['Inter']" href="<?php echo base_url('home'); ?>">Recars</a>
                </div>
            </div>

            <!-- Links (Center) -->
            <div class="ml-20 flex space-x-8">
                <div>
                    <a class="text-xl font-normal font-['Inter']" href="<?php echo base_url('allcars'); ?>">All Cars</a>
                </div>
                <div>
                    <a class="text-xl font-normal font-['Inter']" href="<?php echo base_url('reviewcars')?>">Review</a>
                </div>
                <div>
                    <a class="text-xl font-normal font-['Inter']" href="<?php echo base_url('contactus')?>">Contact Us</a>
                </div>
            </div>

            <!-- User Login/Status (Right) -->
            <div id="user-menu" class="relative">
                <?php if($this->session->userdata('username')): ?>
                    <span class="text-right text-black text-base font-['Inter'] cursor-pointer">
                        How are you today, <span class="font-bold"><?php echo htmlspecialchars($this->session->userdata('username')); ?></span>
                    </span>
                    <!-- Modal -->
                    <div id="modal" class="absolute top-full right-0 mt-2 w-[13rem] h-[10rem] shadow-xl	 bg-white rounded-lg shadow-lg hidden">
    <div class="p-2">
        <!-- <button id="close-modal" class="absolute top-2 right-2 text-gray-500 text-lg">
            <i class="fas fa-times"></i>
        </button> -->
        <div class="flex flex-col -ml-5 space-y-1 p-10 -mt-5">
            <a href="<?php echo base_url('account'); ?>" class="flex items-center space-x-2 text-gray-700 hover:text-blue-500 py-1">
                <span>Account</span>
                <i class="fas fa-user text-base" style="margin-left: 45px;"></i>
            </a>
            <a href="<?php echo base_url('carhistory'); ?>" class="flex items-center space-x-2 text-gray-700 hover:text-blue-500 py-1">
                <span>Rent History</span>
                <i class="fas fa-history text-base"  style="margin-left: 15px;"></i>
            </a>
            <a href="<?php echo base_url('logout'); ?>" class="flex items-center space-x-2 text-red-500 hover:text-red-700 py-1">
                <span>Logout</span>
                <i class="fas fa-sign-out-alt text-base" style="margin-left: 55px;"></i>
            </a>
        </div>
    </div>
</div>

                <?php else: ?>
                    <a href="<?php echo base_url('login'); ?>" class="text-right text-black text-xl font-bold font-['Inter'] ml-[9rem]">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
