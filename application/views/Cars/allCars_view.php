<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> 

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Cars</title>
    <link rel="icon" href="<?php echo base_url('assets/images/recars.svg'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- FLOWBITE -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css"  rel="stylesheet" />
    
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
              search_input: '#F4F5F5',
              greyModal: '#B3B3B3',

            }, 
            spacing: {
                '15': '3.7rem',
                '22': '5.5rem;',
                '34': '8.5rem',
                '37': '9.5rem',
                '72': '18rem',
                '73': '19rem',
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

<div class="flex justify-center mb-16 pt-28">
    <div class="flex flex-col">
        <div class="pb-4">
            <p class="text-6xl text-center pr-8 font-extrabold font-['Inter']">All Cars</p>
        </div>

        <!-- SEARCH INPUT -->
        <div class="flex flex-row">
          <div>
          <div class="flex justify-between">
            <input class="border border-transparent bg-search_input rounded-lg w-[650px] h-[70px] pl-4 placeholder-gray-900 placeholder-opacity-100 font-semibold
            focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-transparent" placeholder="Car brand, model, and etc." >

            <div class=" pt-2.5 transform -translate-x-16 ">
                <div class="bg-black_search rounded-lg w-[50px] h-[50px] pl-2">
                <img class="pt-2" src="<?php echo base_url('assets/images/icon_search.svg'); ?>" width="35" height="35">
                </div>
            </div>
            </div>
              </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center mb-20">
    <div>
        <div class="flex flex-row gap-x-4">

            <!-- ALL BUTTON -->
            <div>
                <div class="filter drop-shadow-lg">
                    <button id="btn-all" class="text-black_button text-xl focus:text-white bg-white hover:bg-black_button hover:text-white focus:bg-black_button rounded-full py-0.5 px-8 w-[93] h-[36]">
                    All
                    </button>
                </div>
            </div>

            <!-- BMW BUTTON -->
            <div>
                <div class="filter drop-shadow-lg">
                    <button id="btn-bmw" class="text-black_button text-xl focus:text-white bg-white hover:bg-black_button hover:text-white focus:bg-black_button rounded-full py-0.5 px-6 w-[93] h-[36]">
                     BMW
                    </button>
                </div>
            </div>

            <!-- MERCEDES -->
            <div>
                <div class="filter drop-shadow-lg">
                    <button id="btn-mercedes" class="text-black_button text-xl focus:text-white bg-white hover:bg-black_button hover:text-white focus:bg-black_button rounded-full py-0.5 px-6 w-[93] h-[36]">
                     Mercedes
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

 <!-- CARD ARRAY -->
<div id="cards-container" class="flex flex-wrap justify-center gap-12">
   <?php foreach ($cars as $car): ?>
       <div class="car-card flex flex-col w-[370px] bg-white rounded-b-2xl border border-black/20 rounded-lg mb-20" data-brand="<?php echo strtolower($car['merk']); ?>">
           <div class="relative flex flex-col">
               <!-- Image Wrapper -->
               <div class="relative">
                   <img class="rounded-t-lg object-cover h-[188px] w-full" src="<?php echo ($car['logo']); ?>" alt="Car Logo">
                   <!-- Hover Icon -->
                   <div class="absolute inset-0 flex items-end justify-end opacity-0 hover:opacity-100 transition-opacity">

                    <a href="<?php echo base_url('Cars/detailCars_controller/details/' . $car['car_id']); ?>">
                           <img class="bg-black rounded-lg w-12 p-2 m-2" src="<?php echo base_url('assets/images/icon go-to.svg'); ?>" width="25" height="25">
                    </a>

                   </div>
               </div>

               <!-- BACKGROUND WHITE -->
               <div class="w-full h-[420px] bg-white rounded-b-2xl border border-black/20">
                    <div class="flex flex-row pt-4">
                        <div class="pl-6 pb-4">
                            <?php
                            // Determine the image source based on the car's brand
                            $brand_image = '';
                            switch (strtolower($car['merk'])) {
                                case 'bmw':
                                    $brand_image = 'assets/images/BMW_images/BMW.svg';
                                    break;
                                case 'mercedes':
                                    $brand_image = 'assets/images/Mercedes_images/Mercedes_logo.svg';
                                    break;
                                default:
                                    $brand_image = 'assets/images/default_logo.svg'; // Fallback image
                                    break;
                            }
                            ?>
                            <img class="pt-3 object-contain h-[50px] w-[50px]" src="<?php echo base_url($brand_image); ?>" alt="Brand Logo">
                        </div>

                        <div>
                            <div class="flex flex-col pl-2 pt-3 gap-y-0.5">
                                <div>
                                    <p class="text-xl font-bold font-['Inter']"><?php echo htmlspecialchars($car['name']); ?></p>
                                </div>

                                <div>
                                    <p class="text-[10px] font-normal font-['Inter']"><?php echo htmlspecialchars($car['engine']); ?> - <?php echo htmlspecialchars($car['power']); ?> hp</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">

                        <!-- BODY TYPE -->
                        <div class="flex justify-between items-center">
                            <div class="w-1/2">
                                <p class="text-[15px] font-normal font-['Inter']">Body type</p>
                            </div>
                            <div class="w-1/2 text-right">
                                <p class="text-[15px] font-medium font-['Inter']"><?php echo htmlspecialchars($car['body_type']); ?></p>
                            </div>
                        </div>

                        <!-- ENGINE -->
                        <div class="flex justify-between items-center">
                            <div class="w-1/2">
                                <p class="text-[15px] font-normal font-['Inter']">Engine</p>
                            </div>
                            <div class="w-1/2 text-right">
                                <p class="text-[15px] font-medium font-['Inter']"><?php echo htmlspecialchars($car['engine']); ?></p>
                            </div>
                        </div>

                        <!-- TRANSMISSION -->
                        <div class="flex justify-between items-center">
                            <div class="w-1/2">
                                <p class="text-[15px] font-normal font-['Inter']">Transmission</p>
                            </div>
                            <div class="w-1/2 text-right">
                                <p class="text-[15px] font-medium font-['Inter']"><?php echo htmlspecialchars($car['transmission']); ?></p>
                            </div>
                        </div>

                        <!-- INTERIOR AND EXTERIOR -->
                        <div class="flex justify-between items-center">
                            <div class="w-1/2">
                                <p class="text-[15px] font-normal font-['Inter']">Power</p>
                            </div>
                            <div class="w-1/2 text-right">
                                <p class="text-[15px] font-medium font-['Inter']"><?php echo htmlspecialchars($car['power']); ?> hp</p>
                            </div>
                        </div>

                        <!-- SEATS -->
                        <div class="flex justify-between items-center">
                            <div class="w-1/2">
                                <p class="text-[15px] font-normal font-['Inter']">Seats</p>
                            </div>
                            <div class="w-1/2 text-right">
                                <p class="text-[15px] font-medium font-['Inter']"><?php echo htmlspecialchars($car['seats']); ?></p>
                            </div>
                        </div>

                        <!-- PRICING -->
                        <div class="flex justify-between items-center">
                            <div class="w-96">
                                <div class="flex flex-row">
                                    <div>
                                        <p class="text-3xl font-bold font-['Inter']"><?php echo 'Rp.' . number_format(htmlspecialchars($car['price_rent']), 0, ',', '.'); ?>
                                        </p>
                                    </div>

                                    <div class="pt-5">
                                        <p class="text-[10px] font-medium font-['Inter']">/days</p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="w-1/2 text-right">
                                <p class="text-[15px] font-medium font-['Inter']">Rent</p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

  </div>





  <script>
function showCards(brand) {
    const cards = document.querySelectorAll('.car-card');
    cards.forEach(card => {
        if (brand === 'all' || card.getAttribute('data-brand') === brand) {
            card.classList.remove('hidden');
        } else {
            card.classList.add('hidden');
        }
    });
}

document.getElementById('btn-all').addEventListener('click', function() {
    showCards('all');
});

document.getElementById('btn-bmw').addEventListener('click', function() {
    showCards('bmw');
});

document.getElementById('btn-mercedes').addEventListener('click', function() {
    showCards('mercedes');
});
</script>

<!-- FLOWBITE -->
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

</body>
</html>
