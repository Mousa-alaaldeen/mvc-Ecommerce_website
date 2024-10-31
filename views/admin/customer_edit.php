<?php require "views/partials/admin_header.php"; ?>
<!-- <link href="/public/css/user_profile_style.css" rel="stylesheet"> -->

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="main-container">
                    <!-- Profile Card -->
                    <div class="card">
                        <div class="m-4 d-flex justify-content-between align-items-center">
                            <img src="<?= htmlspecialchars($customer['image_url']);?>"
                                alt="Profile Image" class="rounded-circle" style="width: 100px; height: 100px;">

                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                Edit Customer
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <h3 class="text-success ">
                                    <?php
                                    $formattedName = str_replace('-', ' ', strtolower($customer['username']));
                                    $formattedName = ucwords($formattedName);
                                    echo $formattedName;
                                    ?>
                                </h3>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Customer ID</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($customer['id']); ?>" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($customer['email']); ?>" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>First Name</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($customer['first_name']); ?>" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($customer['last_name']); ?>" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($customer['phone_number']); ?>" readonly>
                                </div>
                              
                                <div class="col-md-12 mt-3">
                                    <label>Address</label>
                                    <textarea class="form-control" rows="2"
                                        readonly><?= htmlspecialchars($customer['address']); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Customer Modal -->
                    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/admin/customer_update/<?= htmlspecialchars($customer['id']); ?>"
                                    method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProfileModalLabel">Edit Customer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Customer ID</label>
                                                <input type="text" class="form-control" name="id"
                                                    value="<?= htmlspecialchars($customer['id']); ?>" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email"
                                                    value="<?= htmlspecialchars($customer['email']); ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>User Name</label>
                                                <input type="text" class="form-control" name="username"
                                                    value="<?= htmlspecialchars($customer['username']); ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first_name"
                                                    value="<?= htmlspecialchars($customer['first_name']); ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="last_name"
                                                    value="<?= htmlspecialchars($customer['last_name']); ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" name="phone_number"
                                                    value="<?= htmlspecialchars($customer['phone_number']); ?>">
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label>Upload Image</label>
                                                <input type="file" class="form-control" name="image_url">
                                            </div>

                                            <div class="col-md-12 mt-3 mb-3">
                                                <label>Address</label>
                                                <textarea class="form-control" name="address"
                                                    rows="5"><?= htmlspecialchars($customer['address']); ?></textarea>
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

                    <!-- SweetAlert Script -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
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
                                    });
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>