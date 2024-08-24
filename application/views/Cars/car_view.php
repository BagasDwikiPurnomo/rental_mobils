<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> 

<!DOCTYPE html>
<html>
    <head>
    <title>Recars</title>
    <link rel="icon" href="<?php echo base_url('assets/images/recars.svg'); ?>" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              white: '#FFFFFF',
              black_search: '#191921',
              debit_gray: '#6E828A',
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
        <body>

        <div class="overflow-hidden">
          
       <!-- NAVBAR -->
      <div class="fixed top-0 bg-white bg-opacity-60 backdrop-blur-sm pt-3 pb-3 z-50 w-full">
      <?php $this->load->view('Navbar/Navigation'); ?>
      </div>

          <div class="-mt-10 flex justify-center">
          <img src="assets/images/HomeBanner.svg" width="1520" height="922">
          </div>  
        
                      
          <div class=" transform -translate-y-100 -mb-80 flex justify-center ml-10 mt-10">
            <div class="flex flex-col gap-y-4">

            <div>
              <p class="text-5xl font-extrabold font-['Inter'] ml-12">The largest luxury car</p>
            </div>

            <div>
            <p class="text-5xl font-extrabold font-['Inter'] pl-8 ml-12">rentals marketplace
            </p>
            </div>

            <div>
            <input class="border border-transparent rounded-lg w-[650px] h-[70px] pl-4 placeholder-gray-900 placeholder-opacity-100 font-semibold
            focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent" placeholder="Car brand, model, and etc." >
            <div class="transform -translate-y-15 translate-x-85 bg-black_search rounded-lg w-[50px] h-[50px] pl-2">
              <img class="pt-2" src="assets/images/icon_search.svg" width="35" height="35">
            </div>
            </div>

            </div>
          </div>

          <div class="bg-white bg-opacity-100 border-b-2 p-10 mb-10 ">
            <div class="flex justify-center gap-x-6">

            <div class="flex flex-row ">
            <img src="assets/images/BMW_images/BMW.svg" width="45" height="45">
            <p class="pt-3 pl-3 text-3xl font-normal font-['SFProDisplay']">BMW</p>
            </div>

            <div class="flex flex-row">
            <img src="assets/images/Mercedes_images/Mercedes_Benz.svg" width="110" height="110">
            </div>
            </div>
          </div>

          <div class="flex justify-center mb-12">
            <div class="flex flex-col gap-y-2">
              <div class=""> <p class="text-lg text-center font-normal font-['SFProDisplay']">How it works</p></div>

              <div> <p class="text-[40px] font-bold font-['Inter']">Follow 3 easy steps</p></div>
            </div>

          </div>


          <!-- 3 EASY STEPS -->
          <div class="flex flex-row p-10 pl-20 mb-24 gap-x-4 -ml-12 justify-center">

            <!-- SEARCH FOR A CAR -->
              <div>
                  <div class="flex flex-col gap-y-4">
                    <div class="flex justify-center">
                      <div class="bg-black_search rounded-lg w-[50px] h-[50px] pl-3 pt-1.5">
                      <img class="pt-2" src="assets/images/icon_search.svg" width="25" height="25">
                      </div>
                    </div>

                    <div>
                      <p class="text-center text-2xl font-bold font-['Inter']">Search for a car</p>
                    </div>

                    <div>
                      <p class="text-center text-xl font-normal font-['Inter']">Know your purchase: Tools to calculate 
                      budget, financing and more</p>
                    </div>
                  </div>
              </div>

              <!-- First Line -->
              <div class="pt-6">
              <div class="w-[125px] h-[0px] border-2 border-black/20"></div>
              </div>

              <!-- PICKUP DATE -->
              <div>
                  <div class="flex flex-col gap-y-4">
                    <div class="flex justify-center">
                      <div class="bg-black_search rounded-lg w-[50px] h-[50px] pl-3 pt-1.5">
                      <img class="pt-2" src="assets/images/icon_date.svg" width="25" height="25">
                      </div>
                    </div>

                    <div>
                      <p class="text-center text-2xl font-bold font-['Inter']">Select pick-up date</p>
                    </div>

                    <div>
                      <p class="text-center text-xl font-normal font-['Inter']">Know before you buy: Honest reviews,
                      rankings and video test-drives</p>
                    </div>
                  </div>
              </div>

              <!-- Second Line -->
              <div class="pt-6">
              <div class="w-[125px] h-[0px] border-2 border-black/20"></div>
              </div>

              <!-- BOOK YOUR CAR -->
              <div>
                  <div class="flex flex-col gap-y-4">
                    <div class="flex justify-center">
                      <div class="bg-black_search rounded-lg w-[50px] h-[50px] pl-3 pt-1.5">
                      <img class="pt-2" src="assets/images/icon_checks.svg" width="25" height="25">
                      </div>
                    </div>

                    <div>
                      <p class="text-center text-2xl font-bold font-['Inter']">Book your car</p>
                    </div>

                    <div>
                      <p class="text-center text-xl font-normal font-['Inter']">Know your offer: Deal ratings on new and 
                      used listings near you</p>
                    </div>
                  </div>
              </div>
          </div>


          <!-- SECOND BANNER -->
            <div class="flex justify-center mb-12">
          <img class="relative" src="assets/images/second_banner.svg" width="1170" height="333">
            <div class="absolute">
              <p class="pt-64 text-[40px] font-bold font-['Inter']">Why you can trust us</p>
            </div>
          
            </div>

            <div class="flex flex-wrap justify-center  mb-10">
          <!-- CARDS SECTION -->
          <?php 
          $cards = [
              [
                  'title' => 'No hidden fee on arrival',
                  'description' => 'Know your purchase: Tools to calculate budget, financing and more',
                  'image' => 'assets/images/icon_card.svg'
              ],
              [
                  'title' => 'No hidden fee on arrival',
                  'description' => 'Know your purchase: Tools to calculate budget, financing and more',
                  'image' => 'assets/images/icon_card.svg'
              ],
              [
                  'title' => 'No hidden fee on arrival',
                  'description' => 'Know your purchase: Tools to calculate budget, financing and more',
                  'image' => 'assets/images/icon_card.svg'
              ]
          ];

          foreach ($cards as $card): ?>
              <div class="flex flex-col gap-y-6 p-8 mb-10 justify-center">
                  <div class="bg-debit_gray rounded-3xl w-[350px] h-[239px] pt-4">
                      <div class="flex justify-center">
                          <img class="pt-6" src="<?php echo $card['image']; ?>" width="50" height="50" alt="Card Icon">
                      </div>
                      <div class="pt-2">
                          <p class="text-center text-white text-xl font-bold font-['Inter']">
                              <?php echo $card['title']; ?>
                          </p>
                      </div>
                      <div class="pt-2">
                          <p class="text-center text-white text-[15px] font-normal font-['Inter']">
                              <?php echo $card['description']; ?>
                          </p>
                      </div>
                  </div>
              </div>
          <?php endforeach; ?>
      </div>


           <!-- EXPLORE POPULAR HEADLINE -->
           <div class="flex justify-center mb-10">
            <div class="text-[40px] font-bold font-['Inter']">
              <p>Explore popular car models</p>
            </div>
           </div>


         <!-- CARD ARRAY -->
        <div class="flex flex-wrap justify-center gap-12">
            <?php foreach ($cars as $car): ?>
                <div class="flex flex-col w-[370px] bg-white rounded-b-2xl border border-black/20 rounded-lg">
                    <div class="flex flex-col">
                    <div class="relative">
                        <img class="rounded-t-lg object-cover h-[188px] w-full" src="<?php echo ($car['logo']); ?>" alt="Car Logo">
                        <!-- Hover Icon -->
                        <div class="absolute inset-0 flex items-end justify-end opacity-0 hover:opacity-100 transition-opacity">
                        <a href="<?php echo site_url('Cars/detailCars_controller/details/' . $car['car_id']); ?>">
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
                                    <div class="w-full">
                                        <div class="flex flex-row">
                                            <div>
                                            <p class="text-3xl font-bold font-['Inter']">
                                              <?php echo 'Rp.' . number_format(htmlspecialchars($car['price_rent']), 0, ',', '.'); ?>
                                            </p>
                                            </div>

                                            <div class="pt-4">
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
                </div>
            </div>
           </div>

           

           <div class="flex justify-center mb-20 mt-10">
            <div class="text-white">
            <button class="bg-black_button hover:bg-gray-200 hover:text-gray-900 p-3 rounded-xl" onclick="window.location.href='<?php echo base_url('allcars'); ?>';">
              Explore All Cars
            </button>

            </div>
           </div>

           <div class="flex justify-center mb-20">
          <div>
            <a href="https://www.google.com/maps?q=Jakarta" target="_blank" rel="noopener noreferrer">
              <img class="pt-2 w-full transition-transform duration-200 transform hover:scale-105" src="assets/images/contactUsMap.svg" height="572">
            </a>
          </div>
        </div>



          </div>   
                
        </body>
    </head>
</html>