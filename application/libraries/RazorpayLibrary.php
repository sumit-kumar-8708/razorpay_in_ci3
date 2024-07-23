
<?php
// Ensure autoloading of Composer packages
require APPPATH . '../vendor/autoload.php';

use Razorpay\Api\Api;

class RazorpayLibrary
{
    protected $api;

    public function __construct()
    {
        // Replace 'YOUR_KEY_ID' and 'YOUR_KEY_SECRET' with your actual Razorpay credentials

        // key id  = rzp_test_IwxJBeb7jb4IDr
        // secret key = ioAoTT3q08Gp7S9Bkti6XAtx
        // Merchant ID  = ObYnWOv5d7qmHE
        // $this->api = new Api('YOUR_KEY_ID', 'YOUR_KEY_SECRET');
        $this->api = new Api('rzp_test_IwxJBeb7jb4IDr', 'ioAoTT3q08Gp7S9Bkti6XAtx');

    }

    public function create_order($amount, $receipt)
    {
        $orderData = [
            'receipt'         => $receipt,
            // 'amount'          => $amount * 100, // amount in the smallest currency unit
            'amount'          => $amount,
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];

        return $this->api->order->create($orderData);
    }

    public function fetch_payment($payment_id)
    {
        return $this->api->payment->fetch($payment_id);
    }
}

