<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Payment Successful</h1>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <h3 class="mt-4">Payment Details</h3>
        <table class="table table-bordered mt-3">
            <tr>
                <th>Order ID</th>
                <td><?php echo $payment_details['order_id']; ?></td>
            </tr>
            <tr>
                <th>Payment ID</th>
                <td><?php echo $payment_details['payment_id']; ?></td>
            </tr>
            <tr>
                <th>Amount</th>
                <td><?php echo $payment_details['amount']; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo $payment_details['status']; ?></td>
            </tr>
        </table>
        <a href="<?php echo base_url('razorpay/index'); ?>" class="btn btn-primary">Go Back</a>
    </div>
</body>
</html>
