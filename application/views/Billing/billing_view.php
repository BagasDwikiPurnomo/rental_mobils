<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> 

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Billing </title>
    <link rel="icon" href="<?php echo base_url('assets/images/recars.svg'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-5mCViWaZ4Sp5XzvA"></script>
  <style>
    input[type='radio']:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #d1d3d1;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #000000;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }
  </style>
  <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
            sans: ['Inter', 'sans-serif'],
            'serif': ['ui-serif', 'Georgia', ...],
            'mono': ['ui-monospace', 'SFMono-Regular', ...],
            'display': ['Oswald', ...],
            'body': ['"Open Sans"', ...],
            'inter': ['"inter"']
            },
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
     <script>
        // Expose PHP variable to JavaScript
        const carName = '<?php echo htmlspecialchars($car->name, ENT_QUOTES, 'UTF-8'); ?>';
    </script>
</head>
<body class="bg-white">
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loading-overlay" style="display: none;"></div>

<div class="overflow-hidden flex justify-center items-center -ml-[40rem]">
<div class="fixed top-0 bg-white bg-opacity-60 backdrop-blur-sm pt-3 pb-3 z-50 w-full ml-[40rem]">
  <?php $this->load->view('Navbar/Navigation'); ?>
</div>



<div class="lg:w-[32rem] lg:flex-shrink-0 lg:ml-10 lg:mr-10 flex">

<!-- Left side Rental summary -->
 <form class="flex" id="rental-form" action="<?php echo base_url('Billing/Billing_controller/save_rental'); ?>" method="post">
<div class="flex-col justify-start">
        <p class="mt-32 text-[#1a202c] text-2xl font-bold font-sans">Rental Summary</p>
      <p class="text-[#1a202c] text-base w-[30rem] font-normal font-sans">Prices may change depending on the length of the rental and the price of your rental car.</p>

      <div class="flex mt-10">
        <p class=""> <img class="pt-2 rounded-2xl" src="<?php echo htmlspecialchars($car->logo); ?>" width="140" height="922"></p>
        <p class="ml-6 text-[#1a202c] text-4xl font-bold font-sans w-[10rem]"><?php echo htmlspecialchars($car->name); ?></p>
      </div>
      <div class="flex mt-10">
  <p class="text-[#1a202c] text-base text-gray-400 font-sans">Subtotal</p>
  <p class="ml-auto text-[#1a202c] text-base text-black font-semibold font-sans">Rp.<?php echo number_format($car->price_rent, 0, ',', '.'); ?></p>
</div>
<div class="flex mt-5">
  <p class="text-[#1a202c] text-base text-gray-400 font-sans">Tax</p>
  <p class="ml-auto text-[#1a202c] text-base text-black font-semibold font-sans">Rp.20.000</p>
</div>

<div class="w-full flex bg-[#f6f7f9] mt-5 h-14 relative justify-start px-5 items-center ">
    <p class="font-sans text-gray-500">Apply promo code</p>
    <a class="ml-auto font-sans font-bold text-gray-700">Apply now</a>
</div>

<div class="flex -mb-2">
<p class="mt-5 text-[#1a202c] text-lg font-bold font-sans">Total Rental Price</p>
<p id="total-price-display" class="mt-5 ml-auto text-[#1a202c] text-xl text-black font-semibold font-sans">Rp.<?php echo number_format($car->price_rent, 0, ',', '.'); ?></p>
</div>
      <p class="text-[#1a202c] text-base w-[30rem] font-normal font-sans">Overall price and includes rental discount.</p>
      <button id="payment-button" type="submit" class="w-full flex justify-center items-center rounded-xl mb-20 bg-[#000000] mt-5 h-14 relative justify-start px-5 items-center hover:text-gray-900 font-sans text-white font-bold bg-black hover:bg-gray-200 ">
   Payment
</button>
      </div>
   
