<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> 

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Cars</title>
    <link rel="icon" href="<?php echo base_url('assets/images/recars.svg'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
      <!-- FLOWBITE -->
      <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css"  rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
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
    .car-image {
    width: 100%; /* Lebar gambar mengikuti lebar kontainer */
    max-height: 45rem; /* Tinggi gambar tidak melebihi tinggi kontainer */
    object-fit: cover; /* Pastikan gambar tidak terdistorsi dan tetap menutupi area */
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
              grey_white: '#F2F2F2',



            }, 
            spacing: {
                '15': '3.7rem',
                '22': '5.5rem;',
                '34': '8.5rem',
                '72': '18rem',
                '82': '25.5rem',
                '84': '26rem',
                '85': '36rem', 
                '86': '30rem',
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
    <script>
    // Example: Set login status based on server-side data
    var isLoggedIn = <?php echo json_encode($this->session->userdata('username') !== null); ?>;
</script>
</head>
<body>
  <div class="overflow-hidden">

    <!-- NAVBAR -->
  <div class="fixed top-0 bg-white bg-opacity-60 backdrop-blur-sm pt-3 pb-3 z-50 w-full">
    <?php $this->load->view('Navbar/Navigation'); ?>
    </div>

    <div class="relative mb-20"> <!-- Set position to relative -->
    <!-- GAMBAR MOBIL -->
    <div class="overlay-container flex justify-center items-center relative">
        <div class="overlay-gradient"></div>
        <img 
            class="car-image" 
            src="<?php echo htmlspecialchars($car->logo); ?>"
            alt="Car Logo">
        
        <!-- Gambar brand -->
        <?php
        // Tentukan gambar berdasarkan merk dari data
        $brand = strtolower(trim($car->merk)); // Konversi merk menjadi lowercase untuk konsistensi

        // Tentukan gambar berdasarkan brand
        $brand_image = '';
        switch ($brand) {
            case 'bmw':
                $brand_image = 'assets/images/BMW_images/BMW.svg';
                break;
            case 'mercedes':
                $brand_image = 'assets/images/Mercedes_images/Mercedes_logo.svg';
                break;
            // Tambahkan case lain sesuai kebutuhan
            default:
                $brand_image = 'assets/images/default_image.svg'; // Gambar default jika brand tidak cocok
                break;
        }
        ?>
        <div class="absolute inset-0 flex flex-col items-center justify-center z-10 -mt-40">
            <div class="flex flex-col items-center justify-center">
                <img class="mb-2" src="<?php echo base_url($brand_image); ?>" width="60" height="60" alt="Brand Logo">
                
                <p class="text-center text-6xl font-extrabold font-['Inter']"><?php echo htmlspecialchars($car->name); ?></p>
                <p class="text-center text-black text-xl font-normal font-['Inter']"><?php echo htmlspecialchars($car->merk); ?> - year <?php echo htmlspecialchars($car->date); ?></p>
                
               <!-- Tombol yang akan pindah posisi -->
               <div id="sticky-button" class="fixed bottom-0 right-0 m-1">
            <!-- Assuming you have a way to check if the user is logged in, for example, a JavaScript variable or data attribute -->
<a id="rent-car-link" href="<?php echo base_url('Billing/Billing_controller/billing/' . $car->car_id); ?>" class="hidden">
    <!-- Hidden link that will be triggered when the user is logged in -->
</a>

<!-- Modal toggle button -->
<button data-modal-target="default-modal" data-modal-toggle="default-modal" type="button" class="text-white w-[330px] h-[67.84px] bg-black hover:bg-gray-200 hover:text-gray-900 p-3 rounded-xl text-xl font-medium font-['Inter']">
    Rent this car for Rp.<?php echo number_format($car->price_rent, 0, ',', '.'); ?>
</button>
              </div>


              
                   <!-- Main modal -->
          <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full  h-full">
              <!-- Overlay background -->
              <div class="fixed inset-0 bg-black opacity-50"></div>
              <!-- Modal content wrapper -->
              <div class="relative p-4 w-[470px] max-w-2xl h-[339px]">
                  <!-- Modal content -->
                  <div class="relative bg-white rounded-2xl shadow pt-12 pb-12">
                      <!-- Modal header -->
                      <div class="flex items-center justify-center p-4 md:p-5 rounded-t  ">
                          <div class="text-xl font-semibold pr-6">
                              <img class="" src="<?php echo base_url('assets/images/loginDoor.svg'); ?>" width="82" height="82">
                          </div>
                         
                      </div>
                      <!-- Modal body -->
                      <div class="flex justify-center">
                          <div class="flex flex-col">
                              <div>
                                  <p class="text-center leading-relaxed text-3xl font-bold font-['Inter']">
                                      You must login first!
                                  </p>
                              </div>
                              <div>
                                  <p class="text-center leading-relaxed text-black text-sm font-normal font-['Inter']">
                                      You have to login first to rent a car at recars.
                                  </p>
                              </div>
                          </div>
                      </div>
                      <!-- Modal footer -->
                      <div class="flex items-center justify-center p-4 md:p-5 border-gray-200 rounded-b dark:border-gray-600 space-x-6">
                          <!-- TO LOGIN PAGE -->
                          <a href="<?php echo base_url('login'); ?>">
                              <button data-modal-hide="default-modal" type="button" class="bg-white w-[139px] h-[53px] rounded-md border border-2 border-black hover:text-white hover:bg-black_button">Login Now</button>
                          </a>
                          <button data-modal-hide="default-modal" type="button" class="bg-white w-[139px] h-[53px] rounded-md border border-2 border-black hover:text-white hover:bg-black_button">Maybe Later</button>
                      </div>
                  </div>
              </div>
          </div>



            </div>
        </div>
    </div>
</div>

<!-- CAR DETAILS -->
<div class="bg-white bg-opacity-100 border-b-2 pl-32 mb-20 pb-12 "  id="trigger-element">
<div class="flex flex-row gap-x-48 -ml-32 items-center justify-center">
<!-- BODY TYPE -->
  <div>
    <div class="flex flex-col text-center items-center">
    <div class="text-black text-[40px] font-bold font-['Inter']"><?php echo htmlspecialchars($car->body_type); ?></div>
    <div class="text-black text-center text-sm font-normal font-['Inter']">Body type</div>
    </div>
  </div>

<!-- POWER -->
  <div>
  <div class="flex flex-col text-center items-center">
  <div class="text-black text-[40px] font-bold font-['Inter']"><?php echo htmlspecialchars($car->power); ?> hp</div>
  <div class="text-black text-center text-sm font-normal fort-['Inter']">Power</div>
    </div>
  </div>

  <!-- DRIVETRAIN -->
  <div>
  <div class="flex flex-col text-center items-center">
  <div class="text-black text-[40px] font-bold font-['Inter']"><?php echo htmlspecialchars($car->drivetrain); ?></div>
  <div class="text-black text-center text-sm font-normal font-['Inter']">Drivetrain</div>
    </div>
  </div>

  <!-- TRANSMISSION -->
  <div>
  <div class="flex flex-col">
  <div class="text-black text-[40px] font-bold font-['Inter']"><?php echo htmlspecialchars($car->transmission); ?></div>
  <div class="text-black text-center text-sm font-normal font-['Inter']">Transmission</div>
    </div>
  </div>

</div>
</div>

<?php 
// Assuming $car is the current car object and $car->other_photo contains the comma-separated URLs
$other_photos = explode(',', $car->other_photo); 
?>

<div class="flex flex-row mb-20 justify-center mr-[60rem]">
  <div>
    <div class="text-black text-3xl font-bold font-['Inter']">
      Others Photos
    </div>
  </div>
</div>

<!-- CAR PICTURES -->
<div class="flex justify-center mb-12 relative">
  <div>
    <div class="flex flex-col gap-y-4">
      <!-- Display the largest image -->
      <?php if (!empty($other_photos[0])): ?>
        <div class="rounded-xl">
          <img class="pt-2 rounded-[4rem] max-w-full h-[40rem] object-cover" src="<?php echo htmlspecialchars($other_photos[0]); ?>" width="1170" height="620">
        </div>
      <?php endif; ?>

      <!-- Display up to 4 smaller images -->
      <?php if (count($other_photos) > 1): ?>
        <div class="relative">
          <div class="w-full max-w-[1170px]">
            <div class="grid grid-cols-3 gap-4">
              <?php 
              // Display the first 3 smaller images
              for ($i = 1; $i < min(count($other_photos), 3); $i++): ?>
                <div class="rounded-xl overflow-hidden relative">
                  <img class="w-full h-[20rem] object-cover rounded-[2rem]" src="<?php echo htmlspecialchars($other_photos[$i]); ?>" alt="Smaller Image">
                </div>
              <?php endfor; ?>
              
              <?php if (count($other_photos) > 4): ?>
                <!-- Overlay for + N more -->
                <div class="rounded-xl overflow-hidden relative">
                  <img class="w-full h-[20rem] object-cover rounded-[2rem]" src="<?php echo htmlspecialchars($other_photos[4]); ?>" alt="More Images">
                  <div class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center text-white text-xl font-bold">
                    + <?php echo count($other_photos) - 4; ?> more
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>  
</div>

<!-- Modal -->
<div id="image-modal" class="fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center hidden z-50">
  <div class="relative max-w-4xl mx-auto bg-white p-4 rounded-lg">
    <button id="close-modal" class="absolute top-2 right-2 text-black font-bold text-xl">&times;</button>
    
    <!-- Large image display area -->
    <div class="mb-4">
      <img id="modal-main-image" class="w-full h-[30rem] object-cover rounded-[2rem]" src="<?php echo htmlspecialchars($other_photos[0]); ?>" alt="Main Modal Image">
    </div>
    
    <!-- Gallery of smaller images -->
    <div class="flex overflow-x-auto space-x-4 pb-2">
      <?php foreach ($other_photos as $photo): ?>
        <div class="w-20 h-20 rounded-xl overflow-hidden cursor-pointer">
          <img class="w-full h-full object-cover rounded-[1rem]" src="<?php echo htmlspecialchars($photo); ?>" alt="Gallery Image" data-src="<?php echo htmlspecialchars($photo); ?>">
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>


<!-- CAR OVERVIEW AND INTRODUCTION -->
<div class="flex justify-center mb-20">
  <div class="w-full max-w-[73rem]"> <!-- Mengatur lebar maksimum untuk kontainer -->
    <div class="flex flex-col gap-y-8">
      <div>
        <p class="text-black text-4xl font-bold font-['Inter']">
          <?php echo htmlspecialchars($car->name); ?> Overview and Introduction
        </p>
      </div>
      <div>
        <p class="text-left text-black text-lg font-normal font-['Inter'] leading-relaxed break-words"> <!-- Styling untuk teks -->
          <?php echo nl2br(htmlspecialchars($car->overview_introduction)); ?>
        </p>
      </div>
    </div>
  </div>
</div>

<!-- CAR FEATURES -->
<div class="flex justify-center mb-20">
  <div class="w-full max-w-[73rem]"> <!-- Mengatur lebar maksimum untuk kontainer -->
    <div class="flex flex-row justify-between"> <!-- Mengatur jarak antar kolom -->
      
      <!-- PRIMARY FEATURES -->
      <div class="flex flex-col gap-y-4 w-1/2 pr-4"> <!-- Menambah padding kanan -->
        <div>
          <p class="text-black text-3xl font-bold font-['Inter']">Primary Features</p>
        </div>
        <div>
          <p class="text-black text-xl font-normal font-['Inter'] leading-relaxed break-words">
            <?php echo nl2br(htmlspecialchars($car->primary_feature)); ?>
          </p>
        </div>
      </div>

      <!-- ADDITIONAL FEATURES -->
      <div class="flex flex-col gap-y-4 w-1/2 pl-4"> <!-- Menambah padding kiri -->
        <div>
          <p class="text-black text-3xl font-bold font-['Inter']">Additional Features</p>
        </div>
        <div>
          <p class="text-black text-xl font-normal font-['Inter'] leading-relaxed break-words">
            <?php echo nl2br(htmlspecialchars($car->additional_feature)); ?>
          </p>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="flex justify-center items-center bg-gray-50 mb-20 pb-20">
  <div class="flex flex-col space-y-16 pt-12 max-w-6xl w-full">
    <!-- Title -->
    <div>
      <p class="text-black text-3xl font-bold font-inter">All Technical Specifications</p>
    </div>

    <!-- Specifications Grid -->
    <div class="grid grid-cols-4 gap-x-12">
      <!-- SEATS -->
      <div class="flex flex-col items-left">
        <p class="text-black text-2xl font-bold font-inter"><?php echo htmlspecialchars($car->seats); ?></p>
        <p class="text-black text-xl font-normal font-inter">Number of seats</p>
      </div>

      <!-- CONSUMPTION -->
      <div class="flex flex-col items-left">
        <p class="text-black text-2xl font-bold font-inter"><?php echo htmlspecialchars($car->consumption); ?> liters/100 km</p>
        <p class="text-black text-xl font-normal font-inter">Consumption</p>
      </div>

      <!-- ENGINE -->
      <div class="flex flex-col items-left">
        <p class="text-black text-2xl font-bold font-inter"><?php echo htmlspecialchars($car->engine); ?></p>
        <p class="text-black text-xl font-normal font-inter">Engine</p>
      </div>

      <!-- EXTERIOR AND INTERIOR -->
      <div class="flex flex-col items-left">
        <p class="text-black text-2xl font-bold font-inter"><?php echo htmlspecialchars($car->inter_exter); ?></p>
        <p class="text-black text-xl font-normal font-inter">Exterior and Interior</p>
      </div>
    </div>

    <div class="grid grid-cols-4 gap-x-12">
      <!-- FUEL TYPE -->
      <div class="flex flex-col items-left">
        <p class="text-black text-2xl font-bold font-inter"><?php echo htmlspecialchars($car->fuel_type); ?></p>
        <p class="text-black text-xl font-normal font-inter">Fuel Type</p>
      </div>

      <!-- TRANSMISSION -->
      <div class="flex flex-col items-left">
        <p class="text-black text-2xl font-bold font-inter"><?php echo htmlspecialchars($car->transmission); ?></p>
        <p class="text-black text-xl font-normal font-inter">Transmission</p>
      </div>

      <!-- POWER -->
      <div class="flex flex-col items-left">
        <p class="text-black text-2xl font-bold font-inter"><?php echo htmlspecialchars($car->power); ?> hp</p>
        <p class="text-black text-xl font-normal font-inter">Power</p>
      </div>

      <!-- DRIVETRAIN -->
      <div class="flex flex-col items-left">
        <p class="text-black text-2xl font-bold font-inter"><?php echo htmlspecialchars($car->drivetrain); ?></p>
        <p class="text-black text-xl font-normal font-inter">Drivetrain</p>
      </div>
    </div>

    <!-- Additional Information -->
    <div>
      <p class="text-left text-black text-xl font-normal font-inter">
        Certified Pre-Owned Elite with less than 15,000 miles; Certified Pre-Owned with less than 60,000 miles.<br>
        1 year/unlimited miles from expiration of 4-year/50,000-mile new car warranty
      </p>
    </div>
  </div>
</div>




</div> 


<!-- MODAL SCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('default-modal');
        var buttons = document.querySelectorAll('[data-modal-toggle="default-modal"]');
        var closeButtons = document.querySelectorAll('[data-modal-hide="default-modal"]');
        var rentCarLink = document.getElementById('rent-car-link');

        // Simulate a check for login status
        var isLoggedIn = <?php echo json_encode($this->session->userdata('user_id') !== NULL); ?>;

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                if (isLoggedIn) {
                    // Redirect to the rental page if logged in
                    window.location.href = rentCarLink.href;
                } else {
                    // Show the modal if not logged in
                    modal.classList.toggle('hidden');
                    modal.setAttribute('aria-hidden', modal.classList.contains('hidden') ? 'true' : 'false');
                }
            });
        });

        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                modal.classList.add('hidden');
                modal.setAttribute('aria-hidden', 'true');
            });
        });

        // Disable hiding modal on window blur or focus events
        window.addEventListener('blur', function(e) {
            // Do nothing on blur
        });

        window.addEventListener('focus', function(e) {
            // Do nothing on focus
        });
    });
