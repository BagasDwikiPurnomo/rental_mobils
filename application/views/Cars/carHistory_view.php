<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car History</title>
    <link rel="icon" href="<?php echo base_url('assets/images/recars.svg'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              white: '#FFFFFF',
              black_search: '#191921',
              debit_blue: '#6E828A',
              black_button: '#191921',
            }, 
            spacing: {
                '15': '3.7rem',
                '22': '5.5rem;',
                '34': '8.5rem',
                '72': '18rem',
                '84': '26rem',
                '85': '36rem', 
                '96': '80rem',
                '100': '46rem',
            },
            padding: {
              '3': '1.25rem',
              '7': '1.75rem',
              '15': '3.75rem', 
            },
            borderWidth: {
              DEFAULT: '1px',
              '0': '0',
              '2': '2.5px',
              '3': '3px',
              '4': '4px',
              '6': '6px',
            },
          },
        },
      };
    </script>
</head>
<body>
    <div class="overflow-hidden">

    <!-- NAVBAR -->
    <div class="fixed top-0 bg-white bg-opacity-60 backdrop-blur-sm pt-3 pb-3 z-50 w-full">
        <?php $this->load->view('Navbar/Navigation'); ?>
    </div>

    <!-- CAR HISTORY -->
    <div class="flex flex-col mt-28 mb-16 justify-center items-center">
        <div class="pb-8">
            <p class="text-black text-3xl font-bold font-['Inter'] text-start -ml-[36rem]">Cars That Are Being Rented</p>
        </div>

        <?php if (empty($car_history)): ?>
            <p>No rental history available.</p>
        <?php else: ?>
            <?php foreach ($car_history as $history): ?>
                <?php
                // Calculate the number of rental days
                $start_date = new DateTime($history->start_date);
                $end_date = new DateTime($history->end_date);
                $interval = $start_date->diff($end_date);
                $rental_days = $interval->days;

                // Calculate price per day with a 20,000 deduction
                $price_after_deduction = max($history->total_price - 20000, 0); // Ensure price is not negative
                $price_per_day = $rental_days > 0 ? $price_after_deduction / $rental_days : $price_after_deduction;
                ?>

<div class="bg-white border rounded-xl w-[1170px] p-3 mb-4">
    <div class="flex flex-row space-x-8">
        <div>
            <?php if ($history->logo): ?>
                <img class="rounded-2xl object-cover mt-2 h-[12rem]" src="<?php echo $history->logo; ?>" width="235" height="223">
            <?php else: ?>
                <img src="<?php echo base_url('assets/images/default_car.svg'); ?>" width="261" height="193"> <!-- Fallback image -->
            <?php endif; ?>
        </div>
        <div class="flex-grow">
            <div class="flex flex-col pt-2 space-y-12">
                <div>
                    <div class="flex justify-between">
                        <div>
                            <div class="flex flex-col">
                                <div>
                                    <p class="text-black text-3xl font-semibold font-['Inter']"><?php echo htmlspecialchars($history->car_name); ?></p>
                                </div>
                                <div>
                                    <p class="text-black text-xl font-normal font-['Inter']">Rp.<?php echo number_format($price_per_day, 0, ',', '.'); ?><span class="text-black text-sm font-normal font-['Inter']">/day</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 text-right w-[12rem]">
                            <p class="text-black text-xl font-semibold font-['Inter']">Rp.<?php echo number_format($history->total_price, 0, ',', '.'); ?></p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between space-x-8">
                        <div>
                            <div class="flex flex-col">
                                <div>
                                    <p class="text-black text-3xl font-semibold font-['Inter']">Rent from</p>
                                </div>
                                <div>
                                    <p class="text-black text-xl font-normal font-['Inter']"><?php echo date('d F Y', strtotime($history->start_date)) . ' - ' . date('d F Y', strtotime($history->end_date)); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 text-right w-[20rem]">
                            <div class="flex flex-col">
                                <div>
                                    <p class="text-black text-xl font-semibold font-['Inter']">Rental Time Expires</p>
                                </div>
                                <div>
                                    <p class="text-black text-xl font-semibold font-['Inter'] whitespace-nowrap overflow-hidden text-ellipsis">
                                        <?php echo date('d F Y, H:i:s', strtotime($history->end_date)); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