<!-- billing Info Right side -->
<div class="flex-col justify-start ml-20 -mt-5 mb-20">
      <p class="mt-32 text-[#1a202c] text-2xl font-bold font-sans">Billing Info</p>
      <div class="flex">
      <p class="text-[#1a202c] text-base w-[30rem] font-normal font-sans">Please enter your billing info</p>
      <p class="w-[5rem] ml-auto text-sm font-base text-gray-500 font-sans">Step 1 of 4</p> 
      </div>
      
  <div class="flex mt-10">
  <p class="font-semibold text-base text-black font-sans">Name</p>
  <p class="ml-[18rem] text-black text-base text-black font-semibold font-sans">Phone Number</p>
</div>

<div class="flex mt-5 space-x-[5rem]">
  <input required type="text" id="Username" name="Username" class="rounded-lg p-5 w-full h-8 text-black text-sm text-black font-sans bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none " placeholder="Your name">
  <input required type="number" id="number" name="number" inputmode="numeric" class="rounded-lg ml-auto p-5 w-full h-8 text-black text-sm text-black font-sans bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none " placeholder="Phone number">
    </div>

    <div class="flex mt-10">
  <p class="font-semibold text-base text-black font-sans">Address</p>
  <p class="ml-[17rem] text-black text-base text-black font-semibold font-sans">Town / City</p>
</div>

<div class="flex mt-5 space-x-[5rem]">
<input required type="text" id="Address" name="Address" inputmode="numeric" class="rounded-lg ml-auto p-5 w-full h-8 text-black text-sm text-black font-sans bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none " placeholder="Address">
<input required type="text" id="city" name="city" inputmode="numeric" class="rounded-lg ml-auto p-5 w-full h-8 text-black text-sm text-black font-sans bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none " placeholder="Town or city">
    </div>
    
    <p class="mt-10 text-[#1a202c] text-lg font-bold text-black font-sans">Rental Info</p>
<div class="flex mb-6">
  <p class="text-[#1a202c] text-base text-gray-500 font-sans">Please select your rental date</p>
  <p class="w-[5rem] ml-auto text-sm font-base text-gray-500 font-sans">Step 2 of 4</p> 
</div>

<!-- Radio button Pick-up -->
<div>
  <label class="inline-flex items-center">
    <input type="radio" class="form-radio text-blue-600 color-black h-4 w-4" name="rental_type" value="End" id="End_radio" required checked>
    <span class="ml-2 text-gray-900 text-lg font-semibold">start rental</span>
  </label>
</div>

<div class="flex mt-5 space-x-10">
  <!-- Time Picker Dropdown for Paket 1 -->
   <div class="flex flex-col">
<div class="flex">
  <p class="font-semibold text-base text-black font-sans">Time</p>
</div>

<div class="flex mt-5 space-x-[5rem] mb-6">
  <div class="relative inline-block text-left">
    <div>
      <button type="button" class="w-[250px] text-center flex items-center justify-between rounded-md bg-white p-4 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="time-button-paket1" aria-expanded="true" aria-haspopup="true" required>
        End Time: 00:00
        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>

    <!-- Time Picker Dropdown for Paket 1 -->
    <div id="time-picker-dropdown-paket1" class="absolute left-0 z-10 mt-2 w-[250px] origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transform opacity-0 scale-95 transition ease-out duration-100 hidden" role="menu" aria-orientation="vertical" aria-labelledby="time-button-paket1" tabindex="-1">
      <div class="p-4">
        <div class="grid grid-cols-2 gap-2">
          <!-- Hour Selector -->
          <select id="hour-select-paket1" class="p-2 bg-white border border-gray-300 rounded-md">
            <!-- Hours 00 to 23 -->
            <option value="00">00</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
          </select>
          <!-- Minute Selector -->
          <select id="minute-select-paket1" class="p-2 bg-white border border-gray-300 rounded-md">
            <!-- Minutes 00 to 59 -->
            <option value="00">00</option>
            <option value="05">05</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
            <option value="55">55</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</div></div>

  <!-- Date Picker -->
  <div class="relative inline-block text-left">
    <div>
      <p class="text-black text-base font-semibold font-sans mb-5">Date</p>
      <button type="button" class="w-[250px] text-center flex items-center justify-between rounded-md bg-white p-4 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="date-button-paket1" aria-expanded="true" aria-haspopup="true" required>
        Select a Date
        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>

    <!-- Date Picker Dropdown for Paket 1 -->
    <div id="date-picker-dropdown-paket1" class="absolute left-0 z-10 mt-2 w-[250px] origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transform opacity-0 scale-95 transition ease-out duration-100 hidden" role="menu" aria-orientation="vertical" aria-labelledby="date-button-paket1" tabindex="-1">
      <div class="p-4">
        <div class="flex justify-between items-center mb-2">
          <button id="prev-month-paket1" class="text-gray-500 hover:text-gray-700" type="button">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          <div id="month-year-paket1" class="text-lg font-semibold text-gray-700"></div>
          <div id="month-year-paket1" class="text-lg font-semibold text-gray-900"></div>
          <button id="next-month-paket1" class="text-gray-500 hover:text-gray-700" type="button">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
          </div>

        <div id="calendar-grid-paket1" class="grid grid-cols-7 gap-2 text-center text-gray-700"></div>
      </div>
    </div>
  </div>
