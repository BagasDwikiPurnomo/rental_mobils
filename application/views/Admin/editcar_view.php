<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>">
    <title>Edit Data Car</title>
    <link rel="icon" href="<?php echo base_url('assets/images/recars.svg'); ?>" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        .preview-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 1rem;
            background-color: #f6f7f9;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            overflow-x: hidden;
        }

        #photos-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 1rem;
        }

        #photos-preview img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        
    </style>

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

        document.querySelector('form').addEventListener('submit', function() {
            // Show the loading overlay
            document.getElementById('loading-overlay').style.display = 'block';
        });
    </script>
</head>
<body class="bg-lightblue flex items-start justify-center min-h-screen">
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loading-overlay" style="display: none;"></div>

    <?php $this->load->view('Admin/sidebar_view'); ?>

    <div class="flex ml-64 p-4 gap-6">
        <!-- Form Section -->
        <div class="w-[40rem]">
            <div class="p-6 bg-white rounded-3xl shadow-lg">
                <img class="w-[100px] h-[100px] mb-12 rounded-[10px]" src="<?php echo base_url('assets/images/Admin/recarsadmin.svg'); ?>" />
                <div class="flex items-center text-center">
                <h1 class=" text-4xl font-bold mb-6 text-black">Edit Car Data</h1>
                <a href="#" id="preview-link" class="ml-60 mt-2 text-center flex text-gray-400 items-center text-base font-sm font-inter mb-6 text-black">Preview Page ></a></div>

                <form method="POST" action="<?php echo base_url('updatecar'); ?>" enctype="multipart/form-data">
                <?php echo form_open('add_car', ['class' => 'space-y-6']); ?>
                <input type="hidden" name="car_id" value="<?php echo $cars['car_id']; ?>">

                <!-- Logo Mobil -->
                <div class="p-5 space-y-4">
                        <div class="flex items-center space-x-4">
                            <p class="font-semibold text-base font-['inter']">Logo Mobil</p>
                            
                            <label class="block">
                                <span class="sr-only">Choose image source</span>
                                <select id="logo-source" name="logo-source" class="block text-sm text-slate-500 p-2 rounded-lg bg-[#f6f7f9] border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all duration-300">
                                    <option value="local" selected>Upload Local Image</option>
                                    <option value="url">Enter Image URL</option>
                                </select>
                            </label>
                            
                        </div>
                           <!-- Display existing logo if available -->
                    <?php if (!empty($cars['logo'])): ?>
                        <div class="mb-3">
                        <img src="<?php echo $cars['logo']; ?>" alt="Current Logo" class="w-32 h-auto rounded-[10px]">
                        </div>
                    <?php endif; ?>

                        <!-- Local Image Upload -->
                        <div id="local-logo-container" class="transition-opacity duration-500 ease-in-out">
                            <input type="file" id="car-logo" accept=".jpg,.jpeg,.png" name="car-logo" class="block w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-gray-50 file:text-black-700
                                hover:file:bg-gray-100" />
                        </div>

                        <!-- URL Input -->
                        <div id="url-logo-container" class="hidden transition-opacity duration-500 ease-in-out">
                            <input type="text" id="car-logo-url" name="car-logo-url" class="block w-full text-sm text-slate-500 p-2 rounded-lg bg-[#f6f7f9] border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all duration-300" placeholder="Enter logo URL" />
                        </div>
                    </div>



                    <!-- Form Fields -->
                    <div class="grid grid-cols-1 gap-6">
                        <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Nama Mobil</p>
                            <input type="text" id="car-name" name="car-name" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="Input Nama Mobil" value="<?php echo set_value('car-brand', $cars['name']); ?>">
                        </div>

                       <!-- Car Brand -->
                       <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Merk Mobil</p>
                            <select id="car-brand" name="car-brand" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">
                                <option value="" hidden>Select Brand</option>
                                <option value="BMW" <?php echo set_select('car-brand', 'BMW', isset($cars['merk']) && $cars['merk'] == 'BMW'); ?>>BMW</option>
                                <option value="Mercedes" <?php echo set_select('car-brand', 'Mercedes', isset($cars['merk']) && $cars['merk'] == 'Mercedes'); ?>>Mercedes</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <!-- Car Year -->
                        <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Tahun Mobil</p>
                            <select id="car-year" name="car-year" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">
                                <option value="" disabled <?php echo !isset($cars['year']) ? 'selected' : ''; ?>>Pilih Tahun</option>
                                <?php
                                // PHP code to generate a range of years
                                $currentYear = date('Y');
                                $startYear = $currentYear - 20; // Adjust the range as needed
                                $endYear = $currentYear;
                                
                                for ($year = $startYear; $year <= $endYear; $year++) {
                                    echo "<option value=\"$year\" " . (isset($cars['date']) && $cars['date'] == $year ? 'selected' : '') . ">$year</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Engine Mobil</p>
                            <input type="text" id="car-engine" name="car-engine" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="Input Engine Mobil" value="<?php echo set_value('car-engine', $cars['engine']); ?>">
                        </div>

                        <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Transmission</p>
                            <select id="car-transmission" name="car-transmission" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">
                                <option value="" hidden>Select Transmission</option>
                                <option value="Manual" <?php echo set_select('car-transmission', 'Manual', isset($cars['transmission']) && $cars['transmission'] == 'Manual'); ?>>Manual</option>
                                <option value="Automatic" <?php echo set_select('car-transmission', 'Automatic', isset($cars['transmission']) && $cars['transmission'] == 'Automatic'); ?>>Automatic</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>


                        <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Drivetrain</p>
                            <select id="car-drivetrain" name="car-drivetrain" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">
                                <option value="" hidden>Select Drivetrain</option>
                                <option value="FWD" <?php echo set_select('car-drivetrain', 'FWD', isset($cars['drivetrain']) && $cars['drivetrain'] == 'FWD'); ?>>Front-Wheel Drive (FWD)</option>
                                <option value="RWD" <?php echo set_select('car-drivetrain', 'RWD', isset($cars['drivetrain']) && $cars['drivetrain'] == 'RWD'); ?>>Rear-Wheel Drive (RWD)</option>
                                <option value="AWD" <?php echo set_select('car-drivetrain', 'AWD', isset($cars['drivetrain']) && $cars['drivetrain'] == 'AWD'); ?>>All-Wheel Drive (AWD)</option>
                                <option value="4WD" <?php echo set_select('car-drivetrain', '4WD', isset($cars['drivetrain']) && $cars['drivetrain'] == '4WD'); ?>>Four-Wheel Drive (4WD)</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>


                        <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Interior and Exterior</p>
                            <input type="text" id="car-interior-exterior" name="car-interior-exterior" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="Input Interior and Exterior" value="<?php echo set_value('car-interior-exterior', $cars['inter_exter']); ?>">
                        </div>

                        <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Seats</p>
                            <input type="number" id="car-seats" name="car-seats" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="Input Seats" value="<?php echo set_value('car-seats', $cars['seats']); ?>">
                        </div>

                        <div class="p-5 space-y-2">
                        <p class="font-semibold text-base font-['inter']">Harga Sewa</p>
                        <input type="number" id="car-rental-price" name="car-rental-price" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="Input Harga Sewa" min="0" value="<?php echo set_value('car-price', $cars['price_rent']); ?>">
                        </div>

                        <!-- Form Fields for Other Photos -->
                        <div class="p-5 space-y-4">
                        <div class="flex items-center space-x-4">
                            <p class="font-semibold text-base font-['inter']">Other Photos</p>
                            <label class="block">
                                <span class="sr-only">Choose image source</span>
                                <select id="photos-source" name="photos-source" class="block text-sm text-slate-500 p-2 rounded-lg bg-[#f6f7f9] border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all duration-300">
                                    <option value="local" selected>Upload Local Images</option>
                                    <option value="url">Enter Image URLs</option>
                                </select>
                            </label>
                        </div>

                        <!-- Local Image Upload -->
                        <div id="local-photos-container" class="transition-opacity duration-500 ease-in-out">
                            <input type="file" multiple id="car-photos" name="car-photos[]" accept=".jpg,.jpeg,.png" class="block w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-gray-50 file:text-black-700
                                hover:file:bg-gray-100" />
                        </div>

                        <!-- URL Input -->
                        <div id="url-photos-container" class="hidden transition-opacity duration-500 ease-in-out">
                        <textarea id="car-photos-urls" name="car-photos-url[]" rows="4" 
                        class="block w-full text-sm text-slate-500 p-2 rounded-lg bg-[#f6f7f9] border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all duration-300" 
                        placeholder="Enter image URLs, one per line"
                        onblur="formatUrls(this)"></textarea></div>

                        <!-- Warning Message -->
                        <div id="url-warning" class="hidden mt-4 text-sm text-red-600 text-justify">
                            <p>Please note that long URLs may cause issues. <br>consider shortening your URLs, please using <br><a href="https://t.ly/image/url-shortener" target="_blank" class="underline">this URL shortener service</a>.</p>
                        </div>
                        
                    </div>
                   
                    <!-- Preview Section for Selected Photos -->
                    <div id="photo-previews" class="p-5 space-y-2">
                        <p class="font-semibold text-base font-['inter']">Current Photos</p>
                        <div id="preview-container" class="w-[35rem] grid grid-cols-3 gap-4">
                            <?php if (!empty($car_photos)): ?>
                                <?php foreach ($car_photos as $photo): ?>
                                    <div class="relative w-full h-[150px]">
                                        <img src="<?php echo $photo; ?>" alt="Car Photo" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No photos available</p>
                            <?php endif; ?>
                        </div>
                    </div>


                        <div class="p-5 space-y-2 col-span-2">
                            <p class="font-semibold text-base font-['inter']">Overview and Introduction</p>
                            <textarea id="car-overview" name="car-overview" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none" rows="4" placeholder="Input Overview and Introduction"><?php echo set_value('car-overview', $cars['overview_introduction']); ?>
                            </textarea>
                        </div>
                        
                        <div class="p-5 space-y-2 col-span-2">
                            <p class="font-semibold text-base font-['inter']">Primary Features</p>
                            <textarea id="car-primary-features" name="car-primary-features" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none" rows="4" placeholder="Input Primary Features"><?php echo set_value('car-primary-features', $cars['primary_feature']); ?>
                            </textarea>
                        </div>

                        <div class="p-5 space-y-2 col-span-2">
                            <p class="font-semibold text-base font-['inter']">Additional Features</p>
                            <textarea id="car-additional-features" name="car-additional-features" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none" rows="4" placeholder="Input Additional Features"><?php echo set_value('car-additional-features', $cars['additional_feature']); ?></textarea>
                        </div>

                        <!-- Body Type -->
                        <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Body Type</p>
                            <select id="car-body-type" name="car-body-type" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">
                                <option value="" hidden>Select Body Type</option>
                                <option value="Sedan" <?php echo set_select('car-body-type', 'Sedan', isset($cars['body_type']) && $cars['body_type'] == 'Sedan'); ?>>Sedan</option>
                                <option value="SUV" <?php echo set_select('car-body-type', 'SUV', isset($cars['body_type']) && $cars['body_type'] == 'SUV'); ?>>SUV</option>
                                <option value="Hatchback" <?php echo set_select('car-body-type', 'Hatchback', isset($cars['body_type']) && $cars['body_type'] == 'Hatchback'); ?>>Hatchback</option>
                                <option value="Coupe" <?php echo set_select('car-body-type', 'Coupe', isset($cars['body_type']) && $cars['body_type'] == 'Coupe'); ?>>Coupe</option>
                                <option value="Convertible" <?php echo set_select('car-body-type', 'Convertible', isset($cars['body_type']) && $cars['body_type'] == 'Convertible'); ?>>Convertible</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <!-- Fuel Type -->
                        <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Fuel Type</p>
                            <select id="car-fuel-type" name="car-fuel-type" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none">
                                <option value="" hidden>Select Fuel Type</option>
                                <option value="Petrol" <?php echo set_select('car-fuel-type', 'Petrol', isset($cars['fuel_type']) && $cars['fuel_type'] == 'Petrol'); ?>>Petrol</option>
                                <option value="Diesel" <?php echo set_select('car-fuel-type', 'Diesel', isset($cars['fuel_type']) && $cars['fuel_type'] == 'Diesel'); ?>>Diesel</option>
                                <option value="Electric" <?php echo set_select('car-fuel-type', 'Electric', isset($cars['fuel_type']) && $cars['fuel_type'] == 'Electric'); ?>>Electric</option>
                                <option value="Hybrid" <?php echo set_select('car-fuel-type', 'Hybrid', isset($cars['fuel_type']) && $cars['fuel_type'] == 'Hybrid'); ?>>Hybrid</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>


                        <!-- Consumption -->
                        <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Consumption</p>
                            <input type="number" name="consumption" id="consumption" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="Input Consumption" step="0.1" min="0" value="<?php echo set_value('consumption', isset($cars['consumption']) ? $cars['consumption'] : ''); ?>">
                            </div>


                        <div class="p-5 space-y-2">
                            <p class="font-semibold text-base font-['inter']">Power</p>
                            <input type="number" id="power" name="power" required class="rounded-lg p-4 w-full text-black text-sm bg-[#f6f7f9] focus:ring-2 focus:ring-gray-300 focus:outline-none" placeholder="Input Power" value="<?php echo set_value('power', $cars['power']); ?>">
                        </div>

                    </div>
                    
                    <!-- Submit Button -->
                    <div class="text-center mt-8">
                        <button type="submit" class="bg-black text-white w-full h-10 px-4 py-2 rounded-lg shadow-md hover:bg-gray-700">Update Car</button>
                    </div>
                    <?php echo form_close(); ?>
                </form>
            </div>
        </div>

        <!-- Preview Section -->
        <div class="w-[30rem] ml-auto preview-container bg-white overflow-auto" style="max-height: calc(100vh - 2rem); position: sticky; top: 1rem;">
            <h2 class="text-2xl font-bold mb-4">Car Preview</h2>
            <div id="car-preview">
                <div id="preview-logo" class="mb-4">
                    <img src="<?php echo htmlspecialchars($cars['logo']); ?>" alt="Car Logo" id="preview-logo-img" class="w-[150px] h-[150px] object-cover rounded-lg">
                </div>
                <div id="preview-details">
                    <h3 class="text-xl font-semibold mb-2" id="preview-car-name"></h3>
                    <p class="mb-2"><strong>Brand:</strong> <span id="preview-car-brand"></span></p>
                    <p class="mb-2"><strong>Year:</strong> <span id="preview-car-year"></span></p>
                    <p class="mb-2"><strong>Engine:</strong> <span id="preview-car-engine"></span></p>
                    <p class="mb-2"><strong>Transmission:</strong> <span id="preview-car-transmission"></span></p>
                    <p class="mb-2"><strong>Drivetrain:</strong> <span id="preview-car-drivetrain"></span></p>
                    <p class="mb-2"><strong>Interior and Exterior:</strong> <span id="preview-car-interior-exterior"></span></p>
                    <p class="mb-2"><strong>Seats:</strong> <span id="preview-car-seats"></span></p>
                    <p class="mb-2"><strong>Rental Price:</strong> <span id="preview-car-rental-price"></span></p>
                    <p class="mb-2"><strong>Overview:</strong> <span id="preview-car-overview"></span></p>
                    <p class="mb-2"><strong>Primary Features:</strong> <span id="preview-car-primary-features"></span></p>
                    <p class="mb-2"><strong>Additional Features:</strong> <span id="preview-car-additional-features"></span></p>
                    <p class="mb-2"><strong>Body Type:</strong> <span id="preview-car-body-type"></span></p>
                    <p class="mb-2"><strong>Fuel Type:</strong> <span id="preview-car-fuel-type"></span></p>
                    <p class="mb-2"><strong>Consumption:</strong> <span id="preview-consumption"></span></p>
                    <p class="mb-2"><strong>Power:</strong> <span id="preview-power"></span></p>
                    <div class="p-5 space-y-2" id="photos-preview-container">
                        <p class="font-semibold text-base font-['inter']">Photos Preview</p>
                        <div id="photos-preview" class="flex flex-wrap gap-4"></div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>

    <script>
     function formatUrls(textarea) {
    // Split the input by newlines
    let urls = textarea.value.split('\n');
    
    // Filter out empty lines and trim each URL
    urls = urls.map(url => url.trim()).filter(url => url !== '');
    
    // Remove any extra commas
    urls = urls.map(url => url.replace(/,+$/, ''));
    
    // Join the URLs with a single comma and newline
    let formattedUrls = urls.join(',\n');
    
    // Set the formatted value back to the textarea
    textarea.value = formattedUrls;
}


document.getElementById('photos-source').addEventListener('change', function() {
    const localContainer = document.getElementById('local-photos-container');
    const urlContainer = document.getElementById('url-photos-container');
    const warningMessage = document.getElementById('url-warning');

    if (this.value === 'url') {
        localContainer.classList.add('hidden');
        urlContainer.classList.remove('hidden');
        warningMessage.classList.remove('hidden');
    } else {
        localContainer.classList.remove('hidden');
        urlContainer.classList.add('hidden');
        warningMessage.classList.add('hidden');
    }
});

document.getElementById('logo-source').addEventListener('change', function() {
    var value = this.value;
    
    // Clear previous values
    if (value === 'local') {
        // Clear URL input and show local file input
        document.getElementById('car-logo-url').value = '';
        document.getElementById('local-logo-container').classList.remove('hidden');
        document.getElementById('url-logo-container').classList.add('hidden');
    } else if (value === 'url') {
        // Clear file input and show URL input
        document.getElementById('car-logo').value = '';
        document.getElementById('url-logo-container').classList.remove('hidden');
        document.getElementById('local-logo-container').classList.add('hidden');
    }
});
      // Attach event listeners to all relevant form elements
      document.querySelectorAll('input, textarea, select').forEach(element => {
    element.addEventListener('input', updatePreview);
});

document.getElementById('car-logo').addEventListener('change', updatePreview);
document.getElementById('car-photos').addEventListener('change', handleFiles);

document.addEventListener('DOMContentLoaded', function() {
    const carId = document.querySelector('input[name="car_id"]').value;
    const previewLink = document.getElementById('preview-link');

    // Set the href attribute
    previewLink.href = `<?php echo base_url('Cars/detailCars_controller/details/'); ?>${carId}`;
    
    // Set the target attribute to open in a new tab
    previewLink.target = '_blank';
});

let selectedFiles = [];

function handleFiles(event) {
    const files = Array.from(event.target.files);
    selectedFiles = [...selectedFiles, ...files];
    updatePreview();
}

function updatePreview() {
    const logoInput = document.getElementById('car-logo');
    const logoUrlInput = document.getElementById('car-logo-url');
    const logoFile = logoInput.files[0];
    const logoUrl = logoUrlInput.value.trim();

    // Update logo preview
    if (logoUrl) {
        document.getElementById('preview-logo-img').src = logoUrl;
    } else if (logoFile) {
        document.getElementById('preview-logo-img').src = URL.createObjectURL(logoFile);
    } else {
        document.getElementById('preview-logo-img').src = '';
    }

    // Handle other photos preview
    const photosInput = document.getElementById('car-photos');
    const photoUrlsInput = document.getElementById('car-photos-urls');
    const photoFiles = photosInput.files;
    const photoUrls = photoUrlsInput.value.trim().split(/[\n,]+/).filter(url => url.trim() !== '');

    const previewContainer = document.getElementById('photos-preview');
    previewContainer.innerHTML = '';

    // // Add hint if local images are selected
    // if (photoFiles.length > 0) {
    //     const hint = document.createElement('p');
    //     // hint.textContent = "If you want to replace an image, please re-input the image.";
    //     // hint.classList.add('text-red-500', 'text-sm', 'mb-2');
    //     previewContainer.appendChild(hint);
    // }

    // Preview local image files
    for (let i = 0; i < photoFiles.length; i++) {
        const file = photoFiles[i];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const imgSrc = e.target.result;
                const existingImg = previewContainer.querySelector(`img[src="${imgSrc}"]`);
                if (!existingImg) {
                    const div = document.createElement('div');
                    div.classList.add('relative', 'w-32', 'h-32', 'overflow-hidden', 'rounded-lg');

                    const imgElement = document.createElement('img');
                    imgElement.src = imgSrc;
                    imgElement.classList.add('w-full', 'h-full', 'object-cover');

                    const closeButton = document.createElement('button');
                    closeButton.classList.add('w-8', 'absolute', 'top-1', 'right-1', 'bg-white', 'text-black', 'rounded-full', 'p-1', 'hover:bg-gray-300');
                    closeButton.innerHTML = '&times;';
                    closeButton.addEventListener('click', () => {
                        const newFiles = Array.from(photoFiles).filter((_, idx) => idx !== i);
                        const dataTransfer = new DataTransfer();
                        newFiles.forEach(file => dataTransfer.items.add(file));
                        photosInput.files = dataTransfer.files;
                        updatePreview();
                    });

                    div.appendChild(imgElement);
                    div.appendChild(closeButton);
                    previewContainer.appendChild(div);
                }
            };
            reader.readAsDataURL(file);
        }
    }

    // Preview image URLs
    photoUrls.forEach((url, index) => {
    if (url) {
        const div = document.createElement('div');
        div.classList.add('relative', 'w-32', 'h-32', 'overflow-hidden', 'rounded-lg');

        const imgElement = document.createElement('img');
        imgElement.src = url.trim();  // Trim URL untuk menghapus spasi yang tidak diinginkan
        imgElement.classList.add('w-full', 'h-full', 'object-cover');

        const closeButton = document.createElement('button');
        closeButton.classList.add('w-8', 'absolute', 'top-1', 'right-1', 'bg-white', 'text-black', 'rounded-full', 'p-1', 'hover:bg-gray-300');
        closeButton.innerHTML = '&times;';
        closeButton.addEventListener('click', () => {
            photoUrls.splice(index, 1);
            photoUrlsInput.value = photoUrls.join(',\n');  // Gabungkan kembali dengan koma dan baris baru
            updatePreview();
        });

        div.appendChild(imgElement);
        div.appendChild(closeButton);
        previewContainer.appendChild(div);
    }
});

    // Update car details preview
    document.getElementById('preview-car-name').textContent = document.getElementById('car-name').value;
    document.getElementById('preview-car-brand').textContent = document.getElementById('car-brand').value;
    document.getElementById('preview-car-year').textContent = document.getElementById('car-year').value;
    document.getElementById('preview-car-engine').textContent = document.getElementById('car-engine').value;
    document.getElementById('preview-car-transmission').textContent = document.getElementById('car-transmission').value;
    document.getElementById('preview-car-drivetrain').textContent = document.getElementById('car-drivetrain').value;
    document.getElementById('preview-car-interior-exterior').textContent = document.getElementById('car-interior-exterior').value;
    document.getElementById('preview-car-seats').textContent = document.getElementById('car-seats').value;
    document.getElementById('preview-car-rental-price').textContent = document.getElementById('car-rental-price').value ? `Rp. ${Number(document.getElementById('car-rental-price').value).toLocaleString('id-ID')}` : '';
    document.getElementById('preview-car-overview').innerHTML = document.getElementById('car-overview').value.replace(/\n/g, '<br>');
    document.getElementById('preview-car-primary-features').innerHTML = document.getElementById('car-primary-features').value.replace(/\n/g, '<br>');
    document.getElementById('preview-car-additional-features').innerHTML = document.getElementById('car-additional-features').value.replace(/\n/g, '<br>');
    document.getElementById('preview-car-body-type').textContent = document.getElementById('car-body-type').value;
    document.getElementById('preview-car-fuel-type').textContent = document.getElementById('car-fuel-type').value;
    document.getElementById('preview-consumption').textContent = document.getElementById('consumption').value ? `${Number(document.getElementById('consumption').value).toFixed(1)} liters/100 km` : '';
    document.getElementById('preview-power').textContent = document.getElementById('power').value ? `${document.getElementById('power').value} hp` : '';
}

// Add event listeners for logo and photos
document.getElementById('car-logo').addEventListener('change', updatePreview);
document.getElementById('car-logo-url').addEventListener('input', updatePreview);
document.getElementById('car-photos').addEventListener('change', updatePreview);
document.getElementById('car-photos-urls').addEventListener('input', updatePreview);

// Update preview on page load
document.addEventListener('DOMContentLoaded', updatePreview);

// Cleanup object URLs on page unload
window.addEventListener('beforeunload', () => {
    document.querySelectorAll('input[type="file"]').forEach(input => {
        URL.revokeObjectURL(input.files[0]?.previewURL);
    });
});


    </script>
</body>
</html>