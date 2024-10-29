<?php require "views/partials/admin_header.php"; ?>

<link href="/public/css/user_profile_style.css" rel="stylesheet">

<body>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                  
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


                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Product ID</label>
                                        <input type="text" class="form-control" value="<?php echo $product['id']; ?>"
                                            readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Category</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $product['category_id']; ?>" readonly>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label>Description</label>
                                        <textarea class="form-control" rows="2"
                                            readonly><?php echo $product['description']; ?></textarea>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label>Price</label>
                                        <input type="text" class="form-control"
                                            value="$<?php echo $product['price']; ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label>Average Rating</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $product['average_rating']; ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label>Stock Quantity</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $product['stock_quantity']; ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label>Created At</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $product['created_at']; ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label>Updated At</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $product['updated_at']; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Modal for Editing Product -->
                        <div class="modal fade" id="editProfileModal" tabindex="-1"
                            aria-labelledby="editProfileModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="/admin/product_update/<?= htmlspecialchars($product['id']); ?>"
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
                                                    <input type="text" class="form-control" name="id"
                                                        value="<?= htmlspecialchars($product['id']); ?>" readonly>
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
                                                    <input type="" class="form-control" name="category_id"
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


                        <!-- Modal for Viewing Order Details -->
                        <div class="modal fade" id="orderDetailsModal" tabindex="-1"
                            aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="order-details">
                                            <h5>Order ID: <span class="text-primary">#12345</span></h5>
                                            <p><strong>Date:</strong> <span class="text-muted">Oct 15, 2024</span></p>
                                            <p><strong>Status:</strong> <span class="text-success">Delivered</span></p>
                                            <p><strong>Total:</strong> <span class="text-danger">$49.99</span></p>
                                            <p><strong>Shipping Address:</strong> <span class="text-muted">123 Main St,
                                                    City, Country</span>
                                            </p>
                                            <p><strong>Items Ordered:</strong></p>
                                            <div class="order-items">
                                                <ul class="list-group">
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Product 1
                                                        <span class="badge bg-secondary">$19.99</span>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Product 2
                                                        <span class="badge bg-secondary">$30.00</span>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Product 3
                                                        <span class="badge bg-secondary">$25.00</span>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Product 4
                                                        <span class="badge bg-secondary">$15.00</span>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Product 5
                                                        <span class="badge bg-secondary">$40.00</span>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Product 6
                                                        <span class="badge bg-secondary">$20.00</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SweetAlert Script -->
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <!-- JavaScript -->
                        <script>
                            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
                        <script>
                            function updateUserProfile() {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Your profile has been updated.',
                                    icon: 'success',
                                    confirmButtonColor: '#3B5D50'
                                });
                            }

                            function removeItem(itemName) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "You want to remove " + itemName + " from your wishlist!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Yes, remove it!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        Swal.fire({
                                            title: 'Removed!',
                                            text: itemName + ' has been removed from your wishlist.',
                                            icon: 'success',
                                            confirmButtonColor: '#3B5D50'
                                        }
                                        );

                                    }
                                });
                            }
                        </script>
</body>


</html>