</div>

<p class="font-semibold text-base text-black font-sans mb-5">Rental Duration</p>

<!-- Date Picker Dropdown for Paket 1 -->
<div class="relative inline-block text-left">
  <div>
    <button type="button" class="w-[250px] text-center flex items-center justify-between rounded-md bg-white p-4 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="day-button" aria-expanded="true" aria-haspopup="true" required>
      Select your day
      <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
      </svg>
    </button>
  </div>
  <div id="dropdown-paket1" class="hidden absolute right-0 z-10 mt-2 w-[15.7rem] origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="day-button">
      <!-- Example day options -->
      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">1 Day</a>
      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">2 Day</a>
      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">3 Day</a>
      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">4 Day</a>
      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">5 Day</a>
      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">6 Day</a>
      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">1 Week</a>
    </div>
  </div>
</div>
<div id="url-warning" class="mt-4 text-sm text-red-600 text-justify">

<p>To view the final rental preview, please <strong>input the rental duration data again</strong>. This will help ensure that all details are accurate before finalizing your rental.</p>
</div>


<!-- End Rental Section -->
<div class="end-rental-section">
  <!-- Radio button Drop-off -->
<div>
  <label class="inline-flex items-center mt-10 mb-5">
  <span class="text-gray-900 text-lg font-semibold">end rental</span>
  </label>
</div>
<div class="space-x-10">
    <!-- End Time Display -->
    <div class="relative inline-block text-left mb-5">
      <div id="end-time-display" class="w-[250px] text-center flex items-center justify-between rounded-md bg-white p-4 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300">
        End Time: Not Set
      </div>
    </div>
    
    <!-- End Date Display -->
    <div class="relative inline-block text-left">
      <div id="end-date-display" class="w-[250px] text-center flex items-center justify-between rounded-md bg-white p-4 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300">
        End Date: Not Set
      </div>
    </div>
  </div>
</div>
</div>

  
</div>
</div>
</form>
    
<script>
  