</script>




<script>
  // Open the modal and set the large image
  document.querySelectorAll('.rounded-xl.overflow-hidden.relative').forEach(function(elem) {
    elem.addEventListener('click', function() {
      if (this.querySelector('div') && this.querySelector('div').innerText.includes('more')) {
        document.getElementById('image-modal').classList.remove('hidden');
      }
    });
  });

  // Close the modal
  document.getElementById('close-modal').addEventListener('click', function() {
    document.getElementById('image-modal').classList.add('hidden');
  });

  // Change the large image when a small image is clicked
  document.querySelectorAll('#image-modal img[data-src]').forEach(function(img) {
    img.addEventListener('click', function() {
      document.getElementById('modal-main-image').src = this.getAttribute('data-src');
    });
  });

  // Close the modal if the background is clicked
  document.getElementById('image-modal').addEventListener('click', function(event) {
    if (event.target === this) {
      this.classList.add('hidden');
    }
  });
  
  document.querySelectorAll('.rounded-xl.overflow-hidden.relative').forEach(function(elem) {
    elem.addEventListener('click', function() {
      if (this.querySelector('div') && this.querySelector('div').innerText.includes('more')) {
        document.getElementById('image-modal').classList.remove('hidden');
      }
    });
  });

  document.getElementById('close-modal').addEventListener('click', function() {
    document.getElementById('image-modal').classList.add('hidden');
  });

  // Close the modal if the background is clicked
  document.getElementById('image-modal').addEventListener('click', function(event) {
    if (event.target === this) {
      this.classList.add('hidden');
    }
  });

document.addEventListener('DOMContentLoaded', function() {
    const triggerElement = document.getElementById('trigger-element');
    const stickyButton = document.getElementById('sticky-button');
    const triggerOffset = triggerElement.offsetTop + triggerElement.offsetHeight;

    function handleScroll() {
        const scrollPosition = window.scrollY + window.innerHeight;

        if (scrollPosition >= triggerOffset) {
            // Button should be fixed to the bottom right
            stickyButton.classList.remove('bottom-0');
            stickyButton.classList.add('fixed', 'bottom-6', 'right-6');
        } else {
            // Button should be in its original position
            stickyButton.classList.add('bottom-0');
            stickyButton.classList.remove('fixed', 'bottom-6', 'right-6');
        }
    }

    // Initial check
    handleScroll();

    // Check on scroll
    window.addEventListener('scroll', handleScroll);
});
</script>

</body>
</html>