<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <h1>Razorpay Payment</h1>
    <?php if($this->session->flashdata('success')): ?>
        <p><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
        <p><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>
    <form action="<?php echo base_url('payment/verify'); ?>" method="POST" id="paymentForm">
        <button id="rzp-button1">Pay</button>
    </form>

    <script>
        var options = {
            "key": "rzp_test_IwxJBeb7jb4IDr", // Enter the Key ID generated from the Dashboard
            "amount": "<?php echo $order->amount; ?>",
            "currency": "INR",
            "name": "<?php echo $product->name; ?>",
            "description": "Test Transaction",
            "order_id": "<?php echo $order->id; ?>",
            "handler": function (response){
                document.getElementById('paymentForm').innerHTML += '<input type="hidden" name="razorpay_payment_id" value="' + response.razorpay_payment_id + '">';
                document.getElementById('paymentForm').innerHTML += '<input type="hidden" name="razorpay_order_id" value="' + response.razorpay_order_id + '">';
                document.getElementById('paymentForm').innerHTML += '<input type="hidden" name="razorpay_signature" value="' + response.razorpay_signature + '">';
                document.getElementById('paymentForm').submit();
            },
            "prefill": {
                "name": "asif",
                "email": "asif@basix.in"
            }
        };

        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>
</html>