document.addEventListener('DOMContentLoaded', function() {
    const paymentButton = document.getElementById('payment-button');
    const startTimeButton = document.getElementById('time-button-paket1');
    const startDateButton = document.getElementById('date-button-paket1');
    const endTimeDisplay = document.getElementById('end-time-display');
    const endDateDisplay = document.getElementById('end-date-display');
    const dayButton = document.getElementById('day-button');
    const totalPriceDisplay = document.getElementById('total-price-display');
    const loadingOverlay = document.getElementById('loading-overlay');

    const carPrice = <?php echo $car->price_rent; ?>;
    const carName = "<?php echo $car->name; ?>";

    function updateEndRentalPreview() {
        const startTimeText = startTimeButton.textContent.trim().replace('End Time: ', '');
        const startDateText = startDateButton.textContent.trim().replace('Select a Date', '');
        const rentalDurationText = dayButton.textContent.trim().replace('Select your day', '');

        if (startTimeText === '00:00' || startDateText === '' || rentalDurationText === '') {
            endTimeDisplay.textContent = 'End Time: Not Set';
            endDateDisplay.textContent = 'End Date: Not Set';
            totalPriceDisplay.textContent = 'Total Price: Rp.0';
            return;
        }

        const [startDay, startMonth, startYear] = startDateText.split('/').map(Number);
        const startDate = new Date(startYear, startMonth - 1, startDay);
        const [startHours, startMinutes] = startTimeText.split(':').map(Number);
        startDate.setHours(startHours, startMinutes);

        let rentalDays = 0;
        if (rentalDurationText.includes('Day')) {
            rentalDays = parseInt(rentalDurationText);
        } else if (rentalDurationText.includes('Week')) {
            rentalDays = parseInt(rentalDurationText) * 7;
        }

        const endDate = new Date(startDate);
        endDate.setDate(startDate.getDate() + rentalDays);

        const endDateFormatted = `${endDate.getFullYear()}-${(endDate.getMonth() + 1).toString().padStart(2, '0')}-${endDate.getDate().toString().padStart(2, '0')} ${endDate.getHours().toString().padStart(2, '0')}:${endDate.getMinutes().toString().padStart(2, '0')}`;

        endTimeDisplay.textContent = `End Time: ${endDate.getHours().toString().padStart(2, '0')}:${endDate.getMinutes().toString().padStart(2, '0')}`;
        endDateDisplay.textContent = `End Date: ${endDateFormatted}`;
        
        const totalPrice = (carPrice * rentalDays) + 20000;
        totalPriceDisplay.textContent = `Total Price: Rp.${totalPrice.toLocaleString('id-ID')}`;
    }

    // Fungsi untuk memeriksa apakah semua input telah diisi
    function checkAllInputsFilled() {
        const startTimeText = startTimeButton.textContent.trim().replace('End Time: ', '');
        const startDateText = startDateButton.textContent.trim().replace('Select a Date', '');
        const rentalDurationText = dayButton.textContent.trim().replace('Select your day', '');

        return startTimeText !== '00:00' && startDateText !== '' && rentalDurationText !== '';
    }

    // Fungsi untuk memperbarui preview jika semua input telah diisi
    function updatePreviewIfAllFilled() {
        if (checkAllInputsFilled()) {
            updateEndRentalPreview();
        }
    }

    // Event listeners untuk setiap input
    startTimeButton.addEventListener('click', updatePreviewIfAllFilled);
    startDateButton.addEventListener('click', updatePreviewIfAllFilled);
    dayButton.addEventListener('click', updatePreviewIfAllFilled);

    // Tambahkan MutationObserver untuk memantau perubahan konten
    const observerConfig = { childList: true, subtree: true, characterData: true };

    const startTimeObserver = new MutationObserver(updatePreviewIfAllFilled);
    startTimeObserver.observe(startTimeButton, observerConfig);

    const startDateObserver = new MutationObserver(updatePreviewIfAllFilled);
    startDateObserver.observe(startDateButton, observerConfig);

    const dayButtonObserver = new MutationObserver(updatePreviewIfAllFilled);
    dayButtonObserver.observe(dayButton, observerConfig);

    paymentButton.addEventListener('click', function(event) {
        event.preventDefault();

        const startDateText = startDateButton.textContent.trim().replace('Select a Date', '');
        const endDateText = endDateDisplay.textContent.trim().replace('End Date: ', '');
        const totalPriceText = totalPriceDisplay.textContent.trim().replace('Total Price: Rp.', '').replace(/\./g, '').trim();

        if (startDateText === 'Select a Date' || endDateText === 'Not Set' || totalPriceText === '') {
            alert('Please complete all required fields before proceeding.');
            return;
        }

        // Format start date for database
        const [startDay, startMonth, startYear] = startDateText.split('/').map(Number);
        const startTime = startTimeButton.textContent.trim().replace('End Time: ', '');
        const [startHours, startMinutes] = startTime.split(':').map(Number);
        const formattedStartDate = `${startYear}-${startMonth.toString().padStart(2, '0')}-${startDay.toString().padStart(2, '0')} ${startHours.toString().padStart(2, '0')}:${startMinutes.toString().padStart(2, '0')}`;
        
        // Show the loading overlay
        loadingOverlay.style.display = 'block';

        fetch('<?php echo site_url('Billing/Billing_controller/save_rental'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'car_name': carName,
                'start_date': formattedStartDate,
                'end_date': endDateText,
                'total_price': totalPriceText
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Open Snap payment page
                snap.pay(data.snapToken, {
                    onSuccess: function(result){
                        finishPayment(result, formattedStartDate, endDateText);
                    },
                    onPending: function(result){
                        alert("Payment pending!");
                    },
                    onError: function(result){
                        alert("Payment failed!");
                    },
                    onClose: function(){
                        alert('You closed the popup without finishing the payment');
                    }
                });
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('An unexpected error occurred.');
            loadingOverlay.style.display = 'none';
        });
    });

    function finishPayment(result, startDate, endDate) {
        fetch('<?php echo site_url('Billing/Billing_controller/finish_payment'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'result_data': JSON.stringify(result),
                'start_date': startDate,
                'end_date': endDate,
                'car_name': carName
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Payment successful and rental data saved!');
                // Redirect to the car history page
                window.location.href = '<?php echo base_url('carhistory'); ?>';
            } else {
                alert(data.message);
                loadingOverlay.style.display = 'none';
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('An unexpected error occurred while finishing the payment.');
            loadingOverlay.style.display = 'none';
        });
    }
});
</script>

