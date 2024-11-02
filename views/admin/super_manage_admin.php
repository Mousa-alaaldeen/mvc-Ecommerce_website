<?php require "views/partials/admin_header.php"; ?>

<link href="/public/css/user_profile_style.css" rel="stylesheet">

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                
                <div class="container my-5">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-4 text-success fw-bold"
                            style="font-size: 2rem; text-shadow: 1px 1px 2px #d4edda;">
                            <i class="fas fa-user-shield me-2"></i>Manage Admins
                        </h1>
                    </div>

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
                                            <form action="delete_admin" method="POST" class="d-inline">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($admin['id']); ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this admin?');">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="col-auto mb-4">
                        <h1 class="app-page-title mb-4 text-success fw-bold"
                            style="font-size: 2rem; text-shadow: 1px 1px 2px #d4edda;">
                            <i class="fas fa-user-plus me-2"></i>Add New Admin
                        </h1>
                    </div>
                  
                    <div class="card shadow mb-5">
                        <div class="card-body">
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
                                    <select class="form-select" id="role" name="role" required>
                                        <option value="admin">Admin</option>
                                        <option value="super_admin">Super Admin</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success text-white">Add Admin</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
