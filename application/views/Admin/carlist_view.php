<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            /* Optional: prevent vertical scrolling */
            /* overflow-y: hidden; */
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>">
    <title>Cars List</title>
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

    <div class="ml-40 p-4 bg-white rounded-3xl">
        <div class="ml-2 p-6">
            <img class="w-[100px] h-[100px] mb-12 rounded-[10px]"
                src="<?php echo base_url('assets/images/Admin/recarsadmin.svg'); ?>"  />
            <h1 class="text-4xl font-bold mb-6 text-black">Cars List</h1>

            <!-- Search and Filter Form -->
            <form action="<?php echo base_url('admincarindex'); ?>" method="get" class="flex flex-col lg:flex-row gap-4 mb-6">
                <input type="text" name="search" placeholder="Search by Name or Brand" value="<?php echo htmlspecialchars($search); ?>" class="rounded-lg p-4 w-[30rem] lg:w-1/3 text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">
                
                <select id="car-year" name="car-year" class="rounded-lg p-4 lg:w-[10rem] text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">
                    <option value="" disabled selected>Pilih Tahun</option>
                    <?php
                    // PHP code to generate a range of years
                    $currentYear = date('Y');
                    $startYear = $currentYear - 20; // Adjust the range as needed
                    $endYear = $currentYear;
                    
                    for ($year = $startYear; $year <= $endYear; $year++) {
                        echo "<option value=\"$year\" " . ($year == $selected_year ? 'selected' : '') . ">$year</option>";
                    }
                    ?>
                </select>

                <select name="brand" class="rounded-lg p-4 w-full lg:w-1/3 text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">
                    <option value="">All</option> <!-- Added "All" option -->
                    <!-- Dynamically populate options -->
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?php echo htmlspecialchars($brand); ?>" <?php echo $brand == $selected_brand ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($brand); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" class="inline-block px-4 py-2 bg-black text-white rounded hover:bg-gray-700 transition font-['inter']">
                    Filter
                </button>
            </form>


            <a href="<?php echo base_url('Admin/Carlist_controller/addcar'); ?>" class="inline-block mb-4 px-4 py-2 bg-black text-white rounded hover:bg-gray-700 transition font-['inter']">
                Add New Data
            </a>

            <!-- Form Section -->
            <div class="lg:flex-shrink-0">
                <div class="flex flex-col gap-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white-900 shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-black text-white">
                                <tr>
                                    <th class="py-3 px-6 text-left">ID</th>
                                    <th class="py-3 px-6 text-left">Image</th>
                                    <th class="py-3 px-6 text-left">Name</th>
                                    <th class="py-3 px-6 text-left">Brand</th>
                                    <th class="py-3 px-6 text-left">Price Rent</th>
                                    <th class="py-3 px-6 text-left">Date</th>
                                    <th class="py-3 px-6 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-300">
                                <?php foreach ($cars as $car): ?>
                                <tr class="border-b border-gray-700 hover:bg-gray-100 text-black font-['inter']">
                                    <td class="py-3 px-6"><?php echo $car['car_id']; ?></td>
                                    <td class="py-3 px-6 ">
                                        <img src="<?php echo htmlspecialchars($car['logo']); ?>" class="rounded-[10px]" alt="Car Logo" style="width: 5rem; height: auto;" />
                                    </td>
                                    <td class="py-3 px-6"><?php echo $car['name']; ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($car['merk']); ?></td>
                                    <td class="py-3 px-6">
                                        <?php
                                        // Format the price to Rupiah
                                        echo 'Rp. ' . number_format($car['price_rent'], 0, ',', '.');
                                        ?>
                                    </td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($car['date']); ?></td>
                                    <td class="py-3 px-6">
                                    <a href="<?php echo base_url('Admin/Carlist_controller/edit_car/' . $car['car_id']); ?>"
                                    class="text-blue-400 hover:text-blue-300 mr-4">Edit</a>
                                    <a href="<?php echo base_url('Admin/Carlist_controller/delete_car/' . $car['car_id']); ?>" 
                                    class="text-red-400 hover:text-red-300" 
                                    onclick="return confirm('Are you sure?');">
                                    Delete
                                    </a>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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

        function openModal(car) {
            // Handle opening modal with car details
            console.log(car);
        }
    </script>
</body>
</html>
