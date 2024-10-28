<?php require "views/partials/admin_header.php"; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category ID</th>
            <th>Average Rating</th>
            <th>Stock Quantity</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                <td><?php echo htmlspecialchars($product['description']); ?></td>
                <td>JD <?php echo number_format($product['price'], 2); ?></td>
                <td><?php echo htmlspecialchars($product['category_id']); ?></td>
                <td><?php echo htmlspecialchars(number_format($product['average_rating'], 1)); ?></td>
                <td><?php echo (int)htmlspecialchars($product['stock_quantity']); ?></td>
                <td><?php echo htmlspecialchars($product['created_at']); ?></td>
                <td><?php echo htmlspecialchars($product['updated_at'] ?? ''); ?></td>
                <td>
                    <a href="update.php?id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-warning btn-sm">Update</a>
                    <form method="POST" action="delete.php" style="display: inline-block;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['product_id']); ?>" />
                        <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
