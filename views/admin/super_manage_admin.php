<?php require "views/partials/admin_header.php"; ?>

<link href="/public/css/user_profile_style.css" rel="stylesheet">

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between shadow-sm p-3 bg-light rounded">

                <!-- Page Title -->
                <div class="col-auto">
                    <h1 class="app-page-title mb-0 text-success fw-bold"
                        style="font-size: 2rem; text-shadow: 1px 1px 2px #d4edda;">
                        <i class="fas fa-user-shield me-3"></i>Manage Admins
                    </h1>
                </div>

                <!-- Search Form and Add Admin Button -->
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 align-items-center">
                            <div class="col-auto">
                                <form class="docs-search-form row gx-1 align-items-center" method="GET" action="">
                                    <div class="col-auto">
                                        <input type="text" id="search-admins" name="search"
                                            class="form-control bg-light border-success rounded-pill"
                                            placeholder="Search Admins....">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn rounded-pill"
                                            style="background-color: #5bb377; border-color: #5bb377;">
                                            <i class="fas fa-search text-white"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-success text-white d-flex align-items-center rounded-pill" 
                                        onclick="confirmAdd()">
                                    <i class="bi bi-plus-circle me-2"></i> Add New Admin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admins Table -->
            <div class="table-responsive mb-5">
                <table class="table table-hover table-borderless shadow-sm rounded">
                    <thead class="table-success">
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $admin): ?>
                            <tr class="text-center">
                                <td><?php echo htmlspecialchars($admin['id']); ?></td>
                                <td><?php echo htmlspecialchars($admin['username']); ?></td>
                                <td><?php echo htmlspecialchars($admin['email']); ?></td>
                                <td><?php echo htmlspecialchars($admin['role']); ?></td>
                                <td>
                                    <button type="button" onclick="confirmDelete(<?php echo $admin['id']; ?>)" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Add Admin Modal -->
            <div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="createAdminModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="addAdminForm" action="add_admin" method="POST" enctype="multipart/form-data">
                            <div class="modal-header p-0">
                                <div class="w-100 bg-primary text-white p-2 d-flex justify-content-between align-items-center">
                                    <h5 class="modal-title text-white" id="createAdminModalLabel">Create New Admin</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" id="role" name="role" required>
                                        <option value="admin">Admin</option>
                                        <option value="super_admin">Super Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn app-btn-primary">Create Admin</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(adminId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/admin/deleteAdmin/${adminId}`;
            }
        });
    }

    function confirmAdd() {
        $('#createAdminModal').modal('show');
    }
</script>

<script src="assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
