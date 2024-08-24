<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class Rent_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->load->model('Admin/rent_model');
        $this->load->database();
    }
    
    public function index()
    {
        $data['search'] = $this->input->get('search');
        $data['start_date'] = $this->input->get('start_date');
        $data['end_date'] = $this->input->get('end_date');
        
        $data['car_names'] = $this->rent_model->get_car_names();
        $data['rentals'] = $this->rent_model->get_filtered_rentals($data['search'], $data['start_date'], $data['end_date']);
        
        $this->load->view('Admin/rent_view', $data);
    }
    
    private function check_login() {
        if (!$this->session->userdata('role')) {
            redirect('Admin/Admin_controller');
        }
    }

    public function export_to_excel() {
        // Load rentals data using the model method
        $search = $this->input->get('search');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $rentals = $this->rent_model->get_filtered_rentals($search, $start_date, $end_date);

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set spreadsheet headers
        $headers = ['ID', 'Username', 'Car Name', 'Start Date', 'End Date', 'Total Price'];
        $columnLetters = ['A', 'B', 'C', 'D', 'E', 'F'];

        foreach ($headers as $index => $header) {
            $cell = $columnLetters[$index] . '1';
            $sheet->setCellValue($cell, $header);
            $sheet->getStyle($cell)->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['argb' => 'FFFFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '00000000']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);
        }

        // Populate spreadsheet with data
        $row = 2;
        foreach ($rentals as $rental) {
            $sheet->setCellValue('A' . $row, $rental['id']);
            $sheet->setCellValue('B' . $row, $rental['username']);
            $sheet->setCellValue('C' . $row, $rental['car_name']);
            $sheet->setCellValue('D' . $row, date('d M Y', strtotime($rental['start_date'])));
            $sheet->setCellValue('E' . $row, date('d M Y', strtotime($rental['end_date'])));
            $sheet->setCellValue('F' . $row, 'Rp ' . number_format($rental['total_price'], 0, ',', '.'));
            $row++;
        }

        // Apply general styling to all cells
        $sheet->getStyle('A1:F' . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        // Auto size columns
        foreach ($columnLetters as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create a writer and output the file
        $writer = new Xlsx($spreadsheet);
        $filename = 'Rental_Report_' . date('YmdHis') . '.xlsx';

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function delete($id) {
        // Check if the ID is valid
        if (!is_numeric($id)) {
            show_404();
        }

        // Delete the rental record
        if ($this->rent_model->delete_rental($id)) {
            // Redirect to the index page or show a success message
            $this->session->set_flashdata('success', 'Rental record deleted successfully.');
        } else {
            // Redirect to the index page or show an error message
            $this->session->set_flashdata('error', 'Failed to delete the rental record.');
        }

        redirect('rent');
    }
}
