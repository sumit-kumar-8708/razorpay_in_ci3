<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<body>
    <h1>Product List</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <?php echo $product->name; ?> - ₹<?php echo $product->price; ?>
                <a href="<?php echo base_url('payment/purchase/'.$product->id); ?>">Buy</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
