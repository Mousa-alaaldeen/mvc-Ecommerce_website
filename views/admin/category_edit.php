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
                                data-bs-target="#editProfileModal">Edit category</button>
                            <div class="profile-info">
                                <img src="../images/shahed.jpeg" alt="category image">
                                <div>
                                    <h3>
                                        <?php
                                        $formattedName = str_replace('-', ' ', strtolower($category['category_name']));
                                        $formattedName = ucwords($formattedName);
                                        echo $formattedName;
                                        ?>
                                    </h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Category ID</label>
                                    <input type="text" class="form-control" value="<?php echo $category['id']; ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Category Name</label>
                                    <input type="text" class="form-control" value="<?php echo $category['category_name']; ?>" readonly>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>Image Url</label>
                                    <input class="form-control" type="text" value="<?php echo htmlspecialchars($category['image_url']); ?>" readonly>

                                </div>
                                
                                <div class="col-md-6 mt-3">
                                    <label>Created At</label>
                                    <input type="text" class="form-control" value="<?php echo $category['created_at']; ?>" readonly>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label>Updated At</label>
                                    <input type="text" class="form-control" value="<?php echo $category['updated_at']; ?>" readonly>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Modal for Editing category -->
                    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/admin/category_update/<?= htmlspecialchars($category['id']); ?>" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProfileModalLabel">Edit category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Category ID</label>
                                                <input type="text" class="form-control" name="id" value="<?= htmlspecialchars($category['id']); ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control" name="category_name" value="<?= htmlspecialchars($category['category_name']); ?>">
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label>Image Url</label>
                                                <textarea class="form-control" name="image_url" rows="2"><?= htmlspecialchars($category['image_url']); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- SweetAlert Script -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <!-- JavaScript -->
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
</body>

</html>