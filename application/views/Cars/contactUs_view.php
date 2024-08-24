<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> 

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>">
  <title>Contact Us</title>
    <link rel="icon" href="<?php echo base_url('assets/images/recars.svg'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <link rel="icon" href="<?php echo base_url('assets/images/recars.svg'); ?>" type="image/x-icon">
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
              office_color: '#454F53',
              call_color: '#6E828A',
              grey_white: '#F2F2F2',
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

      // Function to handle scrolling to the notification
      function scrollToNotification() {
          const urlParams = new URLSearchParams(window.location.search);
          if (urlParams.get('scroll') === 'notification') {
              const notification = document.getElementById('notification');
              if (notification) {
                  notification.scrollIntoView({ behavior: 'smooth' });
              }
          }
      }

      window.onload = scrollToNotification;
  </script>
</head>
<body>
  <div class="overflow-hidden">
    <!-- NAVBAR -->
    <div class="fixed top-0 bg-white bg-opacity-60 backdrop-blur-sm pt-3 pb-3 z-50 w-full">
      <?php $this->load->view('Navbar/Navigation'); ?>
    </div>

    <div class="flex justify-center mt-40 items-center text-center mb-10">
      <div class="loading-overlay" id="loading-overlay" style="display: none;"></div>

      <div>
        <div class="flex flex-col">
          <div>
            <p class="text-6xl font-extrabold font-['Inter']">Contact Us</p>
          </div>

          <div>
            <p class="text-black  text-xl font-normal font-['Inter']">Our customer services team is always happy to answer any questions</p>
          </div>
        </div>
      </div>
    </div>

    <div class="mb-20 flex justify-center items-center w-full">
      <img src="<?php echo base_url('assets/images/contactUs Map.svg'); ?>" class="w-full">
    </div>

    <!-- CONTACT DETAILS -->
    <div class="flex justify-center mb-20">
      <div>
        <div class="flex flex-col">
          <div class="pb-10">
            <p class="text-black text-3xl font-bold font-['Inter']">Contact Details</p>
          </div>

          <div>
            <div class="flex flex-row space-x-6">
              <div>
                <div class="bg-office_color w-[429px] h-[278px] rounded-2xl">
                  <div class="flex flex-col pt-8 space-y-2 pl-8">
                    <div class="pb-2">
                      <p class="text-white text-3xl font-bold font-['Inter']">Recars office</p>
                    </div>
                    <div>
                      <p class="text-white text-lg font-normal font-['Inter']">TowerPamulang 41</p>
                    </div>
                    <div>
                      <p class="text-white text-lg font-normal font-['Inter']">Pamulang</p>
                    </div>
                    <div>
                      <p class="text-white text-lg font-normal font-['Inter']">56379</p>
                    </div>
                    <div>
                      <p class="text-white text-lg font-normal font-['Inter']">Jakarta Selatan, Indonesia</p>
                    </div>
                  </div>
                </div>
              </div>

              <div>
                <div class="flex flex-col space-y-10">
                  <div>
                    <div class="bg-call_color w-[311px] h-[118px] rounded-lg">
                      <div class="flex flex-col pt-8 pl-6">
                        <div>
                          <p class="text-white text-lg font-semibold font-['Inter']">+62 (415) 555-0132</p>
                        </div>
                        <div>
                          <p class="text-white text-sm font-normal font-['Inter']">Call us</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="bg-call_color w-[311px] h-[118px] rounded-lg" id="notification">
                    <div class="flex flex-col pt-8 pl-6">
                      <div>
                        <p class="text-white text-lg font-semibold font-['Inter']">recars@gmail.com</p>
                      </div>
                      <div>
                        <p class="text-white text-sm font-normal font-['Inter']">Send your email</p>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-center -ml-2 mb-20">
      <div>
        <!-- Notification Messages -->
        <div  class="mb-10">
          <?php if($this->session->flashdata('error')): ?>
            <div class="bg-red-100 text-red-700 p-4 rounded-lg">
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <?php if($this->session->flashdata('success')): ?>
            <div class="bg-green-100 text-green-700 p-4 rounded-lg">
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="flex flex-col space-y-6 mt-10">
          <div>
            <p class="text-black text-3xl font-bold font-['Inter']">Send your message</p>
          </div>

          <div>
            <form action="<?php echo base_url('contactus/send_message'); ?>" method="post">
              <input type="text" name="name" class="border bg-grey_white border-transparent rounded-lg w-[760px] h-[70px] pl-4 placeholder-gray-400 placeholder-opacity-100 font-semibold
              focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-transparent" placeholder="Full name" required>
            </div>

            <div>
              <input type="email" name="email" class="border bg-grey_white border-transparent rounded-lg w-[760px] h-[70px] pl-4 placeholder-gray-400 placeholder-opacity-100 font-semibold
              focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-transparent" placeholder="Email" required>
            </div>

            <div>
              <textarea 
                name="message" 
                class="border bg-grey_white border-transparent rounded-lg w-[760px] h-[150px] pl-4 pt-3 pb-3 placeholder-gray-400 placeholder-opacity-100 font-semibold
                focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-transparent resize-none" 
                placeholder="Tell us more" 
                required
              ></textarea>
            </div>

            <div>
              <button type="submit" class="bg-black_button hover:bg-gray-200 w-[760px] h-[70px] text-white text-xl hover:text-gray-900 p-3 rounded-xl">
                Send Message
              </button>
            </div>
          </form>
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
  </script>
</body>
</html>
