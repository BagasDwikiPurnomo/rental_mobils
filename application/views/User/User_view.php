<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    black: '#1e3a8a',
                    customBlack: '#111827',
                }
            }
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        const errorMessage = '<?php echo $this->session->flashdata('error'); ?>';
        const successMessage = '<?php echo $this->session->flashdata('success'); ?>';

        if (errorMessage) {
            openModal();
            displayAlert(errorMessage, 'error');
        }

        if (successMessage) {
            displayAlert(successMessage, 'success');
        }
    });

    function openModal(user = null) {
        const modal = document.getElementById('modal');
        const form = document.getElementById('user-form');
        const modalTitle = document.getElementById('modal-title');
        const createPasswordSection = document.getElementById('create-password-section');
        const editPasswordSection = document.getElementById('edit-password-section');

        if (user) {
            modalTitle.textContent = 'Edit User';
            form.action = '<?php echo base_url('User/User_controller/update/'); ?>' + user.user_id;
            document.getElementById('user_id').value = user.user_id;
            document.getElementById('username').value = user.username;
            document.getElementById('email').value = user.email;
            document.getElementById('role').value = user.role;

            createPasswordSection.classList.add('hidden');
            editPasswordSection.classList.remove('hidden');
        } else {
            modalTitle.textContent = 'Create User';
            form.action = '<?php echo base_url('User/User_controller/store'); ?>';
            document.getElementById('username').value = '';
            document.getElementById('email').value = '';
            document.getElementById('role').value = '';

            createPasswordSection.classList.remove('hidden');
            editPasswordSection.classList.add('hidden');
        }

        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    document.getElementById('user-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const xhr = new XMLHttpRequest();
        
        xhr.open('POST', this.action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText);
                
                if (response.status === 'error') {
                    displayAlert(response.message, 'success');
                } else if (response.status === 'success') {
                    displayAlert(response.message, 'success');
                    setTimeout(() => {
                        closeModal();
                        location.reload();
                    }, 1000);
                }
            }
        };

        xhr.send(formData);
    });

    // function displayAlert(message, type) {
    //     const alertBox = document.createElement('div');
    //     alertBox.classList.add('alert');
    //     alertBox.classList.add(type === 'error' ? 'alert-danger' : 'alert-success');
    //     alertBox.textContent = message;

    //     const alertContainer = document.getElementById('alert-container');
    //     alertContainer.innerHTML = ''; // Clear previous alerts
    //     alertContainer.appendChild(alertBox);
        
    //     setTimeout(() => {
    //         alertBox.remove();
    //     }, 5000); // Remove the alert after 5 seconds
    // }

    </script>
</head>

<body class="p-12 flex flex-col gap-8 bg-white text-white">
    <?php $this->load->view('Admin/sidebar_view'); ?>

    <div class="ml-72 p-6">
   
                    
        <img class="w-[100px] h-[100px] mb-12 rounded-[10px]"
        src="<?php echo base_url('assets/images/Admin/recarsadmin.svg'); ?>"  />
        <h1 class="text-4xl font-bold mb-6 text-black">Data User</h1>
        <button onclick="openModal()" class="inline-block mb-4 px-4 py-2 bg-black text-white rounded hover:bg-gray-700 transition font-['inter']">
            Create New User
        </button>
        <?php if ($this->session->flashdata('success')): ?>
                        <div class="bg-green-100 text-green-700 p-4 rounded-lg">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
        <div id="alert-container" class="mb-4"></div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white-900 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-black text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Username</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Role</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300">
                    <?php foreach($users as $user): ?>
                    <tr class="border-b border-gray-700 hover:bg-gray-100 text-black font-['inter']">
                        <td class="py-3 px-6"><?php echo $user['user_id']; ?></td>
                        <td class="py-3 px-6"><?php echo $user['username']; ?></td>
                        <td class="py-3 px-6"><?php echo $user['email']; ?></td>
                        <td class="py-3 px-6"><?php echo $user['role']; ?></td>
                        <td class="py-3 px-6">
                            <a href="#" onclick='openModal(<?php echo json_encode($user); ?>)'
                                class="text-blue-400 hover:text-blue-300 mr-4">Edit</a>
                            <a href="<?php echo base_url('User/User_controller/delete/'.$user['user_id']); ?>"
                                class="text-red-400 hover:text-red-300" onclick="return confirm(                                   'Are you sure?');">Delete</a>
                           </td>
                       </tr>
                       <?php endforeach; ?>
                   </tbody>
               </table>
           </div>

           <!-- Modal -->
           <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
               <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg relative modal-content">
                   <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800">
                       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                       </svg>
                   </button>

                  
                   <h2 id="modal-title" class="text-3xl font-bold mb-6 text-black">Create User</h2>

                   <?php if ($this->session->flashdata('error')): ?>
                    <div class="bg-red-100 text-red-700 p-4 rounded-lg">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                    <?php endif; ?>

                   <form id="user-form" method="post" action="" class="space-y-4">
                       <input type="hidden" name="user_id" id="user_id" value="">
                       <div>
                           <label for="username" class="block text-gray-700 font-semibold mb-2">Username:</label>
                           <input type="text" name="username" id="username" required
                               class="w-full text-black p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
                       </div>

                       <div>
                           <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                           <input type="email" name="email" id="email" required
                               class="w-full text-black p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
                       </div>

                       <!-- Password section: visible in create mode, hidden in edit mode -->
                       <div id="create-password-section" class="block">
                           <div>
                               <label for="password" class="block text-gray-700 font-semibold mb-2">Password:</label>
                               <input type="password" name="password" id="password"
                                   class="w-full text-black p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
                           </div>
                       </div>

                       <!-- Password section for edit mode -->
                       <div id="edit-password-section" class="hidden">
                           <div>
                               <label for="new-password" class="block text-gray-700 font-semibold mb-2">New Password:</label>
                               <input type="password" name="new-password" id="new-password" placeholder="Leave empty if you dont want update"
                                   class="w-full text-black p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
                           </div>
                       </div>

                       <div>
                           <label for="role" class="block text-gray-700 font-semibold mb-2">Role:</label>
                           <select name="role" id="role"
                               class="w-full text-black p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
                               <option value="admin">Admin</option>
                               <option value="user">User</option>
                           </select>
                       </div>

                       <div class="text-right">
                           <button id="submit-button" type="submit"
                               class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-700 transition">Submit</button>
                       </div>
                   </form>
               </div>
           </div>

       </div>

   </body>

   </html>

