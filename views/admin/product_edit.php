<?php require "views/partials/admin_header.php"; ?>

<link href="/public/css/user_profile_style.css" rel="stylesheet">

<body>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    < class="container mt-4">
                        <div class="main-container">
                            <!-- Profile Section -->
                            <div class="profile-card">
                                <button class="profile-edit-btn" data-bs-toggle="modal"
                                    data-bs-target="#editProfileModal">Edit
                                    Product</button>
                                <div class="profile-info">
                                    <img src="../images/shahed.jpeg" alt="product image">
                                    <div>
                                        <h3>
                                            <?php
                                            $formattedName = str_replace('-', ' ', strtolower($product['product_name']));
                                            $formattedName = ucwords($formattedName);
                                            echo $formattedName;
                                            ?>
                                        </h3>

                                    </div>
                                </div>


                                <form action="/admin/product_update/<?= htmlspecialchars($product['product_id']); ?>"
                                    method="POST">
                                    <div class="profile-details mt-4">

                                        <div class="row">
                                            <div class="col-md-6">

                                                <label>Product ID</label>
                                                <input type="text" class="form-control" name="product_id"
                                                    value="<?php echo $product['product_id']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Price</label>
                                                <input type="text" class="form-control" name="price"
                                                    value="<?php echo $product['price']; ?>">
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label>Description</label>
                                                <textarea class="form-control" rows="2"
                                                    name="description"><?php echo $product['description']; ?></textarea>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label>Category ID</label>
                                                <input type="text" class="form-control" name="category_id"
                                                    value="$<?php echo $product['category_id']; ?>">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label>Average Rating</label>
                                                <input type="text" class="form-control" name="average_rating"
                                                    value="<?php echo $product['average_rating']; ?>">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label>Stock Quantity</label>
                                                <input type="text" class="form-control" name="stock_quantity"
                                                    value="<?php echo $product['stock_quantity']; ?>">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label>Created At</label>
                                                <input type="text" class="form-control"
                                                    value="<?php echo $product['created_at']; ?>">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label>Updated At</label>
                                                <input type="text" class="form-control"
                                                    value="<?php echo $product['updated_at']; ?>">
                                            </div>
                                            <button type="submit">Update</button>

                                        </div>
                                    </div>
                                    </form>
                            </div>

                        </div>

                    <!-- Modal for Editing Product -->
                    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/admin/product_update/<?= htmlspecialchars($product['product_id']); ?>"
                                    method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProfileModalLabel">Edit Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Product ID</label>
                                                <input type="text" class="form-control" name="product_id"
                                                    value="<?= htmlspecialchars($product['product_id']); ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Price</label>
                                                <input type="text" class="form-control" name="price"
                                                    value="<?= htmlspecialchars($product['price']); ?>">
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label>Description</label>
                                                <textarea class="form-control" name="description"
                                                    rows="2"><?= htmlspecialchars($product['description']); ?></textarea>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label>Category ID</label>
                                                <input type="text" class="form-control" name="category_id"
                                                    value="<?= htmlspecialchars($product['category_id']); ?>">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label>Average Rating</label>
                                                <input type="text" class="form-control" name="average_rating"
                                                    value="<?= htmlspecialchars($product['average_rating']); ?>">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label>Stock Quantity</label>
                                                <input type="text" class="form-control" name="stock_quantity"
                                                    value="<?= htmlspecialchars($product['stock_quantity']); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
</body>


</html>