</script>


<!-- Time JavaScript for Package 1 -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
  const buttonPaket1 = document.getElementById('day-button');
  const dropdownPaket1 = document.getElementById('dropdown-paket1');

  // Toggle dropdown visibility
  buttonPaket1.addEventListener('click', function() {
    const isVisible = dropdownPaket1.classList.contains('hidden');
    if (isVisible) {
      dropdownPaket1.classList.remove('hidden');
    } else {
      dropdownPaket1.classList.add('hidden');
    }

    // Adjust the position of the dropdown to appear above the button
    dropdownPaket1.style.bottom = '100%';
    dropdownPaket1.style.top = 'auto';
  });

  // Handle day selection
  dropdownPaket1.addEventListener('click', function(event) {
    // Prevent default anchor behavior
    event.preventDefault();

    if (event.target.tagName === 'A') {
      // Update the button text with the selected day
      buttonPaket1.textContent = event.target.textContent;
      // Close the dropdown
      dropdownPaket1.classList.add('hidden');
    }
  });

  // Hide dropdown when clicking outside
  document.addEventListener('click', function(event) {
    if (!buttonPaket1.contains(event.target) && !dropdownPaket1.contains(event.target)) {
      dropdownPaket1.classList.add('hidden');
    }
  });
});



document.addEventListener('DOMContentLoaded', function() {
  const EndRadio = document.getElementById('End_radio');
  const dropoffRadio = document.getElementById('dropoff_radio');
  const EndFields = document.querySelectorAll('#city-button-paket1, #date-button-paket1, #time-button-paket1');
  const dropoffFields = document.querySelectorAll('#city-button-paket2, #date-button-paket2, #time-button-paket2');

  function setRequiredFields(fields, isRequired) {
    fields.forEach(field => {
      field.required = isRequired;
    });
  }

  EndRadio.addEventListener('change', function() {
    if (this.checked) {
      setRequiredFields(EndFields, true);
      setRequiredFields(dropoffFields, false);
    }
  });

  dropoffRadio.addEventListener('change', function() {
    if (this.checked) {
      setRequiredFields(dropoffFields, true);
      setRequiredFields(EndFields, false);
    }
  });

  // Validate form before submit
  document.querySelector('form').addEventListener('submit', function(e) {
    if (!EndRadio.checked && !dropoffRadio.checked) {
      e.preventDefault();
      alert('Please select either Pick-up or Drop-off option.');
    } else if (EndRadio.checked) {
      if (!validateFields(EndFields)) {
        e.preventDefault();
        alert('Please fill in all required Pick-up fields.');
      }
    } else if (dropoffRadio.checked) {
      if (!validateFields(dropoffFields)) {
        e.preventDefault();
        alert('Please fill in all required Drop-off fields.');
      }
    }
  });

  function validateFields(fields) {
    return Array.from(fields).every(field => field.textContent !== 'Select a Date' && field.textContent !== 'Your City: Select City' && !field.textContent.includes('00:00'));
  }
});

