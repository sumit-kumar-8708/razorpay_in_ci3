<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Razorpay extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('razorpaylibrary');
        $this->load->model('payment_model');
        $this->load->library('session'); // Load the session library
    }

    public function index()
    {
        $data['order'] = $this->razorpaylibrary->create_order(800, 'order_rcptid_11'); // Sample amount and receipt ID
        // echo '<pre>';
        // print_r($data['order']); die;
        // $this->load->view('razorpay/razorpay_view', $data);
    }

    public function verify()
    {
        $payment_id = $this->input->post('razorpay_payment_id');
        $order_id = $this->input->post('razorpay_order_id');
        $signature = $this->input->post('razorpay_signature');

        $payment = $this->razorpaylibrary->fetch_payment($payment_id);

        $payment_data = [
            'order_id' => $order_id,
            'payment_id' => $payment_id,
            'signature' => $signature,
            'amount' => $payment->amount / 100,
            'status' => $payment->status
        ];

        if ($payment->status == 'captured') {
            $this->payment_model->insert_payment($payment_data);

            // Fetch payment details to show on the success page
            $data['payment_details'] = $this->payment_model->get_payment_details($payment_id);
            $this->session->set_flashdata('success', 'Payment successful');
            $this->load->view('razorpay/success_view', $data); // Load success view with payment details
        } else {
            // Insert payment data even if the status is not captured
            $this->payment_model->insert_payment($payment_data);
            $this->session->set_flashdata('error', 'Payment failed');
            redirect('razorpay/failed');
        }
    }

    public function failed()
    {
        $this->load->view('razorpay/failed_view');
    }
}
