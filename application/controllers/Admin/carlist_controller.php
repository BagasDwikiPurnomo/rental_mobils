<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Carlist_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->load->model('Admin/Carlist_model');
    }

    public function index() {
        // Get filter values from query parameters
        $search = $this->input->get('search', TRUE); // TRUE for XSS filtering
        $date = $this->input->get('car-year', TRUE); // Correct query parameter name
        $brand = $this->input->get('brand', TRUE);
        
        // Get the filtered and searched data
        $data['cars'] = $this->Carlist_model->get_filtered_cars($search, $date, $brand);
        
        // Get the distinct brands for the filter dropdown
        $data['brands'] = $this->Carlist_model->get_all_brands();
        $data['search'] = $search;
        $data['date'] = $date;
        $data['selected_brand'] = $brand;
        
        // Load the view with filtered data
        $this->load->view('Admin/carlist_view', $data);
    }
    
    public function delete_car($id) {
        // Cek apakah ID valid dan tidak null
        if ($id === NULL) {
            show_404(); // Tampilkan halaman 404 jika ID tidak ada
        }
    
        // Panggil function delete_car dari model
        $delete_success = $this->Carlist_model->delete_car($id);
    
        if ($delete_success) {
            // Jika penghapusan berhasil, redirect kembali ke halaman daftar mobil
            redirect('admincarlist');
        } else {
            // Jika penghapusan gagal, tampilkan pesan error (atau log error)
            log_message('error', 'Failed to delete car with ID: ' . $id);
            // Anda bisa menambahkan flash message di sini
            redirect('admincarlist');
        }
    }
    

    public function addcar() {
        $this->load->view('Admin/addcar_view');
    }

    private function check_login() {
        if (!$this->session->userdata('role')) {
            redirect('Admin/Admin_controller');
        }
    }

    public function add_car() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->_save_car();
        } else {
            $this->load->view('Admin/add_car');
        }
    }
    
    private function _save_car() {
        $data = array(
            'logo' => $this->_handle_logo_upload(), // Handles both URL and file upload
            'name' => $this->input->post('car-name'),
            'merk' => $this->input->post('car-brand'),
            'date' => $this->input->post('car-year'),
            'engine' => $this->input->post('car-engine'),
            'transmission' => $this->input->post('car-transmission'),
            'drivetrain' => $this->input->post('car-drivetrain'),
            'inter_exter' => $this->input->post('car-interior-exterior'),
            'seats' => $this->input->post('car-seats'),
            'price_rent' => $this->input->post('car-rental-price'),
            'other_photo' => $this->_handle_photos_upload(), // Handle multiple photos
            'overview_introduction' => $this->input->post('car-overview'),
            'primary_feature' => $this->input->post('car-primary-features'),
            'additional_feature' => $this->input->post('car-additional-features'),
            'body_type' => $this->input->post('car-body-type'),
            'fuel_type' => $this->input->post('car-fuel-type'),
            'consumption' => $this->input->post('consumption'),
            'power' => $this->input->post('power')
        );
    
        // Convert newlines to \n for storage
        $data['overview_introduction'] = str_replace(array("\r\n", "\r", "\n"), '\n', $data['overview_introduction']);
        $data['primary_feature'] = str_replace(array("\r\n", "\r", "\n"), '\n', $data['primary_feature']);
        $data['additional_feature'] = str_replace(array("\r\n", "\r", "\n"), '\n', $data['additional_feature']);
    
        if ($this->Carlist_model->add_car($data)) {
            redirect('admincarlist');
        } else {
            echo "Error adding car";
        }
    }
    
    
    private function _handle_logo_upload() {
        // Check if a logo URL is provided
        $logo_url = $this->input->post('car-logo-url');
        if (!empty($logo_url)) {
            return $logo_url; // Use the URL directly
        }
        
        // Handle local file upload if no URL is provided
        if (isset($_FILES['car-logo']) && $_FILES['car-logo']['error'] == UPLOAD_ERR_OK) {
            $tmpName = $_FILES['car-logo']['tmp_name'];
            $response = $this->_upload_to_imgur($tmpName);
            if ($response['success']) {
                return $response['data']['link'];
            } else {
                return ''; // Handle error
            }
        }
        
        return ''; // Return empty if no upload or URL provided
    }
    
    private function _handle_photos_upload() {
        $photo_links = [];
    
        // Handle URLs if provided
        $photo_urls = $this->input->post('car-photos-url');
        log_message('debug', 'Photo URLs (raw): ' . print_r($photo_urls, true)); // Debugging
    
        if (!empty($photo_urls)) {
            if (is_array($photo_urls)) {
                // If it's already an array, use it as is
                $photo_links = $photo_urls;
            } else {
                // If it's a string, split it by newline and/or comma
                $photo_links = preg_split('/[\r\n,]+/', $photo_urls);
            }
            // Filter out empty entries and remove duplicates
            $photo_links = array_values(array_unique(array_filter($photo_links)));
        }
    
        // Handle local file uploads
        if (isset($_FILES['car-photos']) && is_array($_FILES['car-photos']['name'])) {
            foreach ($_FILES['car-photos']['name'] as $key => $value) {
                if ($_FILES['car-photos']['error'][$key] == UPLOAD_ERR_OK) {
                    $tmpName = $_FILES['car-photos']['tmp_name'][$key];
                    $response = $this->_upload_to_imgur($tmpName);
                    if ($response['success']) {
                        $photo_links[] = $response['data']['link'];
                    } else {
                        log_message('error', 'Failed to upload image: ' . $_FILES['car-photos']['name'][$key]);
                    }
                } else {
                    log_message('error', 'Upload error: ' . $_FILES['car-photos']['error'][$key]);
                }
            }
        }
    
        // Convert the photo_links array to a comma-separated string for database storage
        $result = !empty($photo_links) ? implode(',', $photo_links) : '';
        log_message('debug', 'Final result string: ' . $result); // Debugging
        return $result;
    }
    

    private function _upload_to_imgur($tmpName) {
        $client_id = '8b15698e9d81571';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => base64_encode(file_get_contents($tmpName))));

        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);

        if (isset($response_data['success']) && $response_data['success']) {
            return $response_data;
        } else {
            return ['success' => false]; // Return failure
        }
    }
    public function edit_car($id = NULL) {
        if ($id === NULL) {
            show_404(); // Handle missing ID
        }
    
        // Fetch car data by ID
        $data['cars'] = $this->Carlist_model->get_car_by_id($id);
    
        if (empty($data['cars'])) {
            show_404(); // Handle car not found
        }
    
        // Convert the comma-separated string to an array if it is not empty
        $car_photos_string = $data['cars']['other_photo']; // Assuming 'other_photo' is the column storing the URLs
        $data['car_photos'] = !empty($car_photos_string) ? explode(',', $car_photos_string) : [];
    
        // Load the edit view with car data
        $this->load->view('Admin/editcar_view', $data);
    }
    
    
    public function update_car() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $car_id = $this->input->post('car_id'); // Get the car ID
            $this->_update_car($car_id);
        } else {
            show_404();
        }
    }
    
    private function _update_car($car_id) {
        // Get the existing car data
        $existing_car = $this->Carlist_model->get_car_by_id($car_id);
        
        // Check if existing car data was retrieved successfully
        if (empty($existing_car)) {
            log_message('error', 'Car not found for ID: ' . $car_id);
            show_404();
            return;
        }
        
        // Collect form data
        $data = [
            'name' => $this->input->post('car-name'),
            'merk' => $this->input->post('car-brand'),
            'date' => $this->input->post('car-year'),
            'engine' => $this->input->post('car-engine'),
            'transmission' => $this->input->post('car-transmission'),
            'drivetrain' => $this->input->post('car-drivetrain'),
            'inter_exter' => $this->input->post('car-interior-exterior'),
            'seats' => $this->input->post('car-seats'),
            'price_rent' => $this->input->post('car-rental-price'),
            'overview_introduction' => $this->input->post('car-overview'),
            'primary_feature' => $this->input->post('car-primary-features'),
            'additional_feature' => $this->input->post('car-additional-features'),
            'body_type' => $this->input->post('car-body-type'),
            'fuel_type' => $this->input->post('car-fuel-type'),
            'consumption' => $this->input->post('consumption'),
            'power' => $this->input->post('power')
        ];
        
        // Handle the logo (file upload or URL)
        $logo_url = $this->input->post('car-logo-url');
        if (!empty($logo_url)) {
            // Use the provided URL
            $data['logo'] = $logo_url;
        } elseif (!empty($_FILES['car-logo']['name'])) {
            // Handle file upload
            $tmpName = $_FILES['car-logo']['tmp_name'];
            log_message('info', 'Uploading logo: ' . $_FILES['car-logo']['name']);
            $response = $this->_upload_to_imgur($tmpName);
            if ($response['success']) {
                $data['logo'] = $response['data']['link'];
            } else {
                $error = $response['data']['error'];
                log_message('error', 'Imgur upload error for logo: ' . $error);
                // Optionally, set a flash message to notify the user
            }
        } else {
            // Keep existing logo if no new file or URL is provided
            $data['logo'] = $existing_car['logo'];
        }
        // Handle additional photos
        $photo_links = [];
        
        // Handle URLs if provided
        $photo_urls = $this->input->post('car-photos-url');
        log_message('debug', 'Photo URLs (raw): ' . print_r($photo_urls, true)); // Debugging
    
        if (!empty($photo_urls) && is_array($photo_urls)) {
            $photo_links = array_values(array_unique(array_filter($photo_urls)));
        } elseif (!empty($photo_urls)) {
            // If it's a string, split it by newline and/or comma
            $photo_links = preg_split('/[\r\n,]+/', $photo_urls);
            $photo_links = array_values(array_unique(array_filter($photo_links)));
        }
    
        // Handle local file uploads
        if (isset($_FILES['car-photos']) && is_array($_FILES['car-photos']['name'])) {
            foreach ($_FILES['car-photos']['name'] as $key => $value) {
                if ($_FILES['car-photos']['error'][$key] == UPLOAD_ERR_OK) {
                    $tmpName = $_FILES['car-photos']['tmp_name'][$key];
                    $response = $this->_upload_to_imgur($tmpName);
                    if ($response['success']) {
                        $photo_links[] = $response['data']['link'];
                    } else {
                        $error = $response['data']['error'];
                        log_message('error', 'Imgur upload error for additional photo: ' . $error);
                    }
                } else {
                    log_message('error', 'Upload error: ' . $_FILES['car-photos']['error'][$key]);
                }
            }
        }
        
        // Replace the car's other photos with new photos
        if (!empty($photo_links)) {
            $data['other_photo'] = implode(',', $photo_links);
        } else {
            // Keep existing photos if no new files or URLs are provided
            $data['other_photo'] = $existing_car['other_photo'];
        }
        
        // Update the car record
        $update_success = $this->Carlist_model->update_car($car_id, $data);
        
        if ($update_success) {
            // Log success
            log_message('info', 'Car updated successfully: ' . $car_id);
            redirect('admincarlist');
        } else {
            // Log failure
            log_message('error', 'Failed to update car: ' . $car_id);
            // Optionally, set a flash message to notify the user
        }
    }
    
    


}
?>
