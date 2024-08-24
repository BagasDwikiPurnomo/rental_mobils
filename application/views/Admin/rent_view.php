<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Car List</title>
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
    </script>
</head>
<body class="p-12 bg-white text-black">
<?php $this->load->view('Admin/sidebar_view'); ?>
<div class="ml-72 p-6">
<h1 class="text-4xl font-bold mb-6">Rental Car List</h1>

    <form action="<?php echo base_url('Admin/Rent_controller'); ?>" method="get" class="flex flex-col lg:flex-row gap-4 mb-6">
        <input type="text" name="search" placeholder="Search by Car Name" value="<?php echo htmlspecialchars($search ?? ''); ?>" class="rounded-lg p-4 w-[30rem] lg:w-1/3 text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">
        
        <input type="date" name="start_date" placeholder="Start Date" value="<?php echo htmlspecialchars($start_date ?? ''); ?>" class="rounded-lg p-4 lg:w-[10rem] text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">
        
        <input type="date" name="end_date" placeholder="End Date" value="<?php echo htmlspecialchars($end_date ?? ''); ?>" class="rounded-lg p-4 lg:w-[10rem] text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">

        <button type="submit" class="inline-block px-4 py-2 bg-black text-white rounded hover:bg-gray-700 transition font-['inter']">
            Filter
        </button>
        <form action="<?php echo base_url('Admin/Rent_controller/export_to_excel'); ?>" method="post" class="flex flex-col lg:flex-row gap-4 mb-6">

        <button type="submit" formaction="<?php echo base_url('Admin/Rent_controller/export_to_excel'); ?>" class="inline-block px-4 py-2 bg-black text-white rounded hover:bg-gray-700 transition font-['inter']">
            Export Report
        </button>
    </form>

    </form>

        
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-black text-white">
                <tr>
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Username</th>
                    <th class="py-3 px-6 text-left">Car Name</th>
                    <th class="py-3 px-6 text-left">Start Date</th>
                    <th class="py-3 px-6 text-left">End Date</th>
                    <th class="py-3 px-6 text-left">Total Price</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php if(isset($rentals) && is_array($rentals)): ?>
                    <?php foreach($rentals as $rental): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6"><?php echo $rental['id']; ?></td>
                        <td class="py-3 px-6"><?php echo $rental['username']; ?></td>
                        <td class="py-3 px-6"><?php echo $rental['car_name']; ?></td>
                        <td class="py-3 px-6"><?php echo date('d M Y', strtotime($rental['start_date'])); ?></td>
                        <td class="py-3 px-6"><?php echo date('d M Y', strtotime($rental['end_date'])); ?></td>
                        <td class="py-3 px-6"><?php echo 'Rp ' . number_format($rental['total_price'], 0, ',', '.'); ?></td>
                        <td class="py-3 px-6">
                            <a href="<?php echo base_url('Admin/Rent_controller/delete/'.$rental['id']); ?>"
                               class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="py-3 px-6 text-center">No rentals found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>
