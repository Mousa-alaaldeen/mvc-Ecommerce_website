<?php require "views/partials/admin_header.php"; ?>

<link href="/public/css/user_profile_style.css" rel="stylesheet">

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="main-container">
                    <div class="row g-4 justify-content-center">
                        <?php foreach ($admins as $admin): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-lg rounded-lg overflow-hidden h-100" style="width: 100%; max-width: 300px;">
                                    <div class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-between" style="min-height: 300px;">
                                        <!-- Replacing image with a decorative badge for styling -->
                                        <div class="bg-primary text-white rounded-circle mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                            <?php echo strtoupper(substr(htmlspecialchars($admin['username']), 0, 1)); ?>
                                        </div>
                                        <h5 class="card-title fw-bold text-primary">
                                            <?php echo htmlspecialchars($admin['username']); ?>
                                        </h5>
                                        <p class="card-subtitle mb-2 text-secondary">
                                            <?php echo htmlspecialchars($admin['role']); ?>
                                        </p>
                                        <hr class="my-3 w-100">
                                        <p class="card-text text-muted"><strong>Email:</strong>
                                            <?php echo htmlspecialchars($admin['email']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="container my-5">
    <h2 class="text-center">Manage Admins</h2>

    <!-- جدول عرض المستخدمين -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?php echo htmlspecialchars($admin['id']); ?></td>
                    <td><?php echo htmlspecialchars($admin['username']); ?></td>
                    <td><?php echo htmlspecialchars($admin['email']); ?></td>
                    <td><?php echo htmlspecialchars($admin['role']); ?></td>
                    <td>
                        <button class="btn btn-danger" onclick="confirmDelete(<?php echo htmlspecialchars($admin['id']); ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="mt-5">Add New Admin</h4>
    <form action="add_admin" method="POST">
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
        <select class="form-select" id="role" name="role">
            <option value="admin">Admin</option>
            <option value="super_admin">Super Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Add Admin</button>
</form>

</div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
