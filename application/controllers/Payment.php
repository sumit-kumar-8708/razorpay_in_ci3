<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('razorpaylibrary');
        $this->load->model('product_model');
        $this->load->library('session'); // Load the session library
    }

    public function index()
    {			
        $data['products'] = $this->product_model->get_all_products();
        $this->load->view('product/product_list', $data);
    }

    public function purchase($product_id)
    {
        $check_product_purchase = $this->product_model->to_check_product_purchase($product_id);
      
        if($check_product_purchase){
            $this->session->set_flashdata('success', 'You are Already purchase this product');
            redirect(base_url().'payment');
        }
        
        $product = $this->product_model->get_product($product_id);

        if ($product) {
            $order = $this->razorpaylibrary->create_order($product->price * 100, 'order_rcptid_' . $product_id);
            $this->product_model->insert_payment([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'amount' => $product->price,
                'status' => '0' // Initially set to 0 (Created)
            ]);
            $data['order'] = $order;
            $data['product'] = $product;
            $this->load->view('product/razorpay_view', $data);
        } else {
            show_404();
        }
    }

    public function verify()
    {  
        $payment_id = $this->input->post('razorpay_payment_id');
        $order_id = $this->input->post('razorpay_order_id');
        $signature = $this->input->post('razorpay_signature');

        $payment = $this->razorpaylibrary->fetch_payment($payment_id);

        if ($payment->status == 'captured') {
            $this->product_model->update_payment($order_id, [
                'payment_id' => $payment_id,
                'signature' => $signature,
                'status' => '1'
            ]);

            // Fetch payment details to show on the success page
            $data['payment_details'] = $this->product_model->get_payment_by_order_id($order_id);
            $this->session->set_flashdata('success', 'Payment successful');
            $this->load->view('product/success_view', $data); // Load success view with payment details
        } else {          
            $this->product_model->update_payment($order_id, ['status' => '0']);
            $this->session->set_flashdata('error', 'Payment failed');
            redirect('payment/failed');
        }
    }

    public function failed()
    {
        $this->load->view('product/failed_view');
    }
}
