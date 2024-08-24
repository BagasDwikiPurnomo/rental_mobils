<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Review Cars</title>
    <link rel="icon" href="<?php echo base_url('assets/images/recars.svg'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <style>
  .overlay-gradient {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 80%; /* Adjust as needed */
      background: linear-gradient(to bottom, rgba(255,255,255, 10),  rgba(255, 255, 255, 0)); /* Gradient from white to transparent */
      z-index: 1; /* Ensure it’s below the text */
    }
    .overlay-container {
      position: relative;
      display: inline-block;
    }
    .overlay-container img {
      display: block;
    }
    .explore-more-container img {
      object-fit: cover;
      height: 100%;
      width: 100%;
    }
    .car-card {
    position: relative;
    transition: transform 0.2s ease, box-shadow 0.3s ease;
  }

  .car-card:hover {
    transform: translateY(-10px); /* Move the card up by 10px */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Add a shadow for emphasis */
  }

  .car-card img {
    border-radius: 0.5rem; /* Ensure the image has rounded corners */
  }

  .car-card .content {
    transition: transform 0.3s ease;
  }

  .car-card:hover .content {
    transform: translateY(-5px); /* Move the content up slightly */
  }

  </style>
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
            '82': '22rem',
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
  <?php if (!empty($cars)): ?>
    <?php
    // Shuffle the cars array to randomize the order
    shuffle($cars);

    // Featured Car (First Car)
    $first_car = $cars[0];
    ?>

    <!-- NAVBAR -->
    <div class="fixed top-0 bg-white bg-opacity-60 backdrop-blur-sm pt-3 pb-3 z-50 w-full">
      <?php $this->load->view('Navbar/Navigation'); ?>
    </div>

    <div class="-mt-10 relative">
      <div class="overlay-container flex justify-center">
        <div class="overlay-gradient"></div>
        <img class="pt-2 max-w-full h-[45rem] object-cover" src="<?php echo htmlspecialchars($first_car['logo']); ?>" width="1520" height="922" alt="Car Logo">
      </div>

      <div class="absolute inset-0 flex justify-center items-center">
        <p class="text-5xl font-extrabold font-['Inter'] -mt-[15rem] text-black z-20">Car Reviews</p>
      </div>
      
      <!-- Read Review Button -->
      <div class="absolute left-0 bottom-0 mb-20 ml-20 z-10">
        <a href="<?php echo base_url('Cars/detailCars_controller/details/'.$first_car['car_id']); ?>" class="text-black_button text-xl focus:text-white bg-white hover:bg-black_button hover:text-white focus:bg-black_button border-2 border-white px-4 py-2 rounded-xl">
          Read Review
        </a>
      </div>
    </div>
    <div class="flex flex-row transform -translate-y-[20rem] pl-20 z-20">
  <div class="flex flex-col gap-y-3 mt-10">
    <div class="inline-block">
      <span class="bg-black bg-opacity-70 p-2 rounded-lg text-white text-[40px] font-bold font-['Inter'] z-20 whitespace-nowrap">
        <?php echo htmlspecialchars($first_car['name']); ?>
      </span>
    </div>
    <div class="inline-block">
      <span class="bg-black bg-opacity-70 p-2 rounded-lg text-white text-xl font-light font-['Inter'] z-20 inline-block">
        <?php echo htmlspecialchars($first_car['overview_introduction']); ?>
      </span>
    </div>
  </div>
</div>

    <!-- Review Cards -->
    <div class="flex flex-col pl-10 pr-10 pb-10 gap-y-6">
      <div>
        <p class="text-black text-3xl font-bold font-['Inter']">Explore more car reviews</p>
      </div>

      <?php 
// Filter cars to include only BMW and Mercedes
$filtered_cars = array_filter($cars, function($car) {
    return in_array($car['merk'], ['BMW', 'Mercedes']);
});

// Exclude the first car
$filtered_cars = array_slice($filtered_cars, 1);

// Limit the number of cars to 6
$limited_cars = array_slice($filtered_cars, 0, 6);
?>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 explore-more-container">
    <?php foreach ($limited_cars as $car): ?>
        <div class="car-card">
            <a href="<?php echo base_url('Cars/detailCars_controller/details/'.$car['car_id']); ?>">
                <img class="w-full h-72 object-cover rounded-lg shadow-lg" src="<?php echo ($car['logo']); ?>" alt="Car Logo">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-4 rounded-lg content">
                    <p class="text-white text-sm"><?php echo date('M, d Y', strtotime($car['date'])); ?></p>
                    <p class="text-white text-lg font-bold"><?php echo htmlspecialchars($car['date']); ?> <?php echo htmlspecialchars($car['name']); ?></p>
                    <p class="text-white text-sm"><?php echo htmlspecialchars($car['overview_introduction']); ?></p>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>


    </div>

  <?php else: ?>
    <p>No car reviews available.</p>
  <?php endif; ?>
  </div>
</body>
</html>