document.getElementById('time-button-paket1').addEventListener('click', function() {
  const dropdown = document.getElementById('time-picker-dropdown-paket1');
  dropdown.classList.toggle('hidden');
  dropdown.classList.toggle('opacity-0');
  dropdown.classList.toggle('scale-95');
});

document.getElementById('hour-select-paket1').addEventListener('change', updateSelectedTime);
document.getElementById('minute-select-paket1').addEventListener('change', updateSelectedTime);

function updateSelectedTime() {
  const hour = document.getElementById('hour-select-paket1').value;
  const minute = document.getElementById('minute-select-paket1').value;
  document.getElementById('time-button-paket1').textContent = `End Time: ${hour}:${minute}`;
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const dateButton = document.getElementById('date-button-paket1');
  const dateDropdown = document.getElementById('date-picker-dropdown-paket1');
  const prevMonthBtn = document.getElementById('prev-month-paket1');
  const nextMonthBtn = document.getElementById('next-month-paket1');
  const monthYearDisplay = document.getElementById('month-year-paket1');
  const calendarGrid = document.getElementById('calendar-grid-paket1');

  let currentDate = new Date();
  let selectedDate = null;

  function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    monthYearDisplay.textContent = `${date.toLocaleString('default', { month: 'long' })} ${year}`;

    // Clear the previous calendar grid
    calendarGrid.innerHTML = '';

    // Get the first day of the month
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    // Create empty slots for days before the first day of the month
    for (let i = 0; i < firstDay; i++) {
      const emptyCell = document.createElement('div');
      calendarGrid.appendChild(emptyCell);
    }

    // Create days of the month
    for (let day = 1; day <= daysInMonth; day++) {
      const dayCell = document.createElement('div');
      dayCell.textContent = day;
      dayCell.classList.add('p-2', 'hover:bg-gray-200', 'cursor-pointer', 'rounded');

      dayCell.addEventListener('click', function() {
        selectedDate = new Date(year, month, day);
        dateButton.textContent = selectedDate.toLocaleDateString();
        toggleDropdown();
      });

      calendarGrid.appendChild(dayCell);
    }
  }

  function toggleDropdown() {
    if (dateDropdown.classList.contains('hidden')) {
      dateDropdown.classList.remove('hidden');
      setTimeout(() => {
        dateDropdown.classList.remove('opacity-0', 'scale-95');
        dateDropdown.classList.add('opacity-100', 'scale-100');
      }, 0);
    } else {
      dateDropdown.classList.add('opacity-0', 'scale-95');
      dateDropdown.classList.remove('opacity-100', 'scale-100');
      setTimeout(() => {
        dateDropdown.classList.add('hidden');
      }, 100);
    }
  }

  dateButton.addEventListener('click', function() {
    toggleDropdown();
    renderCalendar(currentDate);
  });

  prevMonthBtn.addEventListener('click', function() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
  });

  nextMonthBtn.addEventListener('click', function() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
  });

  // Close the date picker if clicked outside
  document.addEventListener('click', function(event) {
    if (!dateButton.contains(event.target) && !dateDropdown.contains(event.target)) {
      if (!dateDropdown.classList.contains('hidden')) {
        toggleDropdown();
      }
    }
  });
});
</script>



</body>
</html>
