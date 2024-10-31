<?php require "views/partials/admin_header.php"; ?>

<form action="/admin/product_update/<?= htmlspecialchars($product['product_id']); ?>" method="POST">
    <div class="row">
        <div class="col-md-6">
            <label>Product ID</label>
            <input type="text" class="form-control" name="product_id" value="<?= htmlspecialchars($product['product_id']); ?>" readonly>
        </div>
        <div class="col-md-6">
            <label>Price</label>
            <input type="text" class="form-control" name="price" value="<?= htmlspecialchars($product['price']); ?>">
        </div>
        <div class="col-md-12 mt-3">
            <label>Description</label>
            <textarea class="form-control" name="description" rows="2"><?= htmlspecialchars($product['description']); ?></textarea>
        </div>
        <div class="col-md-6 mt-3">
            <label>Category ID</label>
            <input type="text" class="form-control" name="category_id" value="<?= htmlspecialchars($product['category_id']); ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label>Average Rating</label>
            <input type="text" class="form-control" name="average_rating" value="<?= htmlspecialchars($product['average_rating']); ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label>Stock Quantity</label>
            <input type="text" class="form-control" name="stock_quantity" value="<?= htmlspecialchars($product['stock_quantity']); ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label>Created At</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($product['created_at']); ?>" readonly>
        </div>
        <div class="col-md-6 mt-3">
            <label>Updated At</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($product['updated_at']); ?>" readonly>
        </div>
        <button type="submit" class="btn btn-success btn-sm mt-4 rounded shadow">Save Changes</button>
    </div>
</form>

<?php require "views/partials/admin_footer.php"; ?>