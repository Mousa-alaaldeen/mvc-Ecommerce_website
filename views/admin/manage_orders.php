<?php
require "views/partials/admin_header.php";
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$filtered_orders = array_filter($orders, function ($order) use ($search_query) {
    return stripos($order['status'], $search_query) !== false;
});
// Default to all orders if no search query is provided
if ($search_query === '') {
    $filtered_orders = $orders;
}
$items_per_page = 20;
$current_page = max(1, isset($_GET['page']) ? (int) $_GET['page'] : 1);
$start_index = ($current_page - 1) * $items_per_page;
$paginated_orders = array_slice($filtered_orders, $start_index, $items_per_page);
$total_items = count($filtered_orders);
$total_pages = ceil($total_items / $items_per_page);
?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0 text-success">Orders</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="docs-search-form row gx-1 align-items-center" method="GET" action="">
                                    <div class="col-auto">
                                        <input type="text" id="search-docs" name="search"
                                            value="<?= htmlspecialchars($search_query) ?>"
                                            class="form-control search-docs" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal fade" id="editProfileModal" tabindex="-1"
                                aria-labelledby="editProfileModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/admin/order_update/<?= htmlspecialchars($order['id']); ?>"
                                            method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editProfileModalLabel">Edit Order</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Order ID</label>
                                                        <input type="text" class="form-control" name="id"
                                                            value="<?= htmlspecialchars($order['id']); ?>" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Customer ID</label>
                                                        <input type="text" class="form-control" name="customer_id"
                                                            value="<?= htmlspecialchars($order['customer_id']); ?>">
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <label>Order Date</label>
                                                        <textarea class="form-control" name="description"
                                                            rows="2"><?= htmlspecialchars($order['order_date']); ?></textarea>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label>Status</label>
                                                        <input type="text" class="form-control" name="status"
                                                            value="<?= htmlspecialchars($order['status']); ?>">
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label>Coupon ID</label>
                                                        <input type="text" class="form-control" name="order_id"
                                                            value="<?= htmlspecialchars($order['order_id']); ?>">
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label>Total Amount</label>
                                                        <input type="text" class="form-control" name="total_amount"
                                                            value="<?= htmlspecialchars($order['total_amount']); ?>">
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



                            <!-- Create Order Modal -->
                            <div class="modal fade" id="createorderModal" tabindex="-1"
                                aria-labelledby="createorderModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/admin/order_create" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createorderModalLabel">Create New Order</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="id" class="form-label">Order ID</label>
                                                    <input type="text" class="form-control" id="id" name="id" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customer_id" class="form-label">Customer ID</label>
                                                    <input type="text" class="form-control" id="customer_id"
                                                        name="customer_id" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="order_date" class="form-label">Order Date</label>
                                                    <textarea class="form-control" id="order_date" name="order_date"
                                                        rows="2" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <input type="text" class="form-control" id="status" name="status"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="coupon_id" class="form-label">Coupon ID</label>
                                                    <input type="text" class="form-control" id="coupon_id"
                                                        name="order_id">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="total_amount" class="form-label">Total Amount</label>
                                                    <input type="text" class="form-control" id="total_amount"
                                                        name="total_amount" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save Order</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-hover table-borderless shadow-sm rounded">
                <thead class="table-success">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Customer ID</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Coupon ID</th>
                        <th>Total Amount</th>
                        <th>Created At</th>
                        <th>Updated At</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paginated_orders as $order): ?>
                        <tr class="text-center">
                            <td><?= htmlspecialchars($order['id']); ?></td>
                            <td><?= htmlspecialchars($order['customer_id']); ?></td>
                            <td><?= htmlspecialchars($order['order_date']); ?></td>
                            <td><?= htmlspecialchars($order['status']); ?></td>
                            <td><?= htmlspecialchars($order['coupon_id']); ?></td>
                            <td><?= htmlspecialchars($order['total_amount']); ?></td>
                            <td><?= htmlspecialchars($order['created_at']); ?></td>
                            <td><?= htmlspecialchars($order['updated_at']); ?></td>
                            <td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <style>

            </style>
            <div class="row">
                <div class="col">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php if ($current_page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="?page=<?= $current_page - 1; ?>&search=<?= htmlspecialchars($search_query); ?>"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                                <li class="page-item <?= $page === $current_page ? 'active' : ''; ?>">
                                    <a class="page-link"
                                        href="?page=<?= $page; ?>&search=<?= htmlspecialchars($search_query); ?>"><?= $page; ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="?page=<?= $current_page + 1; ?>&search=<?= htmlspecialchars($search_query); ?>"
                                        aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "views/partials/admin_footer.php";
?>