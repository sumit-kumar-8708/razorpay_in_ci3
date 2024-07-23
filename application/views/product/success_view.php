<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
</head>
<body>
    <h1>Payment Successful</h1>
    <p>Order ID: <?php echo $payment_details->order_id; ?></p>
    <p>Product: <?php echo $payment_details->product_name; ?></p>
    <p>Amount: ₹<?php echo $payment_details->amount; ?></p>
    <p>Status: <?php echo $payment_details->status == '1' ? 'Paid' : 'Failed'; ?></p>
    <p>Created At: <?php echo $payment_details->created_at; ?></p
